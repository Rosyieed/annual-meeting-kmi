<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventInformation;
use Illuminate\Support\Facades\Storage;

class EventInformationController extends Controller
{
    public function index()
    {
        $eventInformations = EventInformation::where('bitActive', 1)->get();
        return view('pages.admin.event-information.index', compact('eventInformations'));
    }

    public function create()
    {
        return view('pages.admin.event-information.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'txtModalTitle' => 'required|string|max:255',
            'txtModalContent' => 'required|string',
            'txtModalImagePath' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'txtModalLink' => 'required|string|max:255',
        ]);

        // Upload gambar ke storage
        $txtModalImagePath = $request->file('txtModalImagePath')->store('event-information', 'public');

        EventInformation::create([
            'txtModalTitle' => $validatedData['txtModalTitle'],
            'txtModalContent' => $validatedData['txtModalContent'],
            'txtModalImagePath' => $txtModalImagePath,
            'txtModalLink' => $validatedData['txtModalLink'],
            'txtInsertedBy' => auth()->user()->txtName,
            'dtmInserted' => now(),
            'bitActive' => 1,
        ]);

        toast('Event Information created successfully!', 'success');
        return redirect()->route('master.event-informations.index');
    }

    public function edit($id)
    {
        $eventInformation = EventInformation::findOrFail($id);
        return view('pages.admin.event-information.edit', compact('eventInformation'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'txtModalTitle' => 'required|string|max:255',
            'txtModalContent' => 'required|string',
            'txtModalImagePath' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'txtModalLink' => 'required|string|max:255',
        ]);

        $eventInformation = EventInformation::findOrFail($id);

        if ($request->hasFile('txtModalImagePath')) {
            // Hapus gambar lama
            Storage::disk('public')->delete($eventInformation->txtModalImagePath);

            // Upload gambar baru
            $txtModalImagePath = $request->file('txtModalImagePath')->store('event-information', 'public');
        } else {
            $txtModalImagePath = $eventInformation->txtModalImagePath;
        }

        $eventInformation->update([
            'txtModalTitle' => $validatedData['txtModalTitle'],
            'txtModalContent' => $validatedData['txtModalContent'],
            'txtModalImagePath' => $txtModalImagePath,
            'txtModalLink' => $validatedData['txtModalLink'],
            'txtUpdatedBy' => auth()->user()->txtName,
            'dtmUpdated' => now(),
        ]);

        toast('Event Information updated successfully!', 'success');
        return redirect()->route('master.event-informations.index');
    }

    public function delete($id)
    {
        $eventInformation = EventInformation::findOrFail($id);
        $eventInformation->update([
            'txtUpdatedBy' => auth()->user()->txtName,
            'dtmUpdated' => now(),
            'bitActive' => 0,
        ]);

        toast('Event Information deleted successfully!', 'success');
        return redirect()->route('master.event-informations.index');
    }

    public function show($id)
    {
        $eventInformation = EventInformation::findOrFail($id);
        return view('pages.admin.event-information.show', compact('eventInformation'));
    }

    public function restorePage()
    {
        $eventInformations = EventInformation::where('bitActive', 0)->get();
        return view('pages.admin.event-information.restore', compact('eventInformations'));
    }

    public function restoreEventInformation($id)
    {
        $eventInformation = EventInformation::findOrFail($id)->where('bitActive', 0)->first();
        $eventInformation->update([
            'txtUpdatedBy' => auth()->user()->txtName,
            'dtmUpdated' => now(),
            'bitActive' => 1,
        ]);

        toast('Event Information restored successfully!', 'success');
        return redirect()->route('master.event-informations.index');
    }
}
