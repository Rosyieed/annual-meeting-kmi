@extends('admin-layouts.master')

@section('title', 'Create User ')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Create User</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item"><a href="{{ route('master.users.index') }}">User Data</a></li>
                <li class="breadcrumb-item">Create User</li>
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-top-0">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
                        <div class="card-body personal-info">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h5 class="fw-bold mb-0 me-4">
                                    <span class="d-block mb-2">Create User</span>
                                    <span class="fs-12 fw-normal text-muted text-truncate-1-line">Please fill in the details
                                        below:</span>
                                </h5>
                                <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Add New User</a>
                            </div>
                            <form action="{{ route('master.users.store') }}" method="POST">
                                @csrf
                                <div class="row align-items-center mb-4">
                                    <div class="col-lg-4">
                                        <label for="txtName" class="fw-semibold">Name: </label>
                                        @error('txtName')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-user"></i></div>
                                            <input type="text" class="form-control" id="txtName" name="txtName"
                                                placeholder="Name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-4">
                                    <div class="col-lg-4">
                                        <label for="txtEmail" class="fw-semibold">Email: </label>
                                        @error('txtEmail')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-mail"></i></div>
                                            <input type="email" class="form-control" id="txtEmail" name="txtEmail"
                                                placeholder="Email" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-4">
                                    <div class="col-lg-4">
                                        <label for="txtNIK" class="fw-semibold">NIK: </label>
                                        @error('txtNIK')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-credit-card"></i></div>
                                            <input type="text" class="form-control" id="txtNIK" name="txtNIK"
                                                placeholder="NIK" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-4">
                                    <div class="col-lg-4">
                                        <label for="txtGender" class="fw-semibold">Gender: </label>
                                        @error('txtGender')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-users"></i></div>
                                            <select class="form-select" style="font-size: 13.52px" id="txtGender"
                                                name="txtGender" required>
                                                <option value="">Select Gender</option>
                                                <option value="L">Male</option>
                                                <option value="P">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-4">
                                    <div class="col-lg-4">
                                        <label for="intRole_ID" class="fw-semibold">Role: </label>
                                        @error('intRole_ID')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-briefcase"></i></div>
                                            <select class="form-select" style="font-size: 13.52px" id="intRole_ID"
                                                name="intRole_ID" required>
                                                <option value="">Select Role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->intRole_ID }}">{{ $role->txtRole }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-4">
                                    <div class="col-lg-4">
                                        <label for="intDepartment_ID" class="fw-semibold">Department: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-layers"></i></div>
                                            <select class="form-select"style="font-size: 13.52px" id="intDepartment_ID"
                                                name="intDepartment_ID" required>
                                                <option value="">Select Department</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->intDepartment_ID }}">
                                                        {{ $department->txtDepartment }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-4">
                                    <div class="col-lg-4">
                                        <label for="intGroup_ID" class="fw-semibold">Group: </label>
                                        @error('intGroup_ID')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-layers"></i></div>
                                            <select class="form-select"style="font-size: 13.52px" id="intGroup_ID"
                                                name="intGroup_ID" required>
                                                <option value="">Select Group</option>
                                                @foreach ($groups as $group)
                                                    <option value="{{ $group->intGroup_ID }}">
                                                        {{ $group->txtGroupName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-secondary me-2">Clear</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
