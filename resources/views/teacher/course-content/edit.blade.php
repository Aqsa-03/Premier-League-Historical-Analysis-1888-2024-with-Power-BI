@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        <h1><u>Edit Course Content</u></h1>

        <form action="{{ route('teacher.course-content.update',['course_content'=>$courseContent->id]) }}" method="post" id="gradeForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="{{ $courseContent->title }}">
                <div id="title-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" >{{ $courseContent->description }}</textarea>
                <div id="description-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Select Class</label>
                <select name="class_course_id" class="form-control js-select2-custom" id="exampleFormControlInput1">
                    <option disabled selected value="">---Select Class---</option>
                    @foreach ($allotments as $allotment)
                        <option value="{{ $allotment->classCourse->id }}" {{ $courseContent->class_course_id == $allotment->classCourse->id ? 'selected' : '' }}>{{ $allotment->classCourse->name }}</option>
                    @endforeach
                </select>
                <div id="class_course_id-error" class="error"></div>
            </div>
            
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Select Course</label>
                <select name="course_id" class="form-control js-select2-custom" id="exampleFormControlInput1">
                    <option disabled selected value="">---Select Course---</option>
                    @foreach ($allotments as $allotment)
                        <option value="{{ $allotment->course->id }}" {{ $courseContent->course_id == $allotment->course->id ? 'selected' : '' }}>{{ $allotment->course->name }}</option>
                    @endforeach
                </select>
                <div id="course_id-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Recorded Lecture Link</label>
                <textarea class="form-control" name="link" id="exampleFormControlTextarea1" rows="3" placeholder="https://drive.google.com/file/d/69fwo/view?usp=sharing">{{ $courseContent->link }}</textarea>
                <div id="link-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Upload File (ppt,pdf,docx)</label>
                <input type="file" name="file" class="form-control" id="exampleFormControlInput1">
                <div id="file-error" class="error"></div>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>

        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#gradeForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var data = new FormData(form[0]);
                // var data = form.serialize();

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: data,
                    contentType: false, // Set to false for FormData
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            window.location.href = "{{ route('teacher.course-content.index') }}";
                        } else {
                            form[0].reset();
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
            });
        });
    </script>
@endsection
