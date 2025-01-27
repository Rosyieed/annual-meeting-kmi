@extends('admin-layouts.master')

@section('title', 'Question Information')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Question Information</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item"><a href="{{ route('master.questions.index') }}">Question and Answer Data</a></li>
                <li class="breadcrumb-item">Question Information</li>
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
                        <span class="d-block mb-2">Question Information :</span>
                        <span class="fs-12 fw-normal text-muted d-block">Details about the question and its answers</span>
                    </h5>
                </div>

                <!-- Question Information -->
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Question</div>
                    <div class="col-lg-10"><a href="javascript:void(0);">{{ $question->txtQuestion }}</a></div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Inserted By</div>
                    <div class="col-lg-10"><a href="javascript:void(0);">{{ $question->txtInsertedBy ?? '-' }}</a></div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Datetime Inserted</div>
                    <div class="col-lg-10"><a href="javascript:void(0);">{{ $question->dtmInserted ?? '-' }}</a></div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Updated By</div>
                    <div class="col-lg-10"><a href="javascript:void(0);">{{ $question->txtUpdatedBy ?? '-' }}</a></div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Datetime Updated</div>
                    <div class="col-lg-10"><a href="javascript:void(0);">{{ $question->dtmUpdated ?? '-' }}</a></div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Active Status</div>
                    <div class="col-lg-10">
                        @if ($question->bitActive == 1)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Not Active</span>
                        @endif
                    </div>
                </div>

                <!-- Answers Information -->
                <hr>
                <div class="row mb-4">
                    <div class="col-lg-2 fw-medium">Answers</div>
                    <div class="col-lg-10">
                        @forelse ($question->answers as $answer)
                            <div class="mb-2">
                                <span>{{ $loop->iteration }}. {{ $answer->txtAnswer }} - </span>
                                <span class="badge {{ $answer->bitActive == 1 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $answer->bitActive == 1 ? 'Active' : 'Not Active' }}
                                </span>
                            </div>
                        @empty
                            <span>No answers available</span>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
