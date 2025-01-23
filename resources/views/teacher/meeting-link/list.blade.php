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

                <center> <h1><u>Meeting Links List</u></h1> </center>
                
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Date & Time</th>
                            <th>Class</th>
                            <th>Course</th>
                            <th>Link</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $links as $link)
                        
                            
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $link->title}}</td>
                            <td>{{ $link->description}}</td>
                            <td>{{ \Carbon\Carbon::parse($link->date_time)->format('M j, Y h:i A') }}</td>
                            <td>{{ $link->classCourse->name}}</td>
                            <td>{{ $link->course->name}}</td>
                            <td>{{ $link->link}}</td>
                            

                            <td>
                                <a href="{{ route('teacher.meeting-links.edit', ['meeting_link' => $link->id]) }}"><button class="btn btn-info">Edit</button></a>
                                <form action="{{ route('teacher.meeting-links.destroy', ['meeting_link' => $link->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href=""><button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this meeting link?')">Delete</button></a>
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