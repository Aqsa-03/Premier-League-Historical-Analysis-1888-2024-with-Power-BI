@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        <h1><u>Message</u></h1>

        <form action="" method="post" id="gradeForm">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Subject</label>
                <input type="text" name="subject" class="form-control" id="exampleFormControlInput1" readonly value="{{ $chat->subject }}">
                <div id="subject-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Body</label>
                <textarea class="form-control" name="body" id="exampleFormControlTextarea1" rows="3" readonly>{{ $chat->body }}</textarea>
                <div id="body-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Teacher's Reply</label>
                <textarea class="form-control" name="body" id="exampleFormControlTextarea1" rows="3" readonly>{{ $chat->reply ?? "None" }}</textarea>
                <div id="body-error" class="error"></div>
            </div>
            
            @if($chat->file ?? false)
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Uploaded File</label>
                    <button onclick="window.location='{{ asset($chat->file  ) }}'" class="download-button">
                        <img src="{{ asset('images/download-32.png') }}" alt="Download">
                    </button>
                </div>
            @endif

            @if($chat->teacher_file ?? false)
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Teacher's Uploaded File</label>
                    <button onclick="window.location='{{ asset($chat->teacher_file  ) }}'" class="download-button">
                        <img src="{{ asset('images/download-32.png') }}" alt="Download">
                    </button>
                </div>
            @endif

            

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
