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

                <center> <h1><u>Submitted Quiz List</u></h1> </center>
                
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
                        @foreach ( $quizzes as $quiz)
                        
                            
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{  $quiz->student->user->name }}</td>
                            <td>{{  $quiz->student->roll_no }}</td>
                            <td>
                                @if (!empty($quiz->file))
                                    <a href="{{ asset($quiz->file) }}" download="{{ basename($quiz->file) }}" target="_blank">{{ basename($quiz->file) }}</a>
                                @else
                                    Null
                                @endif
                            </td>                            
                            <td>{{ \Carbon\Carbon::parse($quiz->due_date_time)->format('j F, y, g:i A')  }}</td>
                            <td>{{  $quiz->comment ?? "None"}}</td>
                            

                            
                            
                            
                            
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
        </div>
        </body>
        </html>
@endsection