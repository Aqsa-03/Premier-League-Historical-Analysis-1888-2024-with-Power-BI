@extends('layouts.app')
@section('content')
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
            rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" 
            crossorigin="anonymous">
            <title>Display</title>
        </head>
        <body>
            
            <div class="container mt-5">

                <center> <h1><u>Assignment List</u></h1> </center>
                
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Course</th>
                            <th>Due Date & Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $assignments as $assignment)
                        
                            
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{  $assignment->title}}</td>
                            <td>{{  $assignment->course->name}}</td>
                            <td>{{ \Carbon\Carbon::parse($assignment->due_date_time)->format('j F, y, g:i A') }}</td>

                            <td style="display: flex; align-items: center; gap: 10px;">
                                @if($assignment->file ?? false)
                                    <div>
                                        <button onclick="window.location='{{ asset($assignment->file) }}'" class="download-button">
                                            <img src="{{ asset('images/download-32.png') }}" title="Download Assignment" alt="Download">
                                        </button>
                                    </div>
                                @endif
                                <form action="{{ route('student.assignments.show', ['assignment' => $assignment->id]) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-info" type="submit">View</button>
                                </form>
                            </td>
                            
                            
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
        </div>
        </body>
        </html>
@endsection