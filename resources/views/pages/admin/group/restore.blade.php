@extends('admin-layouts.master')

@section('title', 'Restore Group')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Restore Group</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item"><a href="{{ route('master.groups.index') }}">Group Data</a></li>
                <li class="breadcrumb-item">Restore Group</li>
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
                                    <th>Leader <i class="feather-filter"></i></th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groups as $index => $group)
                                    <tr class="single-item fs-12">
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            {{ $group->txtGroupName }}
                                        </td>
                                        <td>{{ $group->leader->txtName ?? '-' }}</td>
                                        <td>
                                            <div class="hstack justify-content-end gap-2">
                                                {{-- <a href="{{ route('master.users.show', $user->intUser_ID) }}" --}}
                                                <a href="{{ route('master.groups.show', $group->intGroup_ID) }}"
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
                                                            <form
                                                                action="{{ route('master.groups.restore-group', $group->intGroup_ID) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="dropdown-item"
                                                                    data-confirm-reset="true">
                                                                    <i class="feather feather-alert-octagon me-3"></i>
                                                                    <span>Restore Group</span>
                                                                </button>
                                                            </form>
                                                        </li>
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
                                                        {{-- <li class="dropdown-divider"></li>
                                                        <li>
                                                            <form
                                                                action="{{ route('master.groups.delete', $group->intGroup_ID) }}"
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
