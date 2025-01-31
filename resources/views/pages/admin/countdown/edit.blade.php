@extends('admin-layouts.master')

@section('title', 'Edit Countdown Congratulation')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Edit Countdown Congratulation</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item"><a href="{{ route('master.countdowns.index') }}">Countdown Congratulation Data</a>
                </li>
                <li class="breadcrumb-item">Edit Countdown Congratulation</li>
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
                                    <span class="d-block mb-2">Edit Countdown Congratulation</span>
                                    <span class="fs-12 fw-normal text-muted text-truncate-1-line">Please fill in the
                                        details below:</span>
                                </h5>
                            </div>
                            <form action="{{ route('master.countdowns.update', $countdown->intCountdownTeam_ID) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row align-items-center mb-4">
                                    <div class="col-lg-4">
                                        <label for="dtmStartTime" class="fw-semibold">Start Time: </label>
                                        @error('dtmStartTime')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-calendar"></i></div>
                                            <input type="datetime-local" class="form-control" id="dtmStartTime" name="dtmStartTime"
                                                value="{{ $countdown->dtmStartTime }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-secondary me-2">Clear</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
