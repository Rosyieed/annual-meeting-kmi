<?php

use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\ArtisanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentController;
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

// Route Function for Artisan
Route::get('/artisan/optimize', function () {
    Artisan::call('optimize');
    return json_encode(['status' => 'success', 'message' => 'Optimization completed!']);
})->name('optimize-cache');

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
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    // Route untuk mengambil status pengisian proses
    Route::get('/dashboard/get-process-status', [DashboardController::class, 'getProcessStatus'])->middleware('api');

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
        Route::put('users/{user}/reset-process-step', [SurveyController::class, 'resetProcessStep'])->name('master.users.reset-process-step');

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

        // Department
        Route::get('departments', [DepartmentController::class, 'index'])->name('master.departments.index');
        Route::get('departments/create', [DepartmentController::class, 'create'])->name('master.departments.create');
        Route::post('departments/store', [DepartmentController::class, 'store'])->name('master.departments.store');
        Route::get('departments/{department}/edit', [DepartmentController::class, 'edit'])->name('master.departments.edit');
        Route::put('departments/{department}', [DepartmentController::class, 'update'])->name('master.departments.update');
        Route::put('departments/{department}/delete', [DepartmentController::class, 'delete'])->name('master.departments.delete');
        Route::get('departments-restore', [DepartmentController::class, 'restorePage'])->name('master.departments.restore-index');
        Route::put('departments/{department}/restore', [DepartmentController::class, 'restoreDepartment'])->name('master.departments.restore-department');
        Route::get('departments/{department}', [DepartmentController::class, 'show'])->name('master.departments.show');

        // Roles
        Route::get('roles', [RoleController::class, 'index'])->name('master.roles.index');
        Route::get('roles/create', [RoleController::class, 'create'])->name('master.roles.create');
        Route::post('roles/store', [RoleController::class, 'store'])->name('master.roles.store');
        Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('master.roles.edit');
        Route::put('roles/{role}', [RoleController::class, 'update'])->name('master.roles.update');
        Route::put('roles/{role}/delete', [RoleController::class, 'delete'])->name('master.roles.delete');
        Route::get('roles-restore', [RoleController::class, 'restorePage'])->name('master.roles.restore-index');
        Route::put('roles/{role}/restore', [RoleController::class, 'restoreRole'])->name('master.roles.restore-role');
        Route::get('roles/{role}', [RoleController::class, 'show'])->name('master.roles.show');
    });
});
