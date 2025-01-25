<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function votePage()
    {
        // Dapatkan user yang sedang login
        $user = User::find(auth()->id());

        // Cari grup tempat user saat ini tergabung
        $group = $user->groups()->first();

        // dd($group);

        // Jika user tidak tergabung dalam grup mana pun
        if (!$group) {
            return redirect()->back()->with('error', 'You are not part of any group.');
        }

        // Ambil anggota grup kecuali user itu sendiri
        $members = $group->members->where('intUser_ID', '!=', $user->intUser_ID);

        return view('pages.groups.vote', compact('group', 'members'));
    }

    // Melakukan voting untuk memilih ketua grup
    public function vote(Request $request, $groupId)
    {

        // Ambil grup berdasarkan ID
        $group = Group::findOrFail($groupId);

        // Ambil pengguna yang sedang login
        $user = auth()->user();

        // Validasi apakah pengguna adalah anggota grup
        if (!$group->members->contains($user->intUser_ID)) {
            toast('You are not a member of this group.', 'error');
            return redirect()->back();
        }

        // Validasi apakah pengguna telah memberikan vote sebelumnya
        $userMembership = $group->members()->wherePivot('intUser_ID', $user->intUser_ID)->first();
        if ($userMembership && $userMembership->pivot->boolHasVoted) {
            toast('You have already voted.', 'error');
            return redirect()->back()->with('show_congratulation_modal', true);
        }

        // Ambil ID anggota yang dipilih untuk menjadi ketua
        $leaderId = $request->input('leader_id');
        // $leader = User::findOrFail($leaderId);

        // Validasi apakah anggota yang dipilih adalah anggota grup yang sama
        if (!$group->members->contains($leaderId)) {
            toast('The selected leader is not a member of this group.', 'error');
            return redirect()->back();
        }

        // Tambahkan vote kepada anggota yang dipilih
        $group->members()->updateExistingPivot($leaderId, [
            'intVotes' => DB::raw('intVotes + 1'),
        ]);

        // Tandai bahwa pengguna telah melakukan vote
        $group->members()->updateExistingPivot($user->intUser_ID, [
            'boolHasVoted' => 1,
        ]);

        // Tentukan ketua grup berdasarkan suara terbanyak
        $newLeader = $group->members()
            ->orderByDesc('intVotes')
            ->first();

        if ($newLeader) {
            // Reset semua anggota ke bukan ketua
            $group->members()->update(['boolIsLeader' => 0]);

            // Tandai anggota dengan suara terbanyak sebagai ketua
            $group->members()->updateExistingPivot($newLeader->intUser_ID, [
                'boolIsLeader' => 1,
            ]);

            // Perbarui kolom `intLeader_ID` pada tabel grup
            $group->update(['intLeader_ID' => $newLeader->intUser_ID]);
        }

        toast('Your vote has been counted!', 'success');

        return redirect()->route('groups.show', $groupId)->with('success', 'Your vote has been counted!');
    }

    // Menampilkan hasil voting dan ketua yang terpilih
    public function showResults($groupId)
    {
        $group = Group::with('members')->find($groupId);
        $leader = $group->leader; // Ambil ketua yang terpilih
        return view('groups.results', compact('group', 'leader'));
    }
}
