@extends('admin-layouts.master')

@section('title', 'Geeting Commitment')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Geeting Commitment</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item"><a href="{{ route('geeting-commitment.index') }}">Geeting Commitment Data</a></li>
                <li class="breadcrumb-item">Geeting Commitment</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="tab-content">
        <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
            <div class="card card-body lead-info">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="fw-bold mb-0">
                        <span class="d-block mb-2">Geeting Commitment Details :</span>
                        <span class="fs-12 fw-normal text-muted d-block">Below are the details of this commitment</span>
                    </h5>
                    <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Geeting Commitment</a>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Commitment</div>
                    <div class="col-lg-10"><a href="javascript:void(0);">{{ $commitment->txtCommitment }}</a></div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Photo</div>
                    <div class="col-lg-10">
                        @if ($commitment->txtPhoto)
                            <a href="{{ asset($commitment->txtPhoto) }}" target="_blank">
                                <img src="{{ asset($commitment->txtPhoto) }}" alt="Commitment Image" width="150">
                            </a>
                        @else
                            No Image
                        @endif
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">User</div>
                    <div class="col-lg-10"><a href="javascript:void(0);">{{ $commitment->user->txtName ?? 'Unknown' }}</a></div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Inserted By</div>
                    <div class="col-lg-10"><a href="javascript:void(0);">{{ $commitment->txtInsertedBy ?? '-' }}</a></div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Datetime Inserted</div>
                    <div class="col-lg-10"><a href="javascript:void(0);">{{ $commitment->dtmInserted ?? '-' }}</a></div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Updated By</div>
                    <div class="col-lg-10"><a href="javascript:void(0);">{{ $commitment->txtUpdatedBy ?? '-' }}</a></div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Datetime Updated</div>
                    <div class="col-lg-10"><a href="javascript:void(0);">{{ $commitment->dtmUpdated ?? '-' }}</a></div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Active Status</div>
                    <div class="col-lg-10">
                        @if ($commitment->bitActive == 1)
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
