@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        <h1><u>Event</u></h1>

        <form  >
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="{{ $event->name }}" readonly>
                <div id="title-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Detail</label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" readonly rows="3" >{{ $event->detail }}</textarea>
                <div id="description-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Start Date & Time</label>
                <input readonly type="datetime-local" name="due_date" class="form-control" id="exampleFormControlInput1" value="{{ $event->start_date_time }}">
                <div id="due_date-error" class="error"></div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">End Date & Time</label>
                <input readonly type="datetime-local" name="due_date" class="form-control" id="exampleFormControlInput1" value="{{ $event->end_date_time }}">
                <div id="due_date-error" class="error"></div>
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
