<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\Group;
use App\Models\EventInformation;
use App\Models\GeetingCommitment;
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
use App\Http\Controllers\EventInformationController;
use App\Http\Controllers\GeetingCommitmentController;
use App\Http\Controllers\CongratulationPageController;

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
Route::prefix('command')->group(function () {
    Route::get('/optimize', [ArtisanController::class, 'optimize'])->name('optimize');
    Route::get('/cache-clear', [ArtisanController::class, 'cacheClear'])->name('cache-clear');
    Route::get('/route-clear', [ArtisanController::class, 'routeClear'])->name('route-clear');
    Route::get('/config-cache', [ArtisanController::class, 'configCache'])->name('config-cache');
    Route::get('publish-sweetalert', [ArtisanController::class, 'publishSweetAlert'])->name('publish-sweetalert');
    Route::get('storage-link', [ArtisanController::class, 'storageLink'])->name('storage-link');
    Route::get('cache-view', function () {
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        return json_encode(['status' => 'success', 'message' => 'View cache cleared!']);
    })->name('cache-view');
});

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

    $buttons = EventInformation::where('bitActive', 1)->get();

    // $now = Carbon::now();
    // $buttonVisible = GreetingCommitment::where('dtmButtonShow', '<=', $now)
    //     ->where('bitActive', 1)
    //     ->exists();

    $hasSubmittedGeeting = GeetingCommitment::where('intUser_ID', Auth::user()->intUser_ID)
    ->where('bitActive', 1)
    ->exists();


    return view('pages.user.homepage', compact('group', 'buttons', 'hasSubmittedGeeting'));
})->name('home');

Route::get('get-group-information', [GroupController::class, 'getGroupInformation'])->name('get-group-information');

Route::middleware(['auth', 'checkrole:admin,user'])->group(function () {
    // Question and Answer Page
    Route::get('/question', [QuestionAnswerController::class, 'showSurveyPage'])->name('question')->middleware('checkprocess');
    Route::get('/survey', [SurveyController::class, 'showSurvey'])->name('survey.show');
    Route::post('/survey/submit', [SurveyController::class, 'storeUserAnswers'])->name('survey.submit');

    // Congatulations Page
    Route::get('/congratulations', [CongratulationPageController::class, 'congratulationPage'])->name('congratulations')->middleware('checkprocess');

    // Vote Group Leader Page
    Route::get('/vote', [GroupController::class, 'votePage'])->name('vote')->middleware('auth', 'checkrole:admin');
    Route::post('/group/{groupId}/vote', [GroupController::class, 'vote'])->name('groups.vote');

    // Geeting Commitment Page
    Route::post('/geeting-commitment/store-user', [GeetingCommitmentController::class, 'storeUser'])->name('geeting-commitment.store-user');
    Route::get('/geeting-commitments-page', [GeetingCommitmentController::class, 'showGeetingCommitmentPage'])->name('geeting-commitment');
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

        // Countdowns
        Route::get('countdowns', [CongratulationPageController::class, 'index'])->name('master.countdowns.index');
        Route::get('countdowns/create', [CongratulationPageController::class, 'create'])->name('master.countdowns.create');
        Route::post('countdowns/store', [CongratulationPageController::class, 'store'])->name('master.countdowns.store');
        Route::get('countdowns/{countdown}/edit', [CongratulationPageController::class, 'edit'])->name('master.countdowns.edit');
        Route::put('countdowns/{countdown}', [CongratulationPageController::class, 'update'])->name('master.countdowns.update');
        Route::get('countdowns/{countdown}', [CongratulationPageController::class, 'show'])->name('master.countdowns.show');

        // Event Information
        Route::get('event-informations', [EventInformationController::class, 'index'])->name('master.event-informations.index');
        Route::get('event-informations/create', [EventInformationController::class, 'create'])->name('master.event-informations.create');
        Route::post('event-informations/store', [EventInformationController::class, 'store'])->name('master.event-informations.store');
        Route::get('event-informations/{eventInformation}/edit', [EventInformationController::class, 'edit'])->name('master.event-informations.edit');
        Route::put('event-informations/{eventInformation}', [EventInformationController::class, 'update'])->name('master.event-informations.update');
        Route::put('event-informations/{eventInformation}/delete', [EventInformationController::class, 'delete'])->name('master.event-informations.delete');
        Route::get('event-informations-restore', [EventInformationController::class, 'restorePage'])->name('master.event-informations.restore-index');
        Route::put('event-informations/{eventInformation}/restore', [EventInformationController::class, 'restoreEventInformation'])->name('master.event-informations.restore-event-information');
        Route::get('event-informations/{eventInformation}', [EventInformationController::class, 'show'])->name('master.event-informations.show');

        // Geeting Commitment
        Route::get('/geeting-commitments', [GeetingCommitmentController::class, 'index'])->name('geeting-commitment.index');
        Route::get('/geeting-commitments/{geetingCommitment}/edit', [GeetingCommitmentController::class, 'edit'])->name('geeting-commitment.edit');
        Route::put('/geeting-commitments/{geetingCommitment}', [GeetingCommitmentController::class, 'update'])->name('geeting-commitment.update');
        Route::put('/geeting-commitments/{geetingCommitment}/delete', [GeetingCommitmentController::class, 'delete'])->name('geeting-commitment.delete');
        Route::get('/geeting-commitments/{geetingCommitment}', [GeetingCommitmentController::class, 'show'])->name('geeting-commitment.show');
        Route::get('/geeting-commitments-restore', [GeetingCommitmentController::class, 'restorePage'])->name('geeting-commitment.restore-index');
        Route::put('/geeting-commitments/{geetingCommitment}/restore', [GeetingCommitmentController::class, 'restoreGeetingCommitment'])->name('geeting-commitment.restore-geeting-commitment');
    });
});
