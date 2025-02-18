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
                <li class="breadcrumb-item"><a href="{{ route('geeting-commitment.index') }}">Geeting Commitment Data</a></li>
                <li class="breadcrumb-item">Restore Geeting Commitment</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card stretch stretch-full">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table-hover table" id="gettingCommitmentTable">
                            <thead>
                                <tr>
                                    <th>Number <i class="feather-filter"></i></th>
                                    <th>Commitment User <i class="feather-filter"></i></th>
                                    <th>Commitment <i class="feather-filter"></i></th>
                                    <th>Photo <i class="feather-filter"></i></th>
                                    <th>Status <i class="feather-filter"></i></th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deletedCommitments as $index => $commitment)
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
                                            <span class="badge {{ $commitment->bitActive ? 'bg-success' : 'bg-danger' }}">
                                                {{ $commitment->bitActive ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="hstack justify-content-end gap-2">
                                                <a href="{{ route('geeting-commitment.show', $commitment->intGeeting_ID) }}"
                                                    class="avatar-text avatar-md">
                                                    <i class="feather feather-eye"></i>
                                                </a>
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" class="avatar-text avatar-md"
                                                        data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                        <i class="feather feather-more-horizontal"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <form
                                                                action="{{ route('geeting-commitment.restore-geeting-commitment', $commitment->intGeeting_ID) }}"
                                                                method="POST" class="d-inline delete-form">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="dropdown-item"
                                                                    data-confirm-reset="true">
                                                                    <i class="feather feather-alert-octagon me-3"></i>
                                                                    <span>Restore Commitment</span>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.getElementById('gettingCommitmentTable');
            const dataTable = new DataTable(table);

            // Add SweetAlert2 delete confirmation
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    Swal.fire({
                        title: `Are you sure you want to restore the Commitment?`,
                        text: "This action cannot be undone.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, restore it!',
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
