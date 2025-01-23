@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        <h1><u>Edit Event</u></h1>

        <form action="{{ route('teacher.events.update',['event'=>$event->id]) }}" method="post" id="gradeForm">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" name="name" class="form-control" id="exampleFormControlInput1" value="{{ $event->name }}">
                <div id="name-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Detail</label>
                <textarea class="form-control" name="detail" id="exampleFormControlTextarea1" rows="3" >{{ $event->detail }}</textarea>
                <div id="detail-error" class="error"></div>
            </div>

            
            
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Start Date & Time</label>
                <input type="datetime-local" name="start_date_time" class="form-control" id="exampleFormControlInput1" value="{{ $event->start_date_time }}">
                <div id="start_date_time-error" class="error"></div>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">End Date & Time</label>
                <input type="datetime-local" name="end_date_time" class="form-control" id="exampleFormControlInput1" value="{{ $event->end_date_time }}">
                <div id="end_date_time-error" class="error"></div>
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
                            window.location.href = "{{ route('teacher.events.index') }}";
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
