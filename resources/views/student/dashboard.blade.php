@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Dashboard') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<!-- Marquee -->

@if ($stats['events']->count() != 0)
<div class="content">
  <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
              <div class="card">
                  <a href="{{ route('student.events.index') }}">
                    <div class="card-body" style="color: red;">
                    
                            <center>
                                <p class="card-text">
                                    !!! Upcoming {{ \Illuminate\Support\Str::plural('Event', $stats['events']->count()) }} !!!
                                </p>
                            </center>
                            <marquee width="100%" direction="left" height="50px">
                              @foreach ($stats['events'] as $event)
                                {{ $event->name }} @if (!$loop->last),@endif 
                              @endforeach
                              {{ \Illuminate\Support\Str::plural('Event', $stats['events']->count()) }} Have Been Scheduled. Click Here to Get More Details.
                          </marquee>
                            </div>
                  </a>
                        </div>
                      </div>
                    </div>
                    <!-- /.row -->
                  </div><!-- /.container-fluid -->
                </div>
@endif
                

<!-- End Marquee -->

    
    
    
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <center> 
                            <p class="card-text">
                                {{ __('WELCOME').' '. auth()->user()->name }}
                            </p>
                        </center>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ $stats['pending_assignments'] }}</h3>
  
                  <p>Pending Assignments</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('student.assignments.index') }}" class="small-box-footer">See All <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{ $stats['pending_quizzes'] }}</h3>
  
                  <p>Pending Quizzes</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('student.quizzes.index') }}" class="small-box-footer">See All <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{ $stats['events']->count() }}</h3>
  
                  <p>Upcoming Events</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('student.events.index') }}" class="small-box-footer">See All <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{  $stats['messages']}}</h3>
  
                  <p>Messages</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ route('student.chat.index') }}" class="small-box-footer">See All <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </section>
    <!-- /.content -->
@endsection