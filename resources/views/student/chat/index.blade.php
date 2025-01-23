@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <h1><u>Message Your Teacher</u></h1>
        
        <form class="php-email-form" id="gradeForm" action="{{ route('student.chat.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Subject</label>
                <input type="text" name="subject" class="form-control" id="exampleFormControlInput1" placeholder="Issue Regarding Course Outline,etc">
                <div id="subject-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Body</label>
                <textarea class="form-control" name="body" id="exampleFormControlTextarea1" rows="3" placeholder="Write your message here ..."></textarea>
                <div id="body-error" class="error"></div>
            </div>
            
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Select Teacher</label>
                <select name="teacher_id" class="form-control js-select2-custom" id="exampleFormControlInput1">
                    <option disabled selected value="">---Select Teacher---</option>
                    @foreach ($allotments as $allotment)
                    <option value="{{ $allotment->teacher->id }}">{{ $allotment->teacher->user->name }}</option>
                    @endforeach
                </select>
                <div id="teacher_id-error" class="error"></div>
            </div>
            
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Upload File (ppt,pdf,docx) (Optional)</label>
                <input type="file" name="file" class="form-control" id="exampleFormControlInput1">
                <div id="file-error" class="error"></div>
            </div>
            
            <button type="submit" class="btn btn-primary">Send</button>
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
                            window.location.href = "{{ route('student.chat.index') }}";
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
