@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <h1><u>Add Event</u></h1>
        <form class="php-email-form" id="gradeForm" action="{{ route('teacher.events.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="IEEE Seminar">
                <div id="name-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Detail</label>
                <textarea class="form-control" name="detail" id="exampleFormControlTextarea1" rows="3" placeholder="Add description or instructions about event"></textarea>
                <div id="detail-error" class="error"></div>
            </div>
            
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Start Date & Time</label>
                <input type="datetime-local" name="start_date_time" class="form-control" id="exampleFormControlInput1">
                <div id="start_date_time-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">End Date & Time</label>
                <input type="datetime-local" name="end_date_time" class="form-control" id="exampleFormControlInput1">
                <div id="end_date_time-error" class="error"></div>
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
                            window.location.href = "{{ route('teacher.events.index') }}";
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
