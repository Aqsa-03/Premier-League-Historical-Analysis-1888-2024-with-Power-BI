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
                            <th>Messaged At</th>
                            <th>Teacher</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $messages as $message)
                        
                            
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{  $message->subject}}</td>
                            <td>{{ \Carbon\Carbon::parse($message->message_created_at)->format('j F, y, g:i A') }}</td>
                            <td>{{  $message->teacher->user->name}}</td>

                            <td>
                                
                                <div class="btn-group">
                                    <form action="{{ route('student.chat.show', ['chat' => $message->id]) }}" method="POST">
                                        @csrf
                                        @method('get')
                                        <a href=""><button class="btn btn-info" type="submit" class="btn btn-info mr-1">View</button></a>
                                    </form>
                                    <form action="{{ route('student.chat.destroy', ['chat' => $message->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this message?')">Delete</button>
                                    </form>
                                </div>
                            </td>                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
        </div>
        </body>
        </html>
@endsection