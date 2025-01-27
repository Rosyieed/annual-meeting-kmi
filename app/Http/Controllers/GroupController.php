<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::where('bitActive', 1)->get();
        return view('pages.admin.group.index', compact('groups'));
    }

    public function create()
    {
        return view('pages.admin.group.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'txtGroupName' => 'required|string|max:255|unique:mgroups,txtGroupName',
        ], [
            'txtGroupName.required' => 'Group name is required!',
            'txtGroupName.string' => 'Group name must be a string!',
            'txtGroupName.max' => 'Group name must not exceed 255 characters!',
            'txtGroupName.unique' => 'Group name has already been taken!',
        ]);

        $validatedData['txtInsertedBy'] = auth()->user()->txtName;
        $validatedData['dtmInserted'] = now();
        $validatedData['bitActive'] = 1;

        Group::create($validatedData);

        toast('Group created successfully!', 'success');
        return redirect()->route('master.groups.index');
    }

    public function show(Group $group)
    {
        $group->load('members', 'leader');
        return view('pages.admin.group.show', compact('group'));
    }

    public function edit($groupId)
    {
        $group = Group::findOrFail($groupId);
        return view('pages.admin.group.edit', compact('group'));
    }

    public function update(Request $request, $groupId)
    {
        $group = Group::findOrFail($groupId);

        $validatedData = $request->validate([
            'txtGroupName' => 'required|string|max:255|unique:mgroups,txtGroupName,' . $group->intGroup_ID . ',intGroup_ID',
        ], [
            'txtGroupName.required' => 'Group name is required!',
            'txtGroupName.string' => 'Group name must be a string!',
            'txtGroupName.max' => 'Group name must not exceed 255 characters!',
            'txtGroupName.unique' => 'Group name has already been taken!',
        ]);

        $validatedData['txtUpdatedBy'] = auth()->user()->txtName;
        $validatedData['dtmUpdated'] = now();

        $group->update($validatedData);

        toast('Group updated successfully!', 'success');
        return redirect()->route('master.groups.index');
    }

    public function delete($groupId)
    {
        $group = Group::findOrFail($groupId);
        $group->update([
            'bitActive' => 0,
            'txtUpdatedBy' => auth()->user()->txtName,
            'dtmUpdated' => now(),
        ]);

        // Delete all members of the group
        $group->members()->detach();

        toast('Group deleted successfully!', 'success');
        return redirect()->route('master.groups.index');
    }

    public function restorePage()
    {
        $groups = Group::where('bitActive', 0)->get();
        return view('pages.admin.group.restore', compact('groups'));
    }

    public function restoreGroup($groupId)
    {
        $group = Group::findOrFail($groupId);
        $group->update([
            'bitActive' => 1,
            'txtUpdatedBy' => auth()->user()->txtName,
            'dtmUpdated' => now(),
        ]);

        toast('Group restored successfully!', 'success');
        return redirect()->route('master.groups.restore-index');
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

        // update process step user
        User::where('intUser_ID', $user->intUser_ID)->update(['intProcessStep' => 2]);

        toast('Your vote has been counted!', 'success');
        return redirect()->route('home');
    }
}
