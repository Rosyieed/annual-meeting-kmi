<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeetingCommitment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GeetingCommitmentController extends Controller
{
    public function index()
    {
        $geetingCommitments = GeetingCommitment::where('bitActive', 1)
            ->with('user')
            ->get();

        return view('pages.admin.geeting-commitment.index', compact('geetingCommitments'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'photo' => 'required|string', // Base64 format dari foto kamera
            'geetingText' => 'required|string|max:255',
        ]);

        // Decode base64 ke file
        $photoData = $request->photo;
        $photoPath = 'public/geeting-commitment/' . uniqid() . '.png';
        Storage::put($photoPath, base64_decode(explode(',', $photoData)[1]));

        // Validasi apakah user sudah pernah mengirim komitmen
        $existingCommitment = GeetingCommitment::where('intUser_ID', Auth::user()->intUser_ID)
            ->where('bitActive', 1)
            ->first();

        if ($existingCommitment) {
            toast('You have already sent a previous commit!', 'error');
            return redirect()->back();
        }

        // Simpan data ke database
        GeetingCommitment::create([
            'intUser_ID' => Auth::user()->intUser_ID,
            'txtPhoto' => str_replace('public/', 'storage/', $photoPath), // Format path agar bisa diakses
            'txtCommitment' => $request->geetingText,
            'dtmInserted' => now(),
            'txtInsertedBy' => Auth::user()->txtName,
            'bitActive' => 1,
        ]);

        toast('Geeting Commitment sent successfully!', 'success');
        return redirect()->route('geeting-commitment');
    }

    public function edit($id)
    {
        $commitment = GeetingCommitment::findOrFail($id);

        return view('pages.admin.geeting-commitment.edit', compact('commitment'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'txtPhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Hanya file gambar
            'txtCommitment' => 'required|string|max:255',
        ]);

        $commitment = GeetingCommitment::findOrFail($id);

        // Jika admin mengunggah foto baru, simpan foto baru (tidak menghapus yang lama)
        if ($request->hasFile('txtPhoto')) {
            $photoPath = $request->file('txtPhoto')->store('public/geeting-commitment');
            $commitment->txtPhoto = str_replace('public/', 'storage/', $photoPath);
        }

        // Update teks komitmen
        $commitment->txtCommitment = $request->txtCommitment;
        $commitment->dtmUpdated = now();
        $commitment->txtUpdatedBy = Auth::user()->txtName;
        $commitment->save();

        toast('Geeting Commitment updated successfully!', 'success');
        return redirect()->route('geeting-commitment.index');
    }

    public function delete($id)
    {
        $commitment = GeetingCommitment::findOrFail($id);

        // Update status bitActive menjadi 0 (soft delete)
        $commitment->bitActive = 0;
        $commitment->dtmUpdated = now();
        $commitment->txtUpdatedBy = Auth::user()->txtName;
        $commitment->save();

        toast('Geeting Commitment deleted successfully!', 'success');
        return redirect()->back();
    }

    public function show($id)
    {
        $commitment = GeetingCommitment::findOrFail($id);

        return view('pages.admin.geeting-commitment.show', compact('commitment'));
    }

    public function restorePage()
    {
        $deletedCommitments = GeetingCommitment::where('bitActive', 0)
        ->with('user')
        ->get();

        return view('pages.admin.geeting-commitment.restore', compact('deletedCommitments'));
    }

    public function restoreGeetingCommitment($id)
    {
        $commitment = GeetingCommitment::findOrFail($id);

        // Kembalikan status ke aktif
        $commitment->bitActive = 1;
        $commitment->dtmUpdated = now();
        $commitment->txtUpdatedBy = Auth::user()->txtName;
        $commitment->save();

        toast('Geeting Commitment restored successfully!', 'success');
        return redirect()->back();
    }

    public function showGeetingCommitmentPage(){
        $geetingCommitments = GeetingCommitment::where('bitActive', 1)
            ->with('user')
            ->get();

        return view('pages.user.geeting-commitment', compact('geetingCommitments'));
    }
}
