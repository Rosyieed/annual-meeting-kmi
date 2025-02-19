<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\GeetingButton;
use App\Models\GeetingCommitment;
use Illuminate\Support\Facades\Auth;

class GeetingButtonController extends Controller
{
    public function checkGeetingButton()
    {
        $now = Carbon::now();
        $buttonVisible = GeetingButton::where('dtmButtonShow', '<=', $now)
            ->where('bitActive', 1)
            ->exists();

        $hasSubmittedGeeting = false;

        if (Auth::check()) {
            $hasSubmittedGeeting = GeetingCommitment::where('intUser_ID', Auth::id())
                ->where('bitActive', 1)
                ->exists();
        }

        return response()->json([
            'buttonVisible' => $buttonVisible,
            'hasSubmittedGeeting' => $hasSubmittedGeeting
        ]);
    }

    public function index()
    {
        $geetingButtons = GeetingButton::where('bitActive', 1)->get();

        return view('pages.admin.geeting-button.index', compact('geetingButtons'));
    }

    public function create()
    {
        return view('pages.admin.geeting-button.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'dtmButtonShow' => [
                'required',
                'date_format:Y-m-d\TH:i',
                'after_or_equal:now',
            ]
        ], [
            'dtmButtonShow.required' => 'The countdown start time field is required.',
            'dtmButtonShow.date_format' => 'The countdown start time does not match the format d-m-Y H:i.',
            'dtmButtonShow.after_or_equal' => 'The countdown start time must be a date after or equal to the current date and time.',
        ]);

        $geetingButtonCountdown = GeetingButton::where('bitActive', 1)->first();

        if ($geetingButtonCountdown) {
            toast('You can only create one countdown at a time.', 'error');
            return redirect()->route('master.geeting-buttons.index');
        }

        $validatedData['txtInsertedBy'] = auth()->user()->txtName;
        $validatedData['dtmInserted'] = now();
        $validatedData['bitActive'] = 1;

        GeetingButton::create($validatedData);

        toast('Geeting Button Countdown successfully.', 'success');
        return redirect()->route('master.geeting-buttons.index');
    }

    public function edit($id)
    {
        $geetingButton = GeetingButton::findOrFail($id);

        return view('pages.admin.geeting-button.edit', compact('geetingButton'));
    }

    public function update(Request $request, $id)
    {
        $geetingButton = GeetingButton::findOrFail($id);

        $validatedData = $request->validate([
            'dtmButtonShow' => [
                'required',
                'date_format:Y-m-d\TH:i',
                'after_or_equal:now',
            ]
        ], [
            'dtmButtonShow.required' => 'The countdown start time field is required.',
            'dtmButtonShow.date_format' => 'The countdown start time does not match the format d-m-Y H:i.',
            'dtmButtonShow.after_or_equal' => 'The countdown start time must be a date after or equal to the current date and time.',
        ]);

        $validatedData['txtUpdatedBy'] = auth()->user()->txtName;
        $validatedData['dtmUpdated'] = now();

        $geetingButton->update($validatedData);

        toast('Geeting Button Countdown successfully updated.', 'success');
        return redirect()->route('master.countdowns.index');
    }

    public function show($id){
        $geetingButton = GeetingButton::findOrFail($id);

        return view('pages.admin.geeting-button.show', compact('geetingButton'));
    }
}
