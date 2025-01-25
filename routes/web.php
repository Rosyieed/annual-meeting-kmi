<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('pages.homepage');
})->name('home');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/question', function () {
    return view('pages.quizpage');
})->name('question');

// Congatulations Page
Route::get('/congratulations', function () {
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

    return view('pages.congratulations', compact('userName', 'groupName', 'group', 'members'));
})->name('congratulations');

Route::get('/survey', [SurveyController::class, 'showSurvey'])->name('survey.show');
Route::post('/survey/submit', [SurveyController::class, 'storeUserAnswers'])->name('survey.submit');

// Vote Group Leader Page
Route::get('/vote', [GroupController::class, 'votePage'])->name('vote');
Route::post('/group/{groupId}/vote', [GroupController::class, 'vote'])->name('groups.vote');
