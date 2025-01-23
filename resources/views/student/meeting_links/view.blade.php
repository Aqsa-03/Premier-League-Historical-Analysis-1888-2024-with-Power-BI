@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        <h1><u>Meeting Link</u></h1>

        <form  >
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="{{ $meetingLink->title }}" readonly>
                <div id="title-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" readonly rows="3" >{{ $meetingLink->description }}</textarea>
                <div id="description-error" class="error"></div>
            </div>
            
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Class</label>
                <input type="text" name="class_id" class="form-control" id="exampleFormControlInput1" value="{{ $meetingLink->classCourse->name }} " readonly>
                <div id="title-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Course</label>
                <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="{{  $meetingLink->course->name  }}" readonly>
                <div id="title-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Date & Time</label>
                <input readonly type="datetime-local" name="due_date" class="form-control" id="exampleFormControlInput1" value="{{ $meetingLink->date_time }}">
                <div id="due_date-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Link</label>
                <div class="input-group">
                    <textarea class="form-control" id="link" rows="3" readonly>{{ $meetingLink->link }}</textarea>
                    <button class="btn btn-primary" type="button" onclick="copyToClipboard()">Copy Link</button>
                </div>
                <div id="comment-error" class="error"></div>
            </div>

        </form>

    </div>

    
    <script>
        function copyToClipboard() {
            var linkTextarea = document.getElementById("link");
            var linkText = linkTextarea.value;
    
            var tempInput = document.createElement("input");
            tempInput.value = linkText;
            document.body.appendChild(tempInput);
    
            tempInput.select();
            tempInput.setSelectionRange(0, 99999);
    
            document.execCommand("copy");
    
            document.body.removeChild(tempInput);
    
            alert("Link copied: " + linkText);
        }
    </script>
    
@endsection
