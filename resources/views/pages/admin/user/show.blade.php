@extends('admin-layouts.master')

@section('title', 'User Information')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">User Information</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item"><a href="{{ route('master.users.index') }}">User Data</a></li>
                <li class="breadcrumb-item">User Information</li>
            </ul>
        </div>
        <div class="page-header-right ms-auto">
            <div class="page-header-right-items">
                <div class="d-flex d-md-none">
                    <a href="javascript:void(0)" class="page-header-right-close-toggle">
                        <i class="feather-arrow-left me-2"></i>
                        <span>Back</span>
                    </a>
                </div>
            </div>
            <div class="d-md-none d-flex align-items-center">
                <a href="javascript:void(0)" class="page-header-right-open-toggle">
                    <i class="feather-align-right fs-20"></i>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="tab-content">
        <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
            <div class="card card-body lead-info">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="fw-bold mb-0">
                        <span class="d-block mb-2">User Information :</span>
                        <span class="fs-12 fw-normal text-muted d-block">Please provide the following user
                            information</span>
                    </h5>
                    <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">User Information</a>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Name</div>
                    <div class="col-lg-10"><a href="javascript:void(0);">{{ $user->txtName }}</a></div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Email</div>
                    <div class="col-lg-10"><a href="javascript:void(0);">{{ $user->txtEmail }}</a></div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">NIK</div>
                    <div class="col-lg-10"><a href="javascript:void(0);">{{ $user->txtNIK }}</a></div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Gender</div>
                    <div class="col-lg-10"><a href="javascript:void(0);">{{ $user->txtGender }}</a></div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Role</div>
                    <div class="col-lg-10"><a href="javascript:void(0);">{{ $user->role->txtRole }}</a></div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Department</div>
                    <div class="col-lg-10"><a href="javascript:void(0);">{{ $user->department->txtDepartment }}</a></div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Group</div>
                    @foreach ($user->groups as $group)
                        <div class="col-lg-10"><a href="javascript:void(0);"> {{ $group->txtGroupName }}</a></div>
                    @endforeach
                </div>
            </div>
            <hr>
        </div>
    </div>
@endsection
