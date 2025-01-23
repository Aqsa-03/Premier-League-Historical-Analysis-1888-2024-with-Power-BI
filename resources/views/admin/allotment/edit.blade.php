@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        <h1><u>Edit Allotment</u></h1>

        <form action="{{ route('admin.allotments.update',['allotment'=>$allotment->id]) }}" method="post" id="gradeForm">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Select Teacher</label>
                <select name="teacher_id" class="form-control js-select2-custom" id="exampleFormControlInput1">
                    <option disabled selected value="">---Select Teacher---</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ $teacher->id == $allotment->teacher_id ? 'selected' : '' }}>{{ $teacher->user->name }}</option>
                    @endforeach
                </select>
                <div id="teacher_id-error" class="error"></div>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Select Course</label>
                <select name="course_id" class="form-control js-select2-custom" id="exampleFormControlInput1">
                    <option disabled selected value="">---Select Course---</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}" {{ $course->id == $allotment->course_id ? 'selected' : '' }}>{{ $course->name }}</option>
                    @endforeach
                </select>
                <div id="course_id-error" class="error"></div>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Select Class</label>
                <select name="class_course_id" class="form-control js-select2-custom" id="exampleFormControlInput1">
                    <option disabled selected value="">---Select Class---</option>
                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}" {{ $class->id == $allotment->class_course_id ? 'selected' : '' }}>{{ $class->name }}</option>
                    @endforeach
                </select>
                <div id="class_course_id-error" class="error"></div>
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
                var data = form.serialize();

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            window.location.href = "{{ route('admin.allotments.index') }}";
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
