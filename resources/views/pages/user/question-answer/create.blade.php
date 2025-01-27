@extends('admin-layouts.master')

@section('title', 'Create Question and Answer')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Create Question and Answer</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item"><a href="{{ route('master.groups.index') }}">Question and Answer Data</a></li>
                <li class="breadcrumb-item">Create Question and Answer</li>
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
                    <div class="tab-pane fade show active" id="questionTab" role="tabpanel">
                        <div class="card-body personal-info">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h5 class="fw-bold mb-0 me-4">
                                    <span class="d-block mb-2">Create Question</span>
                                    <span class="fs-12 fw-normal text-muted text-truncate-1-line">Please fill in the
                                        question and its answers below:</span>
                                </h5>
                            </div>
                            <form action="{{ route('master.questions.store') }}" method="POST">
                                @csrf
                                <!-- Question Input -->
                                <div class="row align-items-center mb-4">
                                    <div class="col-lg-4">
                                        <label for="txtQuestion" class="fw-semibold">Question: </label>
                                        @error('txtQuestion')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-edit"></i></div>
                                            <input type="text" class="form-control" id="txtQuestion" name="txtQuestion"
                                                placeholder="Enter Question" required>
                                        </div>
                                    </div>
                                </div>

                                {{-- <!-- Answers Inputs -->
                                <div class="row mb-4" id="answers-section">
                                    <div class="col-lg-4">
                                        <label for="txtAnswer" class="fw-semibold">Answer: </label>
                                        @error('answers.*')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-check-square"></i></div>
                                            <input type="text" class="form-control" id="txtAnswer"
                                                name="answers[0][txtAnswer]" placeholder="Enter Answer" required>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-sm btn-light-brand mb-2 mt-2" id="add-answer-btn">
                                    Add Another Answer
                                </button> --}}

                                <!-- Answers Inputs -->
                                <div id="answers-section">
                                    <div class="row answer-row mb-4">
                                        <div class="col-lg-4">
                                            <label for="txtAnswer" class="fw-semibold">Answer 1: </label>
                                            @error('answers.*')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-check-square"></i></div>
                                                <input type="text" class="form-control" id="txtAnswer"
                                                    name="answers[0][txtAnswer]" placeholder="Enter Answer" required>
                                                <button type="button"
                                                    class="btn btn-danger btn-sm remove-answer-btn ms-2">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Add Answer Button -->
                                <div class="mb-4">
                                    <button type="button" id="add-answer-btn" class="btn btn-primary btn-sm">Add
                                        Answer</button>
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

    <script>
        let answerIndex = 1;

        // / Tambah Jawaban Baru
        document.getElementById('add-answer-btn').addEventListener('click', function() {
            const newAnswerHtml = `
        <div class="row mb-4 answer-row">
            <div class="col-lg-4">
                <label for="txtAnswer" class="fw-semibold">Answer ${answerIndex + 1}:</label>
            </div>
            <div class="col-lg-8">
                <div class="input-group">
                    <div class="input-group-text"><i class="feather-check-square"></i></div>
                    <input type="text" class="form-control" name="answers[${answerIndex}][txtAnswer]" placeholder="Enter Answer" required>
                    <button type="button" class="btn btn-danger btn-sm ms-2 remove-answer-btn">Remove</button>
                </div>
            </div>
        </div>
    `;

            // Tambahkan elemen baru di bawah elemen yang sudah ada
            document.getElementById('answers-section').insertAdjacentHTML('beforeend', newAnswerHtml);
            answerIndex++;
        });

        // Delegasi event untuk tombol hapus
        document.getElementById('answers-section').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-answer-btn')) {
                const answerRow = event.target.closest('.answer-row');
                answerRow.remove();
            }
        });
    </script>

@endsection
