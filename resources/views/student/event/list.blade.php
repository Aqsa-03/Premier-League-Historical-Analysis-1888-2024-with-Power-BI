@extends('layouts.app')
@section('content')
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" event="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" event="ie=edge">
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
                            <th>Name</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $events as $event)
                        
                            {{-- @dd($event) --}}
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{  $event->name}}</td>
                            <td>{{  \Carbon\Carbon::parse($event->start_date_time)->format('j F, y, g:i A')}}</td>
                            <td>{{  \Carbon\Carbon::parse($event->end_date_time)->format('j F, y, g:i A')}}</td>

                            <td>
                                
                                <form action="{{ route('student.events.show', ['event' => $event->id]) }}" method="POST">
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