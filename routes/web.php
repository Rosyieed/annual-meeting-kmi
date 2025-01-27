<?php

use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\QuestionAnswerController;

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

// Route Auth(Login, Logout)
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// HomePage
Route::get('/', function () {
    // Get the current logged-in user
    $user = Auth::user();

    // If the user is not logged in, redirect to the login page
    if (!$user) {
        return view('pages.user.homepage');
    }

    // Fetch the group(s) associated with the user
    $group = $user->groups->first(); // Get the first group associated with the user

    // If the user doesn't belong to any group, handle it
    if (!$group) {
        return redirect()->back()->with('error', 'User is not assigned to any group!');
    }

    // Fetch the group with its members and leader
    $group = Group::with(['members', 'leader'])->find($group->intGroup_ID);

    return view('pages.user.homepage', compact('group'));
})->name('home');

Route::middleware(['auth', 'checkrole:admin,user'])->group(function () {
    Route::get('/question', function () {
        return view('pages.user.quizpage');
    })->name('question')->middleware('checkprocess');

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
    })->name('congratulations')->middleware('checkprocess');

    Route::get('/survey', [SurveyController::class, 'showSurvey'])->name('survey.show');
    Route::post('/survey/submit', [SurveyController::class, 'storeUserAnswers'])->name('survey.submit');

    // Vote Group Leader Page
    Route::get('/vote', [GroupController::class, 'votePage'])->name('vote')->middleware('auth', 'checkrole:admin');
    Route::post('/group/{groupId}/vote', [GroupController::class, 'vote'])->name('groups.vote');
});

Route::prefix('admin')->middleware(['auth', 'checkrole:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.admin.dashboard');
    })->name('admin.dashboard')->middleware('auth', 'checkrole:admin');

    // Master Data
    Route::prefix('/master-data')->group(function () {
        // Users
        Route::get('users', [UserController::class, 'index'])->name('master.users.index');
        Route::get('users/create', [UserController::class, 'create'])->name('master.users.create');
        Route::post('users/store', [UserController::class, 'store'])->name('master.users.store');
        Route::get('users/{user}', [UserController::class, 'show'])->name('master.users.show');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('master.users.edit');
        Route::put('users/{user}', [UserController::class, 'update'])->name('master.users.update');
        Route::put('users/{user}/delete', [UserController::class, 'delete'])->name('master.users.delete');
        Route::put('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('master.users.reset-password');
        Route::get('users-restore', [UserController::class, 'restorePage'])->name('master.users.restore-index');
        Route::put('users/{user}/restore', [UserController::class, 'restoreUser'])->name('master.users.restore-user');

        // Groups
        Route::get('groups', [GroupController::class, 'index'])->name('master.groups.index');
        Route::get('groups/create', [GroupController::class, 'create'])->name('master.groups.create');
        Route::post('groups/store', [GroupController::class, 'store'])->name('master.groups.store');
        Route::get('groups/{group}', [GroupController::class, 'show'])->name('master.groups.show');
        Route::get('groups/{group}/edit', [GroupController::class, 'edit'])->name('master.groups.edit');
        Route::put('groups/{group}', [GroupController::class, 'update'])->name('master.groups.update');
        Route::put('groups/{group}/delete', [GroupController::class, 'delete'])->name('master.groups.delete');
        Route::get('groups-restore', [GroupController::class, 'restorePage'])->name('master.groups.restore-index');
        Route::put('groups/{group}/restore', [GroupController::class, 'restoreGroup'])->name('master.groups.restore-group');

        // Questions and Answers
        Route::get('questions', [QuestionAnswerController::class, 'index'])->name('master.questions.index');
        Route::get('questions/create', [QuestionAnswerController::class, 'create'])->name('master.questions.create');
        Route::post('questions/store', [QuestionAnswerController::class, 'store'])->name('master.questions.store');
        Route::get('questions/{question}/edit', [QuestionAnswerController::class, 'edit'])->name('master.questions.edit');
        Route::put('questions/{question}', [QuestionAnswerController::class, 'update'])->name('master.questions.update');
        Route::put('questions/{question}/delete', [QuestionAnswerController::class, 'delete'])->name('master.questions.delete');
        Route::get('questions-restore', [QuestionAnswerController::class, 'restorePage'])->name('master.questions.restore-index');
        Route::put('questions/{question}/restore', [QuestionAnswerController::class, 'restore'])->name('master.questions.restore');
        Route::get('questions/{question}', [QuestionAnswerController::class, 'show'])->name('master.questions.show');
    });
});
