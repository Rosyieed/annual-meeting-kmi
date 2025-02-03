@extends('admin-layouts.master')

@section('title', 'Event Information Data')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Event Information Data</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item">Event Information Data</li>
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
                        <a href="{{ route('master.event-informations.create') }}" class="btn btn-primary">
                            <i class="feather-plus me-2"></i>
                            <span>Create Event Information</span>
                        </a>
                        <a href="{{ route('master.event-informations.restore-index') }}" class="btn btn-secondary">
                            <i class="feather-list me-2"></i>
                            <span>Restore Event Information</span>
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
                        <table class="table-hover table" id="userTable">
                            <thead>
                                <tr>
                                    <th>Number<i class="feather-filter"></i></th>
                                    <th>Title <i class="feather-filter"></i></th>
                                    <th>Content <i class="feather-filter"></i></th>
                                    <th>Image <i class="feather-filter"></i></th>
                                    <th>Link <i class="feather-filter"></i></th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($eventInformations as $index => $eventInformation)
                                    <tr class="single-item fs-12">
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            {{ $eventInformation->txtModalTitle }}
                                        </td>
                                        <td>{{ $eventInformation->txtModalContent }}</td>
                                        <td>
                                            @if ($eventInformation->txtModalImagePath)
                                                <a href="{{ asset('storage/' . $eventInformation->txtModalImagePath) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('storage/' . $eventInformation->txtModalImagePath) }}"
                                                        alt="Event Image" style="max-width: 100px; max-height: 100px;">
                                                </a>
                                            @else
                                                No Image
                                            @endif
                                        </td>

                                        <td><a
                                                href="{{ $eventInformation->txtModalLink }}" style="font-weight: normal" target="__blank">{{ $eventInformation->txtModalLink }}</a>
                                        </td>
                                        <td>
                                            <div class="hstack justify-content-end gap-2">
                                                {{-- <a href="{{ route('master.users.show', $user->intUser_ID) }}" --}}
                                                <a href="{{ route('master.event-informations.show', $eventInformation->intEventInformation_ID) }}"
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
                                                            <a class="dropdown-item"
                                                                href="{{ route('master.event-informations.edit', $eventInformation->intEventInformation_ID) }}">
                                                                <i class="feather feather-edit-3 me-3"></i>
                                                                <span>Edit</span>
                                                            </a>
                                                        </li>
                                                        {{-- <li>
                                                            <a class="dropdown-item printBTN" href="javascript:void(0)">
                                                                <i class="feather feather-printer me-3"></i>
                                                                <span>Print</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0)">
                                                                <i class="feather feather-clock me-3"></i>
                                                                <span>Remind</span>
                                                            </a>
                                                        </li>
                                                        <li class="dropdown-divider"></li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0)">
                                                                <i class="feather feather-archive me-3"></i>
                                                                <span>Archive</span>
                                                            </a>
                                                        </li> --}}
                                                        <li class="dropdown-divider"></li>
                                                        <li>
                                                            <form
                                                                action="{{ route('master.event-informations.delete', $eventInformation->intEventInformation_ID) }}"
                                                                method="POST" class="d-inline delete-form">
                                                                @csrf
                                                                @method('put')
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.getElementById('userTable');
            const dataTable = new DataTable(table);

            // Add SweetAlert2 delete confirmation
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    Swal.fire({
                        title: `Are you sure you want to delete?`,
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
