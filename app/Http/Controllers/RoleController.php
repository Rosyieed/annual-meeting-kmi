<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::where('bitActive', 1)->get();
        return view('pages.admin.role.index', compact('roles'));
    }

    public function create()
    {
        return view('pages.admin.role.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'txtRole' => 'required|string|max:255|unique:mroles,txtRole',
        ], [
            'txtRole.required' => 'Role name is required',
            'txtRole.string' => 'Role name must be a string',
            'txtRole.max' => 'Role name must not exceed 255 characters',
            'txtRole.unique' => 'Role name already exists',
        ]);

        // Create a new role
        Role::create([
            'txtRole' => $request->txtRole,
            'txtInsertedBy' => auth()->user()->txtName,
            'dtmInserted' => now(),
            'bitActive' => 1,
        ]);

        // Redirect to roles index with a success message
        toast('Role created successfully', 'success');
        return redirect()->route('master.roles.index');
    }

    public function edit($id)
    {
        // Fetch the role by its ID
        $role = Role::findOrFail($id);
        return view('pages.admin.role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'txtRole' => 'required|string|max:255',
        ], [
            'txtRole.required' => 'Role name is required',
            'txtRole.string' => 'Role name must be a string',
            'txtRole.max' => 'Role name must not exceed 255 characters',
        ]);

        // Update the role
        Role::where('intRole_ID', $id)->update([
            'txtRole' => $request->txtRole,
            'txtUpdatedBy' => auth()->user()->txtName,
            'dtmUpdated' => now(),
        ]);

        // Redirect to roles index with a success message
        toast('Role updated successfully', 'success');
        return redirect()->route('master.roles.index');
    }

    public function delete($id)
    {
        // Soft delete the role
        Role::where('intRole_ID', $id)->update([
            'txtUpdatedBy' => auth()->user()->txtName,
            'dtmUpdated' => now(),
            'bitActive' => 0,
        ]);

        // Redirect to roles index with a success message
        toast('Role deleted successfully', 'success');
        return redirect()->route('master.roles.index');
    }

    public function restorePage()
    {
        // Fetch all soft deleted roles
        $roles = Role::where('bitActive', 0)->get();
        return view('pages.admin.role.restore', compact('roles'));
    }

    public function restoreRole($id)
    {
        // Restore the soft deleted role
        Role::where('intRole_ID', $id)->update([
            'txtUpdatedBy' => auth()->user()->txtName,
            'dtmUpdated' => now(),
            'bitActive' => 1,
        ]);

        // Redirect to roles index with a success message
        toast('Role restored successfully', 'success');
        return redirect()->route('master.roles.index');
    }

    public function show(Role $role)
    {
        return view('pages.admin.role.show', compact('role'));
    }
}
