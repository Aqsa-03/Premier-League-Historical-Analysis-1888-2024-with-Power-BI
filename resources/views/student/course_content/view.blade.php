@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        <h1><u>Course Content</u></h1>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="{{ $courseContent->title }}" readonly>
                <div id="title-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" readonly rows="3" >{{ $courseContent->description }}</textarea>
                <div id="description-error" class="error"></div>
            </div>
            
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Class</label>
                <input type="text" name="class_id" class="form-control" id="exampleFormControlInput1" value="{{ $courseContent->classCourse->name }} " readonly>
                <div id="title-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Course</label>
                <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="{{  $courseContent->course->name  }}" readonly>
                <div id="title-error" class="error"></div>
            </div>

            @if($courseContent->file ?? false)
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Download File</label>
                    <button  onclick="window.location='{{ asset($courseContent->file) }}'" class="download-button">
                        
                        <img src="{{ asset('images/download-32.png') }}" alt="Download">
                        {{ $courseContent->title }}
                    </button>
                </div>
            @endif

            @if ($courseContent->link ?? false)
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Content Link</label>
                    <div class="input-group">
                        <textarea class="form-control" id="link" rows="3" readonly>{{ $courseContent->link }}</textarea>
                        <button class="btn btn-primary" type="button" onclick="copyToClipboard()">Copy Link</button>
                    </div>
                    <div id="comment-error" class="error"></div>
                </div>
            @endif
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
