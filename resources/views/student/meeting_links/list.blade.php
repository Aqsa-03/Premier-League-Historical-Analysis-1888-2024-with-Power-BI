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

                <center> <h1><u>Meetings List</u></h1> </center>
                
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Course</th>
                            <th>Date & Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $meetings as $meeting)
                        
                            
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{  $meeting->title}}</td>
                            <td>{{  $meeting->course->name}}</td>
                            <td>{{ \Carbon\Carbon::parse($meeting->date_time)->format('j F, y, g:i A') }}</td>

                            <td>
                                {{-- <a href="{{ route('teacher.meetings.edit', ['meeting' => $meeting->id]) }}"><button class="btn btn-info">View</button></a> --}}
                                <form action="{{ route('student.meeting-links.show', ['meeting_link' => $meeting->id]) }}" method="POST">
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