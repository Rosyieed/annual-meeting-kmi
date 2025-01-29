<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Group;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('bitActive', 1)
            ->with('department', 'groups', 'role')
            ->orderBy('txtName', 'asc')
            ->get();

        $roles = Role::where('bitActive', 1);

        $departments = Department::where('bitActive', 1);

        return view('pages.admin.user.index', compact('users', 'roles', 'departments'));
    }

    public function create()
    {
        $roles = Role::where('bitActive', 1)->get();
        $departments = Department::where('bitActive', 1)->get();
        $groups = Group::where('bitActive', 1)->get();

        return view('pages.admin.user.create', compact('roles', 'departments', 'groups'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate(
            [
                'txtName' => 'required|min:3|max:255|regex:/^[a-zA-Z\s]+$/',
                'txtEmail' => 'required|email|unique:musers,txtEmail,NULL,intUser_ID,bitActive,1',
                'intRole_ID' => 'required|exists:mroles,intRole_ID',
                'intDepartment_ID' => 'required|exists:mdepartments,intDepartment_ID',
                'txtNIK' => 'required|numeric|unique:musers,txtNIK,NULL,intUser_ID,bitActive,1',
                'txtGender' => 'required|in:L,P',
                'intGroup_ID' => 'required|exists:mgroups,intGroup_ID',
            ],
            [
                'txtName.required' => 'Name is required!',
                'txtName.min' => 'Name must be at least 3 characters!',
                'txtName.max' => 'Name must be at most 255 characters!',
                'txtName.regex' => 'Name must only contain letters and spaces!',
                'txtEmail.required' => 'Email is required!',
                'txtEmail.email' => 'Email must be a valid email address!',
                'txtEmail.unique' => 'Email has already been taken!',
                'intRole_ID.required' => 'Role is required!',
                'intRole_ID.exists' => 'Role is invalid!',
                'intDepartment_ID.required' => 'Department is required!',
                'intDepartment_ID.exists' => 'Department is invalid!',
                'txtNIK.required' => 'NIK is required!',
                'txtNIK.numeric' => 'NIK must be a number!',
                'txtNIK.unique' => 'NIK has already been taken!',
                'txtGender.required' => 'Gender is required!',
                'txtGender.in' => 'Gender must be L or P!',
            ]
        );

        $validatedData['txtPassword'] = bcrypt('kalbemorinaga');
        $validatedData['intProcessStep'] = 0;
        $validatedData['txtInsertedBy'] = auth()->user()->txtName;
        $validatedData['dtmInserted'] = now();
        $validatedData['bitActive'] = 1;

        User::create($validatedData);

        // Group Member Insert
        $group = Group::find($request->intGroup_ID);
        $group->members()->attach(User::latest()->first(), [
            'txtInsertedBy' => auth()->user()->txtName,
            'dtmInserted' => now(),
        ]);

        toast('User created successfully!', 'success')->timerProgressBar();
        return redirect()->route('master.users.index');
    }

    public function show(User $user)
    {
        $user->load('department', 'groups', 'role');

        // dd($user);

        return view('pages.admin.user.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::where('bitActive', 1)->get();
        $departments = Department::where('bitActive', 1)->get();
        $groups = Group::where('bitActive', 1)->get();

        return view('pages.admin.user.edit', compact('user', 'roles', 'departments', 'groups', 'user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate(
            [
                'txtName' => 'required|min:3|max:255|regex:/^[a-zA-Z\s]+$/',
                'txtEmail' => 'required|email|unique:musers,txtEmail,' . $user->intUser_ID . ',intUser_ID',
                'intRole_ID' => 'required|exists:mroles,intRole_ID',
                'intDepartment_ID' => 'required|exists:mdepartments,intDepartment_ID',
                'txtNIK' => 'required|numeric|unique:musers,txtNIK,' . $user->intUser_ID . ',intUser_ID',
                'txtGender' => 'required|in:L,P',
                'intGroup_ID' => 'required|exists:mgroups,intGroup_ID',
            ],
            [
                'txtName.required' => 'Name is required!',
                'txtName.min' => 'Name must be at least 3 characters!',
                'txtName.max' => 'Name must be at most 255 characters!',
                'txtName.regex' => 'Name must only contain letters and spaces!',
                'txtEmail.required' => 'Email is required!',
                'txtEmail.email' => 'Email must be a valid email address!',
                'txtEmail.unique' => 'Email has already been taken!',
                'intRole_ID.required' => 'Role is required!',
                'intRole_ID.exists' => 'Role is invalid!',
                'intDepartment_ID.required' => 'Department is required!',
                'intDepartment_ID.exists' => 'Department is invalid!',
                'txtNIK.required' => 'NIK is required!',
                'txtNIK.numeric' => 'NIK must be a number!',
                'txtNIK.unique' => 'NIK has already been taken!',
                'txtGender.required' => 'Gender is required!',
                'txtGender.in' => 'Gender must be L or P!',
                'intGroup_ID.required' => 'Group is required!',
                'intGroup_ID.exists' => 'Group is invalid!',
            ]
        );

        $validatedData['txtUpdatedBy'] = auth()->user()->txtName;
        $validatedData['dtmUpdated'] = now();

        $user->update($validatedData);

        $currentGroup = $user->groups()->first();

        if ($currentGroup) {
            // Jika pengguna sudah tergabung dalam grup, update grup di pivot table
            DB::table('mgroupmembers')
                ->where('intUser_ID', $user->intUser_ID)
                ->where('intGroup_ID', $currentGroup->intGroup_ID) // ID grup lama
                ->update([
                    'intGroup_ID' => $request->intGroup_ID, // ID grup baru
                    'txtUpdatedBy' => auth()->user()->txtName,
                    'dtmUpdated' => now(),
                ]);
        } else {
            // Jika pengguna belum tergabung dalam grup, tambahkan ke grup baru
            DB::table('mgroupmembers')->insert([
                'intGroup_ID' => $request->intGroup_ID,
                'intUser_ID' => $user->intUser_ID,
                'intVotes' => 0,
                'boolIsLeader' => 0,
                'boolHasVoted' => 0,
                'txtInsertedBy' => auth()->user()->txtName,
                'dtmInserted' => now(),
            ]);
        }


        toast('User updated successfully!', 'success')->timerProgressBar();
        return redirect()->route('master.users.index');
    }

    public function delete(User $user)
    {
        $user->update([
            'bitActive' => 0,
            'txtUpdatedBy' => auth()->user()->txtName,
            'dtmUpdated' => now(),
        ]);

        // jika dirinya berada di dalam grup, hapus dari grup
        $group = $user->groups()->first();
        if ($group) {
            $group->members()->detach($user->intUser_ID);
        }

        // jika dirinya adalah leader dari grup, hapus kolom leader
        $group = Group::where('intLeader_ID', $user->intUser_ID)->first();
        if ($group) {
            $group->update([
                'intLeader_ID' => null,
                'txtUpdatedBy' => auth()->user()->txtName,
                'dtmUpdated' => now(),
            ]);
        }

        // jika dirinya sendri yang sedang login, logout
        if (auth()->id() == $user->intUser_ID) {
            auth()->logout();
        }

        toast('User deleted successfully!', 'success')->timerProgressBar();
        return redirect()->back();
    }

    public function resetPassword(User $user)
    {
        $user->update([
            'txtPassword' => bcrypt('kalbemorinaga'),
            'txtUpdatedBy' => auth()->user()->txtName,
            'dtmUpdated' => now(),
        ]);

        toast('Password reset successfully!', 'success')->timerProgressBar();
        return redirect()->back();
    }

    public function restorePage()
    {
        $users = User::where('bitActive', 0)
            ->with('department', 'groups', 'role')
            ->orderBy('txtName', 'asc')
            ->get();

        $roles = Role::where('bitActive', 1);

        $departments = Department::where('bitActive', 1);

        return view('pages.admin.user.restore', compact('users', 'roles', 'departments'));
    }

    public function restoreUser(User $user)
    {
        $user->update([
            'bitActive' => 1,
            'txtUpdatedBy' => auth()->user()->txtName,
            'dtmUpdated' => now(),
        ]);

        toast('User restored successfully!', 'success')->timerProgressBar();
        return redirect()->back();
    }
}
