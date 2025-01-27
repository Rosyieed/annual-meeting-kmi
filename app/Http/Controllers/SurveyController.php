<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\User;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SurveyController extends Controller
{
    public function showSurvey()
    {
        $questions = Question::with('answers')
            ->where('bitActive', 1)
            ->get();  // Mengambil semua pertanyaan dengan jawabannya
        return response()->json($questions);
    }

    public function storeUserAnswers(Request $request)
    {
        // Validasi jawaban pengguna
        $answers = json_decode($request->input('answers'), true);

        $validator = Validator::make($answers, [
            '*.question_id' => 'required|exists:mQuestions,intQuestion_ID',
            '*.answer_id' => 'required|exists:mAnswers,intAnswer_ID',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        // merge data answers ke request
        $request->merge(['answers' => $answers]);

        $user = Auth::user();  // Ambil user yang sedang login


        // Menyimpan jawaban pengguna
        foreach ($request->answers as $answer) {
            UserAnswer::create([
                'intUser_ID' => $user->intUser_ID,
                'intQuestion_ID' => $answer['question_id'],
                'intAnswer_ID' => $answer['answer_id'],
                'txtInsertedBy' => $user->txtName,
                'dtmInserted' => now(),
                'bitActive' => 1,
            ]);
        }


        // update process step user
        User::where('intUser_ID', $user->intUser_ID)->update(['intProcessStep' => 1]);

        toast('Survey has been submitted successfully!', 'success')->timerProgressBar();
        return redirect()->route('congratulations');
    }

    public function resetProcessStep($id)
    {
        $user = User::find($id);

        // // Jika Process Step > 1, maka tidak bisa direset
        if ($user->intProcessStep > 1) {
            toast('Process step cannot be reset!', 'error')->timerProgressBar();
            return redirect()->route('master.users.index');
        }

        // Hapus jawaban pengguna
        UserAnswer::where('intUser_ID', $user->intUser_ID)->delete();
        // Reset process step user
        User::where('intUser_ID', $user->intUser_ID)->update(['intProcessStep' => 0]);

        toast('Process step has been reset successfully!', 'success')->timerProgressBar();
        return redirect()->route('master.users.index');
    }
}
