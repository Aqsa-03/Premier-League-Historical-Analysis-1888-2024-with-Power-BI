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

                <center> <h1><u>Course Content List</u></h1> </center>
                
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Class</th>
                            <th>Course</th>
                            <th>File</th>
                            <th>Link</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $contents as $content)
                        
                            
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $content->title}}</td>
                            <td>{{ $content->description}}</td>

                            <td>{{  $content->course->name}}</td>
                            <td>{{  $content->classCourse->name}}</td>

                            <td>
                                @if (!empty($content->file))
                                    <a href="{{ asset($content->file) }}" target="_blank">{{ $content->title }}</a>
                                @else
                                    Null
                                @endif
                            </td>
                            <td> {{ $content->link ?? 'Null' }}</td>
                            

                            <td>
                                <a href="{{ route('teacher.course-content.edit', ['course_content' => $content->id]) }}"><button class="btn btn-info">Update</button></a>
                                <form action="{{ route('teacher.course-content.destroy', ['course_content' => $content->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href=""><button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this content?')">Delete</button></a>
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