<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Question;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the data for the dashboard cards
        $totalUsers = User::count();
        $totalGroups = Group::where('bitActive', 1)->count();
        $totalQuestions = Question::where('bitActive', 1)->count();
        $activeUsers = User::where('bitActive', 1)->count();
        $activePercentage = $totalUsers > 0 ? round(($activeUsers / $totalUsers) * 100, 2) : 0;

        $groups = Group::where('bitActive', 1)->with('leader')->get();
        // Exclude the groups with IDs 1, 2, and 3
        // $groups = Group::where('bitActive', 1)->whereNotIn('id', [1, 2, 3])->with('leader')->get();

        return view('pages.admin.dashboard', compact('totalUsers', 'totalGroups', 'totalQuestions', 'activeUsers', 'activePercentage', 'groups'));
    }

    public function getProcessStatus()
    {
        // Menghitung jumlah user yang belum mengisi
        $notFilled = User::where('intProcessStep', 0)->where('bitActive', 1)->count();

        // Menghitung jumlah user yang sudah mengisi
        $filled = User::where('intProcessStep', 1)->where('bitActive', 1)->count();

        // menghitung yang sudah selesai semua process
        $done = User::where('intProcessStep', 2)->where('bitActive', 1)->count();

        // Menghitung total user
        $totalUsers = $filled + $notFilled + $done;

        return response()->json([
            'filled' => $filled,
            'notFilled' => $notFilled,
            'done' => $done,
            'totalUsers' => $totalUsers
        ]);
    }
}
