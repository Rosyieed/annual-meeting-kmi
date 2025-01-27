@extends('admin-layouts.master')

@section('title', 'Department Information')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Department Information</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item"><a href="{{ route('master.departments.index') }}">Department Data</a></li>
                <li class="breadcrumb-item">Department Information</li>
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
                        <span class="d-block mb-2">Department Information :</span>
                        <span class="fs-12 fw-normal text-muted d-block">Please provide the following department
                            information</span>
                    </h5>
                    <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Department Information</a>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Department Name</div>
                    <div class="col-lg-10"><a href="javascript:void(0);">{{ $department->txtDepartment }}</a></div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Short Name</div>
                    <div class="col-lg-10"><a href="javascript:void(0);">{{ $department->txtShortName }}</a></div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Inserted By</div>
                    <div class="col-lg-10"><a href="javascript:void(0);">{{ $department->txtInsertedBy ?? '-' }}</a></div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Datetime Inserted</div>
                    <div class="col-lg-10"><a href="javascript:void(0);">{{ $department->dtmInserted ?? '-' }}</a></div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Updated By</div>
                    <div class="col-lg-10"><a href="javascript:void(0);">{{ $department->txtUpdatedBy ?? '-' }}</a></div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Datetime Updated</div>
                    <div class="col-lg-10"><a href="javascript:void(0);">{{ $department->dtmUpdated ?? '-' }}</a></div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Active Status</div>
                    <div class="col-lg-10">
                        @if ($department->bitActive == 1)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Not Active</span>
                        @endif
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
@endsection
