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

                <center> <h1><u>Quiz List</u></h1> </center>
                
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Class</th>
                            <th>Course</th>
                            <th>Due Date & Time</th>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $quizzes as $quiz)
                        
                            
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $quiz->title}}</td>
                            <td>{{ $quiz->description}}</td>

                            <td>{{  $quiz->classCourse->name}}</td>
                            <td>{{  $quiz->course->name}}</td>
                            <td>{{ \Carbon\Carbon::parse($quiz->due_date_time)->format('j F, y, g:i A') }}</td>

                            <td>
                                @if (!empty($quiz->file))
                                    <a href="{{ asset($quiz->file) }}" target="_blank">{{ $quiz->title }}</a>
                                @else
                                    Null
                                @endif
                            </td>
                            

                            {{--  <td>
                                <a href="{{ route('teacher.quizzes.edit', ['quiz' => $quiz->id]) }}"><button class="btn btn-info">Update</button></a>
                                <form action="{{ route('teacher.quizzes.destroy', ['quiz' => $quiz->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href=""><button class="btn btn-danger" type="submit">Delete</button></a>
                                </form>
                                
                            </td> --}}
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('teacher.quizzes.edit', ['quiz' => $quiz->id]) }}" class="btn btn-info mr-1">Update</a>
                                    <form action="{{ route('teacher.quizzes.destroy', ['quiz' => $quiz->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                    <a href="{{ route('teacher.quizzes.submission-list', ['id' => $quiz->id]) }}" class="btn btn-info mr-1">Submissions</a>
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