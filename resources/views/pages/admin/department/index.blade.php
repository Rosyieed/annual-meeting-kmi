@extends('admin-layouts.master')

@section('title', 'Department Data')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Department Data</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item">Department Data</li>
            </ul>
        </div>
        <div class="page-header-right ms-auto">
            <div class="page-header-right-items">
                <div class="btn-group" role="group">
                    <a href="{{ route('master.departments.create') }}" class="btn btn-primary">
                        <i class="feather-plus me-2"></i>
                        <span>Create Department</span>
                    </a>
                    <a href="{{ route('master.departments.restore-index') }}" class="btn btn-secondary">
                        <i class="feather-list me-2"></i>
                        <span>Restore Department</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card stretch stretch-full">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table-hover table" id="departmentTable">
                            <thead>
                                <tr>
                                    <th>Number <i class="feather-filter"></i></th>
                                    <th>Department Name <i class="feather-filter"></i></th>
                                    <th>Short Name <i class="feather-filter"></i></th>
                                    <th>Status <i class="feather-filter"></i></th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departments as $index => $department)
                                    <tr class="single-item fs-12">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $department->txtDepartment }}</td>
                                        <td>{{ $department->txtShortName }}</td>
                                        <td>
                                            <span class="badge {{ $department->bitActive ? 'bg-success' : 'bg-danger' }}">
                                                {{ $department->bitActive ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="hstack justify-content-end gap-2">
                                                <a href="{{ route('master.departments.show', $department->intDepartment_ID) }}"
                                                    class="avatar-text avatar-md">
                                                    <i class="feather feather-eye"></i>
                                                </a>
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" class="avatar-text avatar-md"
                                                        data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                        <i class="feather feather-more-horizontal"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('master.departments.edit', $department->intDepartment_ID) }}">
                                                                <i class="feather feather-edit-3 me-3"></i>
                                                                <span>Edit</span>
                                                            </a>
                                                        </li>
                                                        <li class="dropdown-divider"></li>
                                                        <li>
                                                            <form
                                                                action="{{ route('master.departments.delete', $department->intDepartment_ID) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('put')
                                                                <button type="submit" class="dropdown-item delete-btn">
                                                                    <i class="feather feather-trash-2 me-3"></i>
                                                                    <span>Delete</span>
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.getElementById('departmentTable');
            const dataTable = new DataTable(table);
        });
    </script>

    @include('sweetalert::alert')
@endsection
