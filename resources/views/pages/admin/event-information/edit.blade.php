@extends('admin-layouts.master')

@section('title', 'Edit Event Information')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Edit Event Information</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item"><a href="{{ route('master.event-informations.index') }}">Event Information Data</a>
                </li>
                <li class="breadcrumb-item">Edit Event Information</li>
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
                            <h5 class="fw-bold mb-4">Edit Event Information</h5>
                            <form action="{{ route('master.event-informations.update', $eventInformation->intEventInformation_ID) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="txtModalTitle" class="form-label fw-semibold">Title</label>
                                    <input type="text" class="form-control @error('txtModalTitle') is-invalid @enderror"
                                        id="txtModalTitle" name="txtModalTitle"
                                        value="{{ old('txtModalTitle', $eventInformation->txtModalTitle) }}" required>
                                    @error('txtModalTitle')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="txtModalContent" class="form-label fw-semibold">Content</label>
                                    <textarea class="form-control @error('txtModalContent') is-invalid @enderror" id="txtModalContent"
                                        name="txtModalContent" rows="4" required>{{ old('txtModalContent', $eventInformation->txtModalContent) }}</textarea>
                                    @error('txtModalContent')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="txtModalImagePath" class="form-label fw-semibold">Image</label>
                                    <input type="file"
                                        class="form-control @error('txtModalImagePath') is-invalid @enderror"
                                        id="txtModalImagePath" name="txtModalImagePath" accept="image/*">
                                    <small>Leave blank if you don't want to change the image.</small>
                                    @if ($eventInformation->txtModalImagePath)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $eventInformation->txtModalImagePath) }}"
                                                alt="Event Image" width="150">
                                        </div>
                                    @endif
                                    @error('txtModalImagePath')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="txtModalLink" class="form-label fw-semibold">Link</label>
                                    <input type="text" class="form-control @error('txtModalLink') is-invalid @enderror"
                                        id="txtModalLink" name="txtModalLink"
                                        value="{{ old('txtModalLink', $eventInformation->txtModalLink) }}" required>
                                    @error('txtModalLink')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
