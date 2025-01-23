<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'BIMS-LMS') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link href="{{ asset('import/assets/img/lms.png')}}" rel="icon">
</head>
@yield('styles')
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

            {{-- NOTIFICATION TESTING : ON --}}
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-bell"></i>
                 
                    @if(auth()->user()->unReadNotifications->count() !== 0 )  
                    <span class="badge badge-danger navbar-badge">{{ auth()->user()->unReadNotifications->count() }}</span>
                    @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">
                            {{ auth()->user()->unReadNotifications->count() }}
                            {{ str('Notification')->plural(auth()->user()->unReadNotifications->count()) }}
                        </span>
                        <div class="dropdown-divider"></div>
                    
                    @foreach (auth()->user()->unReadNotifications as $notification)
                        <form action="{{ route('notifications.read', ['id' => $notification->id]) }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i>
                                {{ $notification->data['message'] }} <br>
                                <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span><br>
                            </button>
                        </form>
                    @endforeach
               
                
                  
                  {{-- <div class="dropdown-divider"></div> --}}
                  {{-- <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> --}}
                </div>
              </li>

            {{-- NOTIFICATION TESTING : OFF --}}

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" style="left: inherit; right: 0px;">
                    <a href="{{ route('profile.show') }}" class="dropdown-item">
                        <i class="mr-2 fas fa-file"></i>
                        {{ __('My profile') }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="dropdown-item"
                           onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="mr-2 fas fa-sign-out-alt"></i>
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </li>
            
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <img src="{{ asset('images/barani-logo.jpg') }}" alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
        </a>

        @if(auth()->user()->role->name == 'admin' )
            @include('layouts.admin.sidebar')
        @elseif(auth()->user()->role->name == 'teacher')
            @include('layouts.teacher.sidebar')
        @elseif(auth()->user()->role->name == 'student')
            @include('layouts.student.sidebar')
        @endif
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        {{-- <div class="float-right d-none d-sm-inline"> --}}
            {{-- BIMS LMS --}}
            {{-- {{ config('app.name'), 'BMS' }} --}}
            {{ config('app.name') }}
        {{-- </div> --}}
        <!-- Default to the left -->
        {{-- <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved. --}}
        {{-- <strong>Copyright &copy; 2014-2021 <a href="{{ route('landing') }}">PaperStudio</a>.</strong> All rights reserved. --}}
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

@vite('resources/js/app.js')
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}" defer></script>

{{-- Template links : ON --}}

<script src="{{ asset('import/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('import/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{ asset('import/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{ asset('import/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{ asset('import/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{ asset('import/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{ asset('import/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('import/assets/js/main.js')}}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-H8SJKV4kKq4FkcJoc2P3zhpvMj7SYiVm3AnHKwThsIK+/OvCYYM7Hzv2ZLJF0dWn" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-J2qYZikzIeaByhMJa/Q7LdJbjoKDgqXExhpOqN7URiFk9vFToVjltM+7IkhsGkM1" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-X1Rc4ufWvDcbP2gB+ycbgQI14k/tkEeNZ1kMgakMHVfw6mU6w/nQDK5wG/ih4n1f" crossorigin="anonymous">

{{-- Template links : OFF --}}



@yield('scripts')
</body>
</html>
