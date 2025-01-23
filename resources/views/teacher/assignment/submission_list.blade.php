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

                <center> <h1><u>Submitted Assignment List</u></h1> </center>
                
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Student Roll #</th>
                            <th>File</th>
                            <th>Submitted Date & Time</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $assignments as $assignment)
                        
                            
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{  $assignment->student->user->name }}</td>
                            <td>{{  $assignment->student->roll_no }}</td>
                            <td>
                                @if (!empty($assignment->file))
                                    <a href="{{ asset($assignment->file) }}" download="{{ basename($assignment->file) }}" target="_blank">{{ basename($assignment->file) }}</a>
                                @else
                                    Null
                                @endif
                            </td>                            
                            <td>{{ \Carbon\Carbon::parse($assignment->due_date_time)->format('j F, y, g:i A')  }}</td>
                            <td>{{  $assignment->comment ?? "None"}}</td>
                            

                            
                            
                            
                            
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
        </div>
        </body>
        </html>
@endsection