@extends('admin-layouts.master')

@section('title', 'Create Event Information')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Create Event Information</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item"><a href="{{ route('master.event-informations.index') }}">Event Information Data</a>
                </li>
                <li class="breadcrumb-item">Create Event Information</li>
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
                            <h5 class="fw-bold mb-4">Create Event Information</h5>
                            <form action="{{ route('master.event-informations.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="txtModalTitle" class="form-label fw-semibold">Title</label>
                                    <input type="text" class="form-control @error('txtModalTitle') is-invalid @enderror"
                                        id="txtModalTitle" name="txtModalTitle" value="{{ old('txtModalTitle') }}" required>
                                    @error('txtModalTitle')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="txtModalContent" class="form-label fw-semibold">Content</label>
                                    <textarea class="form-control @error('txtModalContent') is-invalid @enderror" id="txtModalContent"
                                        name="txtModalContent" rows="4" required>{{ old('txtModalContent') }}</textarea>
                                    @error('txtModalContent')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="txtModalImagePath" class="form-label fw-semibold">Image</label>
                                    <input type="file"
                                        class="form-control @error('txtModalImagePath') is-invalid @enderror"
                                        id="txtModalImagePath" name="txtModalImagePath" accept="image/*" required>
                                    @error('txtModalImagePath')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="txtModalLink" class="form-label fw-semibold">Link</label>
                                    <input type="text" class="form-control @error('txtModalLink') is-invalid @enderror"
                                        id="txtModalLink" name="txtModalLink" value="{{ old('txtModalLink') }}" required>
                                    @error('txtModalLink')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
