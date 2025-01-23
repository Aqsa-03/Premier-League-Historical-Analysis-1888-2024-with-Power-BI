@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        <h1><u>Message</u></h1>

        <form action="{{ route('teacher.chat.update',['chat' => $chat->id]) }}" method="post" id="gradeForm" enctype="multipart/form-data">
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

            @if($chat->file ?? false)
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Uploaded File</label>
                    <button onclick="window.location='{{ asset($chat->file  ) }}'" class="download-button">
                        <img src="{{ asset('images/download-32.png') }}" alt="Download">
                    </button>
                </div>
            @endif

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Reply</label>
                <textarea class="form-control" name="reply" id="exampleFormControlTextarea1" rows="3" placeholder="Write Your Response here ..."></textarea>
                <div id="reply-error" class="error"></div>
            </div>
            
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Upload File (ppt,pdf,docx) (Optional)</label>
                <input type="file" name="teacher_file" class="form-control" id="exampleFormControlInput1">
                <div id="teacher_file-error" class="error"></div>
            </div>

            <button type="submit" class="btn btn-primary">Send</button>
            

        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#gradeForm').submit(function(e) {
                e.preventDefault();
                var userConfirmed = confirm('Are you sure you want to send the reply? You cannot make changes after submission.');
                if(userConfirmed)
                {
                var form = $(this);
                var url = form.attr('action');
                var data = new FormData(form[0]);

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: data,
                    contentType: false, // Set to false for FormData
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            window.location.href = "{{ route('teacher.chat.index') }}";
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
            }
            });
        });
    </script>
    {{-- <script>
      <script>
function markNotificationRead(notificationId) {
    console.log(notificationId)
    $.ajax({
        url: "{{ route('teacher.notification.markRead', $notification->id) }}",
        method: 'PATCH',
        success: function(response) {
            // Update the notification badge count
            updateNotificationBadgeCount();
            // Remove the notification from the dropdown menu
            $("#notification-link-" + notificationId).remove();
        }
    });
}
</script>


    </script> --}}
    
    
    
@endsection
