<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::where('bitActive', 1)->get();
        return view('pages.admin.department.index', compact('departments'));
    }

    public function create()
    {
        return view('pages.admin.department.create');
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'txtDepartment' => 'required|string|max:255|unique:mdepartments,txtDepartment',
                'txtShortName' => 'required|string|max:50|unique:mdepartments,txtShortName',
            ],
            [
                'txtDepartment.required' => 'Department name is required!',
                'txtShortName.required' => 'Short name is required!',
                'txtDepartment.max' => 'Department name should not exceed 255 characters!',
                'txtShortName.max' => 'Short name should not exceed 50 characters!',
                'txtDepartment.string' => 'Department name should be a string!',
                'txtShortName.string' => 'Short name should be a string!',
                'txtDepartment.unique' => 'Department name already exists!',
            ]
        );

        Department::create([
            'txtDepartment' => $request->txtDepartment,
            'txtShortName' => $request->txtShortName,
            'txtInsertedBy' => auth()->user()->txtName,
            'dtmInserted' => now(),
            'bitActive' => 1,
        ]);

        toast('Department created successfully!', 'success');
        return redirect()->route('master.departments.index');
    }

    public function edit(Department $department)
    {
        return view('pages.admin.department.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate(
            [
                'txtDepartment' => 'required|string|max:255|unique:mdepartments,txtDepartment,' . $department->id,
                'txtShortName' => 'required|string|max:50|unique:mdepartments,txtShortName,' . $department->id,
            ],
            [
                'txtDepartment.required' => 'Department name is required!',
                'txtShortName.required' => 'Short name is required!',
                'txtDepartment.max' => 'Department name should not exceed 255 characters!',
                'txtShortName.max' => 'Short name should not exceed 50 characters!',
                'txtDepartment.string' => 'Department name should be a string!',
                'txtShortName.string' => 'Short name should be a string!',
                'txtDepartment.unique' => 'Department name already exists!',
                'txtShortName.unique' => 'Short name already exists!',
            ]
        );

        $department->update([
            'txtDepartment' => $request->txtDepartment,
            'txtShortName' => $request->txtShortName,
            'txtUpdatedBy' => auth()->user()->txtName,
            'dtmUpdated' => now(),
        ]);

        toast('Department updated successfully!', 'success');
        return redirect()->route('master.departments.index');
    }

    public function delete(Department $department)
    {
        $department->update([
            'bitActive' => 0,
            'txtDeletedBy' => auth()->user()->txtName,
            'dtmDeleted' => now(),
        ]);

        toast('Department deleted successfully!', 'success');
        return redirect()->route('master.departments.index');
    }

    public function restorePage()
    {
        $departments = Department::where('bitActive', 0)->get();
        return view('pages.admin.department.restore', compact('departments'));
    }

    public function restoreDepartment(Department $department)
    {
        $department->update([
            'bitActive' => 1,
            'txtRestoredBy' => auth()->user()->txtName,
            'dtmRestored' => now(),
        ]);

        toast('Department restored successfully!', 'success');
        return redirect()->route('master.departments.index');
    }

    public function show(Department $department)
    {
        return view('pages.admin.department.show', compact('department'));
    }
}
