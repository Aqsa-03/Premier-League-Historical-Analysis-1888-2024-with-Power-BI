@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        <h1><u>quiz</u></h1>

        <form action="{{ route('student.quizzes.store') }}" method="post" id="gradeForm" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="{{ $quiz->title }}" readonly>
                <div id="title-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" readonly rows="3" >{{ $quiz->description }}</textarea>
                <div id="description-error" class="error"></div>
            </div>
            
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Class</label>
                <input type="text" name="class_id" class="form-control" id="exampleFormControlInput1" value="{{ $quiz->classCourse->name }} " readonly>
                <div id="title-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Course</label>
                <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="{{  $quiz->course->name  }}" readonly>
                <div id="title-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Due Date & Time</label>
                <input readonly type="datetime-local" name="due_date" class="form-control" id="exampleFormControlInput1" value="{{ $quiz->due_date_time }}">
                <div id="due_date-error" class="error"></div>
            </div>

            @if($quiz->file ?? false)
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Download File</label>
                    <button onclick="window.location='{{ asset($quiz->file) }}'" class="download-button">
                        <img src="{{ asset('images/download-32.png') }}" alt="Download">
                        {{ $quiz->title }}
                    </button>
                </div>
            @endif

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Upload File</label>
                <input type="file" name="file" class="form-control" id="exampleFormControlInput1">
                <div id="file-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Comment (Optional)</label>
                <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3" placeholder="Write something here ..."></textarea>
                <div id="comment-error" class="error"></div>
            </div>
            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

            <button type="submit" class="btn btn-primary" >Upload</button>

        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#gradeForm').submit(function(e) {
                e.preventDefault();
                var userConfirmed = confirm('Are you sure you want to submit this quiz? You cannot make changes after submission.');

                if (userConfirmed) {
                    var form = $(this);
                    var url = form.attr('action');
                    var data = new FormData(form[0]);

                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: data,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                window.location.href = "{{ route('student.quizzes.index') }}";
                            } else {
                                window.location.href = "{{ route('student.quizzes.index') }}";
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            var response = xhr.responseJSON;
                            if (response.hasOwnProperty('errors')) {
                                var errors = response.errors;
                                for (var key in errors) {
                                    if (errors.hasOwnProperty(key)) {
                                        var errorMessages = errors[key];
                                        var errorContainer = $('#' + key + '-error');
                                        errorContainer.text(errorMessages[0]);
                                        errorContainer.show().addClass('text-danger');
                                        errorContainer.addClass('error');
                                        (function(errorContainer) {
                                            setTimeout(function() {
                                                errorContainer.text('');
                                                errorContainer.hide().removeClass('text-danger');
                                            }, 3000);
                                        })(errorContainer);
                                    }
                                }
                            }
                        }
                    });
                }
            });
        });
    </script>
    
@endsection
