<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CountdownTeam;
use RealRashid\SweetAlert\Facades\Alert;

class CongratulationPageController extends Controller
{
    public function congratulationPage()
    {
        $user = auth()->user();

        // Ambil nama grup pertama yang terkait dengan user
        $groupName = $user->groups->first()->txtGroupName;
        $userName = $user->txtName;

        // Dapatkan user yang sedang login
        $userId = User::find(auth()->id());

        // Cari grup tempat user saat ini tergabung
        $group = $userId->groups()->first();

        // dd($group);

        // Jika user tidak tergabung dalam grup mana pun
        if (!$group) {
            return redirect()->back()->with('error', 'You are not part of any group.');
        }

        // Ambil anggota grup kecuali user itu sendiri
        $members = $group->members->where('intUser_ID', '!=', $user->intUser_ID);

        // countDown
        $countDown = CountdownTeam::where('bitActive', 1)->first();

        return view('pages.user.congratulations', compact('userName', 'groupName', 'group', 'members', 'countDown'));
    }

    public function index()
    {
        $countDowns = CountdownTeam::where('bitActive', 1)
            ->orderBy('dtmStartTime', 'asc')
            ->get();

        return view('pages.admin.countdown.index', compact('countDowns'));
    }

    public function create()
    {
        return view('pages.admin.countdown.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'dtmStartTime' => [
                'required',
                'date_format:Y-m-d\TH:i',
                'after_or_equal:now',
            ]
        ], [
            'dtmStartTime.required' => 'The countdown start time field is required.',
            'dtmStartTime.date_format' => 'The countdown start time does not match the format d-m-Y H:i.',
            'dtmStartTime.after_or_equal' => 'The countdown start time must be a date after or equal to the current date and time.',
        ]);

        // Validasi jika hanya bisa membuat satu countdown
        $countDown = CountdownTeam::where('bitActive', 1)->first();
        if ($countDown) {
            toast('You can only create one countdown at a time.', 'error');
            return redirect()->back();
        }

        $validatedData['txtInsertedBy'] = auth()->user()->txtName;
        $validatedData['dtmInserted'] = now();
        $validatedData['bitActive'] = 1;

        CountdownTeam::create($validatedData);

        toast('Countdown created successfully.', 'success');
        return redirect()->route('master.countdowns.index');
    }

    public function edit(CountdownTeam $countdown)
    {
        return view('pages.admin.countdown.edit', compact('countdown'));
    }

    public function update(Request $request, CountdownTeam $countdown)
    {
        $validatedData = $request->validate([
            'dtmStartTime' => [
                'required',
                'date_format:Y-m-d\TH:i',
                'after_or_equal:now',
            ]
        ], [
            'dtmStartTime.required' => 'The countdown start time field is required.',
            'dtmStartTime.date_format' => 'The countdown start time does not match the format',
            'dtmStartTime.after_or_equal' => 'The countdown start time must be a date after or equal to the current date and time.',
        ]);

        $validatedData['txtUpdatedBy'] = auth()->user()->txtName;
        $validatedData['dtmUpdated'] = now();

        $countdown->update($validatedData);

        toast('Countdown updated successfully.', 'success');
        return redirect()->route('master.countdowns.index');
    }

    public function show(CountdownTeam $countdown)
    {
        return view('pages.admin.countdown.show', compact('countdown'));
    }
}
