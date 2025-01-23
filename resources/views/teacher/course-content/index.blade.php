@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <h1><u>Add Course Content</u></h1>
        <form class="php-email-form" id="gradeForm" action="{{ route('teacher.course-content.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="PDC Lec # 5">
                <div id="title-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description (optional)</label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" placeholder="Add description or instructions about course content"></textarea>
                <div id="description-error" class="error"></div>
            </div>

            
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Select Class</label>
                <select name="class_course_id" class="form-control js-select2-custom" id="exampleFormControlInput1">
                    <option disabled selected value="">---Select Class---</option>
                    @foreach ($allotments as $allotment)
                    <option value="{{ $allotment->classCourse->id }}">{{ $allotment->classCourse->name }}</option>
                    @endforeach
                </select>
                <div id="class_course_id-error" class="error"></div>
            </div>
            
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Select Course</label>
                <select name="course_id" class="form-control js-select2-custom" id="exampleFormControlInput1">
                    <option disabled selected value="">---Select Course---</option>
                    @foreach ($allotments as $allotment)
                    <option value="{{ $allotment->course->id }}">{{ $allotment->course->name }}</option>
                    @endforeach
                </select>
                <div id="course_id-error" class="error"></div>
            </div>
            
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Recorded Lecture Link</label>
                <textarea class="form-control" name="link" id="exampleFormControlTextarea1" rows="3" placeholder="https://drive.google.com/file/d/69fwo/view?usp=sharing"></textarea>
                <div id="link-error" class="error"></div>
            </div>
            
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Upload File (ppt,pdf,docx)</label>
                <input type="file" name="file" class="form-control" id="exampleFormControlInput1">
                <div id="file-error" class="error"></div>
            </div>
            
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function()
        {
            $('#gradeForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var data = new FormData(form[0]);

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: data,
                    contentType: false, // Set to false for FormData
                    processData: false, // Set to false for FormData
                    success: function(response) {
                        if (response.success) {
                            window.location.href = "{{ route('teacher.course-content.index') }}";
                        } else {
                            form[0].reset();
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.log(xhr.responseText);
                        var response = xhr.responseJSON;
                        if (response.hasOwnProperty('errors')) {
                            var errors = response.errors;
                            // Display the validation errors in the respective error container
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    var errorMessages = errors[key];
                                    var errorContainer = $('#' + key + '-error');
                                    errorContainer.text(errorMessages[0]);
                                    errorContainer.show().addClass('text-danger');
                                    errorContainer.addClass('error');
                                    // Hide the error message after a few seconds (e.g., 3 seconds)
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
            });
});

    </script>
@endsection
