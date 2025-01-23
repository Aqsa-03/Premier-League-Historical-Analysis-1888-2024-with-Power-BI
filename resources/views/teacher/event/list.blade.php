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

                <center> <h1><u>Event List</u></h1> </center>
                
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Detail</th>
                            <th>Start Date & Time</th>
                            <th>End Date & Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $events as $event)
                        
                            
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $event->name}}</td>
                            <td>{{ $event->detail}}</td>
                            <td>{{ \Carbon\Carbon::parse($event->start_date_time)->format('M j, Y h:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->end_date_time)->format('M j, Y h:i A') }}</td>
                            

                            <td>
                                <a href="{{ route('teacher.events.edit', ['event' => $event->id]) }}"><button class="btn btn-info">Update</button></a>
                                <form action="{{ route('teacher.events.destroy', ['event' => $event->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href=""><button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this event?')">Delete</button></a>
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