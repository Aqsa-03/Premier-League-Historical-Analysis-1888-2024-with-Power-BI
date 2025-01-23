@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <h1><u>Add Course</u></h1>
        <form class="php-email-form" id="gradeForm" action="{{ route('admin.courses.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Parallel and Distributed Systems">
                <div id="name-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Code</label>
                <input type="text" name="code" class="form-control" id="exampleFormControlInput1" placeholder="CS-687">
                <div id="code-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Credit Hours</label>
                <select name="credit_hours" class="form-control js-select2-custom" id="exampleFormControlInput1">
                    <option disabled selected value="">---Select Credit Hours---</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                </select>
                <div id="credit_hours-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" placeholder="Add description about course"></textarea>
                <div id="description-error" class="error"></div>
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
                            window.location.href = "{{ route('admin.courses.index') }}";
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
