@extends('admin-layouts.master')

@section('title', 'Geeting Button Countdown Data')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Geeting Button Countdown Data</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item">Geeting Button Countdown Data</li>
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
                    <div class="dropdown filter-dropdown">
                        <div class="btn-group" role="group">
                            <a href="{{ route('master.geeting-buttons.create') }}" class="btn btn-primary">
                                <i class="feather-plus me-2"></i>
                                <span>Create Geeting Button Countdown</span>
                            </a>
                            {{-- <a href="{{ route('master.geeting-buttons.restore-index') }}" class="btn btn-secondary">
                                <i class="feather-list me-2"></i>
                                <span>Restore Geeting Button Countdown</span>
                            </a> --}}
                        </div>
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
                        <table class="table-hover table" id="geetingButtonTable">
                            <thead>
                                <tr>
                                    <th>Number <i class="feather-filter"></i></th>
                                    <th>Show Date <i class="feather-filter"></i></th>
                                    <th>Inserted By <i class="feather-filter"></i></th>
                                    <th>Status <i class="feather-filter"></i></th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($geetingButtons as $index => $button)
                                    <tr class="single-item fs-12">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $button->dtmButtonShow }}</td>
                                        <td>{{ $button->txtInsertedBy }}</td>
                                        <td>
                                            <span class="badge {{ $button->bitActive ? 'bg-success' : 'bg-danger' }}">
                                                {{ $button->bitActive ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="hstack justify-content-end gap-2">
                                                {{-- <a href="{{ route('master.geeting-buttons.show', $button->intButtonCountdown_ID) }}"
                                                    class="avatar-text avatar-md">
                                                    <i class="feather feather-eye"></i>
                                                </a> --}}
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" class="avatar-text avatar-md"
                                                        data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                        <i class="feather feather-more-horizontal"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('master.geeting-buttons.edit', $button->intButtonCountdown_ID) }}">
                                                                <i class="feather feather-edit-3 me-3"></i>
                                                                <span>Edit</span>
                                                            </a>
                                                        </li>
                                                        <li class="dropdown-divider"></li>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('master.geeting-buttons.show', $button->intButtonCountdown_ID) }}"
                                                                class="avatar-text avatar-md">
                                                                <i class="feather feather-eye me-3"></i>
                                                                <span>Show</span>
                                                            </a>
                                                        </li>
                                                        {{-- <li>
                                                            <form
                                                                action="{{ route('master.geeting-buttons.delete', $button->intButtonCountdown_ID) }}"
                                                                method="POST" class="d-inline delete-form">
                                                                @csrf
                                                                @method('put')
                                                                <button type="submit" class="dropdown-item delete-btn">
                                                                    <i class="feather feather-trash-2 me-3"></i>
                                                                    <span>Delete</span>
                                                                </button>
                                                            </form>
                                                        </li> --}}
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
            const table = document.getElementById('geetingButtonTable');
            const dataTable = new DataTable(table);

            // Add SweetAlert2 delete confirmation
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    Swal.fire({
                        title: `Are you sure you want to delete this button?`,
                        text: "This action cannot be undone.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel',
                    }).then((result) => {
                        if (result.value === true) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

    @include('sweetalert::alert')
@endsection
