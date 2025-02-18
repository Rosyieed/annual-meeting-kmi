@extends('admin-layouts.master')

@section('title', 'Geeting Commitment Data')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Geeting Commitment Data</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item">Geeting Commitment Data</li>
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
                <div class="d-flex align-items-center page-header-right-items-wrapper gap-2">
                    <!-- Button Group -->
                    <div class="btn-group" role="group">
                        {{-- <a href="#" class="btn btn-primary">
                            <i class="feather-plus me-2"></i>
                            <span>Create Geeting Commitment</span>
                        </a> --}}
                        <a href="{{route('geeting-commitment.restore-index')}}" class="btn btn-secondary">
                            <i class="feather-list me-2"></i>
                            <span>Restore Geeting Commitment</span>
                        </a>
                    </div>
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
            <div class="card stretch stretch-full">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table-hover table" id="commitmentTable">
                            <thead>
                                <tr>
                                    <th>Number <i class="feather-filter"></i></th>
                                    <th>Commitment User<i class="feather-filter"></i></th>
                                    <th>Commitment <i class="feather-filter"></i></th>
                                    <th>Commitment Photo <i class="feather-filter"></i></th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($geetingCommitments as $index => $commitment)
                                    <tr class="single-item fs-12">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $commitment->user->txtName }}</td>
                                        <td>{{ $commitment->txtCommitment }}</td>
                                        <td>
                                            @if ($commitment->txtPhoto)
                                                <a href="{{ asset($commitment->txtPhoto) }}" target="_blank">
                                                    <img src="{{ asset($commitment->txtPhoto) }}" alt="Commitment Image"
                                                        style="max-width: 100px; max-height: 100px;">
                                                </a>
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>
                                            <div class="hstack justify-content-end gap-2">
                                                {{-- show --}}
                                                <a href="{{ route('geeting-commitment.show', $commitment->intGeeting_ID) }}"
                                                    class="avatar-text avatar-md">
                                                    <i class="feather feather-eye"></i>
                                                </a>

                                                <!-- Dropdown Delete -->
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" class="avatar-text avatar-md"
                                                        data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                        <i class="feather feather-more-horizontal"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <!-- Edit -->
                                                            <a href="{{ route('geeting-commitment.edit', $commitment->intGeeting_ID) }}"
                                                                class="dropdown-item">
                                                                <i class="feather feather-edit-3"></i><span>Edit</span>
                                                            </a>
                                                        </li>
                                                        <li class="dropdown-divider"></li>
                                                        <li>
                                                            <form
                                                                action="{{ route('geeting-commitment.delete', $commitment->intGeeting_ID) }}"
                                                                method="POST" class="d-inline delete-form">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="dropdown-item delete-btn">
                                                                    <i class="feather feather-trash-2 me-3"></i>
                                                                    <span>Delete</span>
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.getElementById('commitmentTable');
            const dataTable = new DataTable(table);

            // SweetAlert2 delete confirmation
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    Swal.fire({
                        title: `Are you sure you want to delete this commitment?`,
                        text: "This action cannot be undone.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel',
                    }).then((result) => {
                        if (result.value === true) {
                            form.submit();
                        } else {}
                    });
                });
            });
        });
    </script>

    @include('sweetalert::alert')
@endsection
