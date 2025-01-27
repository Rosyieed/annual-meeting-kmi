@extends('admin-layouts.master')

@section('title', 'Create Group ')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Create Group</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item"><a href="{{ route('master.groups.index') }}">Group Data</a></li>
                <li class="breadcrumb-item">Create Group</li>
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
                                    <span class="d-block mb-2">Create Group</span>
                                    <span class="fs-12 fw-normal text-muted text-truncate-1-line">Please fill in the details
                                        below:</span>
                                </h5>
                                <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Add New Group</a>
                            </div>
                            <form action="{{ route('master.groups.store') }}" method="POST">
                                @csrf
                                <div class="row align-items-center mb-4">
                                    <div class="col-lg-4">
                                        <label for="txtGroupName" class="fw-semibold">Group Name: </label>
                                        @error('txtGroupName')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-users"></i></div>
                                            <input type="text" class="form-control" id="txtGroupName" name="txtGroupName"
                                                placeholder="Group Name" required>
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
