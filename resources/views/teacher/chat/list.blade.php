@extends('layouts.app')
@section('content')
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" message="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" message="ie=edge">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
            rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" 
            crossorigin="anonymous">
            <title>Display</title>
        </head>
        <body>
            
            <div class="container mt-5">

                <center> <h1><u>Chat List</u></h1> </center>
                
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Subject</th>
                            <th>Student</th>
                            <th>Roll #</th>
                            <th>Class</th>
                            <th>Messaged At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $messages as $message)
                        
                            
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{  $message->subject}}</td>
                            <td>{{  $message->student->user->name}}</td>
                            <td>{{  $message->student->roll_no}}</td>
                            <td>{{  $message->student->classCourse->name}}</td>
                            <td>{{ \Carbon\Carbon::parse($message->message_created_at)->format('j F, y, g:i A') }}</td>

                            <td>
                                <form action="{{ route('teacher.chat.show', ['chat' => $message->id]) }}" method="POST">
                                    @csrf
                                    @method('get')
                                    <a href=""><button class="btn btn-info" type="submit">View</button></a>
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