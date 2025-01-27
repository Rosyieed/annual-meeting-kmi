@extends('admin-layouts.master')

@section('title', 'Restore User')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Restore User</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item"><a href="{{ route('master.users.index') }}">User Data</a></li>
                <li class="breadcrumb-item">Restore User</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card stretch stretch-full">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table-hover table" id="userTable">
                            <thead>
                                <tr>
                                    <th>Number<i class="feather-filter"></i></th>
                                    <th>Name <i class="feather-filter"></i></th>
                                    <th>Email <i class="feather-filter"></i></th>
                                    <th>NIK <i class="feather-filter"></i></th>
                                    <th>Gender <i class="feather-filter"></i></th>
                                    <th>Department <i class="feather-filter"></i></th>
                                    <th>Group <i class="feather-filter"></i></th>
                                    <th>Role <i class="feather-filter"></i></th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $user)
                                    <tr class="single-item fs-12">
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            {{ $user->txtName }}
                                        </td>
                                        <td>{{ $user->txtEmail }}</td>
                                        <td>
                                            {{ $user->txtNIK }}
                                        </td>
                                        <td>{{ $user->txtGender }}</td>
                                        <td>{{ $user->department->txtDepartment }}</td>
                                        <td>
                                            @foreach ($user->groups as $group)
                                                {{ $group->txtGroupName }}
                                            @endforeach
                                        </td>
                                        <td>{{ $user->role->txtRole }}</td>
                                        <td>
                                            <div class="hstack justify-content-end gap-2">
                                                <a href="{{ route('master.users.show', $user->intUser_ID) }}"
                                                    class="avatar-text avatar-md">
                                                    <i class="feather feather-eye"></i>
                                                </a>
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" class="avatar-text avatar-md"
                                                        data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                        <i class="feather feather-more-horizontal"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        {{-- <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('master.users.edit', $user->intUser_ID) }}">
                                                                <i class="feather feather-edit-3 me-3"></i>
                                                                <span>Edit</span>
                                                            </a>
                                                        </li> --}}
                                                        {{-- <li>
                                                            <a class="dropdown-item printBTN" href="javascript:void(0)">
                                                                <i class="feather feather-printer me-3"></i>
                                                                <span>Print</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0)">
                                                                <i class="feather feather-clock me-3"></i>
                                                                <span>Remind</span>
                                                            </a>
                                                        </li>
                                                        <li class="dropdown-divider"></li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0)">
                                                                <i class="feather feather-archive me-3"></i>
                                                                <span>Archive</span>
                                                            </a>
                                                        </li> --}}
                                                        <li>
                                                            <form
                                                                action="{{ route('master.users.restore-user', $user->intUser_ID) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="dropdown-item"
                                                                    data-confirm-reset="true">
                                                                    <i class="feather feather-alert-octagon me-3"></i>
                                                                    <span>Restore User</span>
                                                                </button>
                                                            </form>
                                                        </li>
                                                        {{-- <li class="dropdown-divider"></li> --}}
                                                        {{-- <li>
                                                            <form
                                                                action="{{ route('master.users.delete', $user->intUser_ID) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('put')
                                                                <button type="submit" class="dropdown-item delete-btn">
                                                                    <i class="feather feather-trash-2 me-3"></i>
                                                                    <span>Delete</span>
                                                                </button>
                                                            </form>
                                                        </li> --}}
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
            const table = document.getElementById('userTable');
            const dataTable = new DataTable(table);
        });
    </script>

    @include('sweetalert::alert')
@endsection
