<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="{{ route('profile.show') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div> --}}

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>


            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        Course
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('admin.courses.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Course</p>
                        </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('admin.courses.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Course List</p>
                        </a>
                    </li>
                </ul>

            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        Teacher
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('admin.teachers.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Teacher</p>
                        </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('admin.teachers.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Teacher List</p>
                        </a>
                    </li>
                </ul>

            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        Student
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('admin.students.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Student</p>
                        </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('admin.students.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Student List</p>
                        </a>
                    </li>
                </ul>
                

            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        Allotment
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('admin.allotments.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Allot Course</p>
                        </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('admin.allotments.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Allotment List</p>
                        </a>
                    </li>
                </ul>
                

            </li>

            
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->