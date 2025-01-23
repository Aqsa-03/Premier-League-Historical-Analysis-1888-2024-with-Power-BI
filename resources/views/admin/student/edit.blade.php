@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        <h1><u>Edit Student</u></h1>

        <form action="{{ route('admin.students.update',['student'=>$student->id]) }}" method="post" id="gradeForm">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="exampleFormControlInput1" value="{{ $student->user->name }}">
                <div id="name-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="exampleFormControlInput1" value="{{ $student->user->email }}">
                <div id="email-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Roll #</label>
                <input type="text" name="roll_no" class="form-control" id="exampleFormControlInput1" value="{{ $student->roll_no }}">
                <div id="roll_no-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Select Batch</label>
                <select name="batch_no" class="form-control js-select2-custom" id="exampleFormControlInput1">
                    <option disabled selected value="">---Select Batch---</option>
                    @foreach ($batches as $batch)
                        <option value="{{ $batch }}" {{ $batch == $student->batch_no ? 'selected' : '' }}>{{ $batch }}</option>
                    @endforeach
                </select>
                <div id="batch_no-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Select Department</label>
                <select name="department_id" class="form-control js-select2-custom" id="exampleFormControlInput1">
                    <option disabled selected value="">---Select Department---</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ $department->id == $student->department_id ? 'selected' : '' }}>{{ $department->name }}</option>
                    @endforeach
                </select>
                <div id="department_id-error" class="error"></div>
            </div>
    
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Select Semester</label>
                <select name="semester_id" class="form-control js-select2-custom" id="exampleFormControlInput1">
                    <option disabled selected value="">---Select Semester---</option>
                    @foreach ($semesters as $semester)
                        <option value="{{ $semester->id }}" {{ $semester->id == $student->semester_id ? 'selected' : '' }}>{{ $semester->name }}</option>
                    @endforeach
                </select>
                <div id="semester-error" class="error"></div>
            </div>
    
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Select Section</label>
                <select name="section_id" class="form-control js-select2-custom" id="exampleFormControlInput1">
                    <option disabled selected value="">---Select Section---</option>
                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}" {{ $section->id == $student->section_id ? 'selected' : '' }}>{{ $section->name }}</option>
                    @endforeach
                </select>
                <div id="section_id-error" class="error"></div>
            </div>
    
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Status</label>
                <select name="status" class="form-control js-select2-custom" id="exampleFormControlInput1">
                    <option value="" disabled>--- Select Status ---</option>
                    <option value="active" {{ $student->user->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $student->user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                <div id="status-error" class="error"></div>
            </div>
            
        
            <h3>Change Password</h3>
    
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleFormControlInput1" placeholder="">
                <div id="password-error" class="error"></div>
            </div>
    
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="exampleFormControlInput1" placeholder="">
                <div id="password_confirmation-error" class="error"></div>
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
                            window.location.href = "{{ route('admin.students.index') }}";
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
