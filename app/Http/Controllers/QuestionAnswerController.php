<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionAnswerController extends Controller
{

    public function index()
    {
        // Ambil semua pertanyaan dengan jawaban terkait
        $questions = Question::with('answers')
            ->where('bitActive', 1)
            ->get();

        return view('pages.user.question-answer.index', compact('questions'));
    }
    public function create()
    {
        // dd('create');
        return view('pages.user.question-answer.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'txtQuestion' => 'required|string|max:255',
            'answers' => 'required|array|min:1', // Minimal 1 jawaban
            'answers.*.txtAnswer' => 'required|string|max:255', // Validasi untuk setiap jawaban
        ]);

        DB::beginTransaction();

        try {
            // Simpan pertanyaan
            $question = Question::create([
                'txtQuestion' => $validatedData['txtQuestion'],
                'txtInsertedBy' => auth()->user()->txtName, // Sesuaikan dengan kebutuhan
                'dtmInserted' => now(),
                'bitActive' => true,
            ]);

            // Simpan jawaban
            foreach ($validatedData['answers'] as $answer) {
                Answer::create([
                    'intQuestion_ID' => $question->intQuestion_ID,
                    'txtAnswer' => $answer['txtAnswer'],
                    'txtInsertedBy' => auth()->user()->txtName, // Sesuaikan dengan kebutuhan
                    'dtmInserted' => now(),
                    'bitActive' => true,
                ]);
            }

            DB::commit();

            toast('Question and answers saved successfully!', 'success');
            return redirect()->route('master.questions.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to save question and answers.']);
        }
    }

    public function edit($id)
    {
        $question = Question::with('answers')->findOrFail($id);
        return view('pages.user.question-answer.edit', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'txtQuestion' => 'required|string|max:255',
            'answers.*.txtAnswer' => 'required|string|max:255',
        ]);

        $question = Question::findOrFail($id);
        $question->update(['txtQuestion' => $request->txtQuestion]);

        $existingAnswerIds = $question->answers->pluck('intAnswer_ID')->toArray();

        // Simpan ID jawaban yang dikirim dari request
        $submittedAnswerIds = collect($request->answers)
            ->filter(fn($data) => isset($data['intAnswer_ID'])) // Hanya ambil yang punya ID
            ->pluck('intAnswer_ID')
            ->toArray();

        // Update jawaban yang sudah ada
        foreach ($request->answers as $data) {
            if (isset($data['intAnswer_ID'])) {
                // Perbarui jawaban dengan ID
                Answer::where('intAnswer_ID', $data['intAnswer_ID'])->update([
                    'txtAnswer' => $data['txtAnswer'],
                    'txtUpdatedBy' => auth()->user()->txtName,
                    'dtmUpdated' => now(),
                ]);
            } else {
                // Tambahkan jawaban baru
                $question->answers()->create([
                    'txtAnswer' => $data['txtAnswer'],
                    'txtInsertedBy' => auth()->user()->txtName,
                    'dtmInserted' => now(),
                ]);
            }
        }

        // Hapus jawaban yang tidak lagi ada di request
        $deletedAnswerIds = array_diff($existingAnswerIds, $submittedAnswerIds);

        // Hapus data di tabel relasi terlebih dahulu
        DB::table('truseranswers')->whereIn('intAnswer_ID', $deletedAnswerIds)->delete();

        // Hapus jawaban di tabel utama
        Answer::destroy($deletedAnswerIds);

        toast('Question and answers updated successfully!', 'success');
        return redirect()->route('master.questions.index');
    }

    public function delete($id)
    {
        // Cari pertanyaan berdasarkan ID
        $question = Question::findOrFail($id);

        // Nonaktifkan pertanyaan
        $question->update(['bitActive' => 0]);

        // Nonaktifkan semua jawaban terkait
        $question->answers()->update(['bitActive' => 0]);

        toast('Question and related answers have been successfully deactivated.', 'success');
        return redirect()->route('master.questions.index');
    }

    public function restorePage()
    {
        // Ambil semua pertanyaan yang sudah dinonaktifkan
        $questions = Question::with('answers')
            ->where('bitActive', 0)
            ->get();

        return view('pages.user.question-answer.restore', compact('questions'));
    }

    public function restore($id)
    {
        // Cari pertanyaan berdasarkan ID
        $question = Question::findOrFail($id);

        // Aktifkan pertanyaan
        $question->update(['bitActive' => 1]);

        // Aktifkan semua jawaban terkait
        $question->answers()->update(['bitActive' => 1]);

        toast('Question and related answers have been successfully reactivated.', 'success');
        return redirect()->route('master.questions.index');
    }

    public function show($id)
    {
        // Ambil pertanyaan dengan jawaban terkait
        $question = Question::with('answers')->findOrFail($id);

        return view('pages.user.question-answer.show', compact('question'));
    }
}
