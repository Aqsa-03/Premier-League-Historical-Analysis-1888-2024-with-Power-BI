@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <h1><u>Add Teacher</u></h1>
        <form class="php-email-form" id="gradeForm" action="{{ route('admin.teachers.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Afrasyab Haider">
                <div id="name-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Select Department</label>
                <select name="department_id" class="form-control js-select2-custom" id="exampleFormControlInput1">
                    <option disabled selected value="">---Select Department---</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
                <div id="department_id-error" class="error"></div>
            </div>
            <h3>Generate Login Credentials</h3>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="afrasyab@gmail.com">
                <div id="email-error" class="error"></div>
            </div>

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

            
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>

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
                            window.location.href = "{{ route('admin.teachers.index') }}";
                        } else {
                            form[0].reset();
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.log(xhr.responseText); // Output the full response for debugging
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
