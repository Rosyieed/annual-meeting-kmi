@extends('admin-layouts.master')

@section('title', 'Question and Answer Data')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Question and Answer Data</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item">Question and Answer Data</li>
            </ul>
        </div>
        <div class="page-header-right ms-auto">
            <div class="page-header-right-items">
                <div class="btn-group" role="group">
                    <a href="{{ route('master.questions.create') }}" class="btn btn-primary">
                        <i class="feather-plus me-2"></i>
                        <span>Create Question</span>
                    </a>
                    <a href="{{ route('master.questions.restore-index') }}" class="btn btn-secondary">
                        <i class="feather-list me-2"></i>
                        <span>Restore Question</span>
                    </a>
                </div>
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
                        <table class="table-hover table" id="questionTable">
                            <thead>
                                <tr>
                                    <th>Number <i class="feather-filter"></i></th>
                                    <th>Question <i class="feather-filter"></i></th>
                                    <th>Answers <i class="feather-filter"></i></th>
                                    <th>Status <i class="feather-filter"></i></th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $index => $question)
                                    <tr class="single-item fs-12">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $question->txtQuestion }}</td>
                                        <td>
                                            <ul>
                                                @foreach ($question->answers as $answer)
                                                    <li>{{ $answer->txtAnswer }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <span class="badge {{ $question->bitActive ? 'bg-success' : 'bg-danger' }}">
                                                {{ $question->bitActive ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="hstack justify-content-end gap-2">
                                                {{-- <a href="{{ route('questions.show', $question->intQuestion_ID) }}" --}}
                                                <a href="{{ route('master.questions.show', $question->intQuestion_ID) }}"
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
                                                                href="{{ route('master.questions.edit', $question->intQuestion_ID) }}">
                                                                <i class="feather feather-edit-3 me-3"></i>
                                                                <span>Edit</span>
                                                            </a>
                                                        </li>
                                                        <li class="dropdown-divider"></li>
                                                        <li>
                                                            <form {{-- action="{{ route('questions.delete', $question->intQuestion_ID) }}" --}}
                                                                action="{{ route('master.questions.delete', $question->intQuestion_ID) }}"
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
            const table = document.getElementById('questionTable');
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
