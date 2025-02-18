@extends('admin-layouts.master')

@section('title', 'Edit Greeting Commitment')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Edit Greeting Commitment</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item"><a href="{{ route('geeting-commitment.index') }}">Greeting Commitment Data</a>
                </li>
                <li class="breadcrumb-item">Edit Greeting Commitment</li>
            </ul>
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
                            <h5 class="fw-bold mb-4">Edit Greeting Commitment</h5>
                            <form action="{{ route('geeting-commitment.update', $commitment->intGeeting_ID) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Input Commitment Text -->
                                <div class="mb-3">
                                    <label for="txtCommitment" class="form-label fw-semibold">Commitment Text</label>
                                    <textarea class="form-control @error('txtCommitment') is-invalid @enderror" id="txtCommitment" name="txtCommitment"
                                        rows="4" required>{{ old('txtCommitment', $commitment->txtCommitment) }}</textarea>
                                    @error('txtCommitment')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Input Commitment Photo -->
                                <div class="mb-3">
                                    <label for="txtPhoto" class="form-label fw-semibold">Commitment Photo</label>
                                    <input type="file" class="form-control @error('txtPhoto') is-invalid @enderror"
                                        id="txtPhoto" name="txtPhoto" accept="image/*">
                                    <small>Leave blank if you don't want to change the image.</small>
                                    @if ($commitment->txtPhoto)
                                        <div class="mt-2">
                                            <img src="{{ asset($commitment->txtPhoto) }}" alt="Commitment Image"
                                                width="150">
                                        </div>
                                    @endif
                                    @error('txtPhoto')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
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

    @include('sweetalert::alert')
@endsection
