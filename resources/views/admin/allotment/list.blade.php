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

                <center> <h1><u>Allotment List</u></h1> </center>
                
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Teacher</th>
                            <th>Course</th>
                            <th>Class</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $allotments as $allotment)
                            
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{  $allotment->teacher->user->name}}</td>
                            <td>{{  $allotment->course->name}}</td>
                            <td>{{  $allotment->classCourse->name}}</td>
                            
                            <td>
                                <a href="{{ route('admin.allotments.edit',['allotment'=>$allotment->id]) }}"><button class="btn btn-info">Update</button></a>
                                <form action="{{ route('admin.allotments.destroy', ['allotment' => $allotment->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this allotment?')">Delete</button>
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