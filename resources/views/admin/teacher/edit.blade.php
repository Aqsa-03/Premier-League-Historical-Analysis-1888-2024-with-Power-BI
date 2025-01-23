@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@section('content')
    <div class="container mt-5">

    <h1><u>Edit Teacher</u></h1>

    <form action="{{ route('admin.teachers.update',['teacher'=>$teacher->id]) }}" method="post" id="gradeForm">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input type="text" name="name" value="{{ $teacher->user->name }}" class="form-control" id="exampleFormControlInput1" placeholder="Parallel And Distributed Systems">
            <div id="name-error" class="error"></div>
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="text" name="email" value="{{ $teacher->user->email }}" class="form-control" id="exampleFormControlInput1" placeholder="CS-687">
            <div id="email-error" class="error"></div>
        </div>
        
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Select Department</label>
            <select name="department_id" class="form-control js-select2-custom" id="exampleFormControlInput1">
                <option disabled selected value="">---Select Department---</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}" {{ $department->id == $teacher->department_id ? 'selected' : '' }}>{{ $department->name }}</option>
                @endforeach
            </select>
            <div id="department_id-error" class="error"></div>
        </div>
        
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Status</label>
            <select name="status" class="form-control js-select2-custom" id="exampleFormControlInput1">
                <option value="" disabled>--- Select Status ---</option>
                <option value="active" {{ $teacher->user->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $teacher->user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            <div id="status-error" class="error"></div>
        </div>
          
          <button type="submit" class="btn btn-primary">Submit</button>
        
        </div>
    </form>

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
                            // Redirect to the desired page
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