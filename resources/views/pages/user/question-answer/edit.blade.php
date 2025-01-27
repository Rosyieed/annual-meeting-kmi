{{-- Edit Question and Answer Blade Template --}}
@extends('admin-layouts.master')

@section('title', 'Edit Question and Answer')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Edit Question and Answer</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item"><a href="{{ route('master.questions.index') }}">Question Data</a></li>
                <li class="breadcrumb-item">Edit Question</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-top-0">
                <div class="card-body personal-info">
                    <h5 class="fw-bold mb-4">Edit Question</h5>
                    <form action="{{ route('master.questions.update', $question->intQuestion_ID) }}" method="POST">
                        @csrf
                        @method('PUT')

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
                                        value="{{ $question->txtQuestion }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Answers Inputs -->
                        <div id="answers-section">
                            @foreach ($question->answers as $index => $answer)
                                <div class="row align-items-center answer-row mb-4">
                                    <div class="col-lg-4">
                                        <label for="txtAnswer" class="fw-semibold">Answer {{ $index + 1 }}: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-check-square"></i></div>
                                            <input type="text" class="form-control"
                                                name="answers[{{ $index }}][txtAnswer]"
                                                value="{{ $answer->txtAnswer }}" required>
                                            <button type="button"
                                                class="btn btn-danger btn-sm remove-answer-btn ms-2">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" class="btn btn-sm btn-light-brand mb-2 mt-2" id="add-answer-btn">Add Another
                            Answer</button>

                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-secondary me-2">Clear</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let answerIndex = {{ count($question->answers) }};

        document.getElementById('add-answer-btn').addEventListener('click', function() {
            const newAnswerHtml = `
                <div class="row align-items-center mb-4 answer-row">
                    <div class="col-lg-4">
                        <label for="txtAnswer" class="fw-semibold">Answer ${answerIndex + 1}: </label>
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
            document.getElementById('answers-section').insertAdjacentHTML('beforeend', newAnswerHtml);
            answerIndex++;
        });

        document.getElementById('answers-section').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-answer-btn')) {
                const answerRow = event.target.closest('.answer-row');
                answerRow.remove();
            }
        });
    </script>
@endsection
