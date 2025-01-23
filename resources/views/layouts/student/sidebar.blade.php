<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    

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
                <a href="{{ route('student.list.show') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Courses</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('student.assignments.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Assignments</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('student.quizzes.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Quizzes</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('student.meeting-links.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Meeting Links</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('student.events.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Events</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('student.course-content.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Course Content</p>
                </a>
            </li>

            
            
            
            {{-- Subject : ON --}}
             <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        Chat
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('student.chat.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Send Message</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('student.chat.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List</p>
                        </a>
                    </li>
                </ul>
            </li>
            {{--
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        Quiz
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('subjects.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List</p>
                        </a>
                    </li>
                </ul>
            </li> 
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        Meeting
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('subjects.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List</p>
                        </a>
                    </li>
                </ul>
            </li> 
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        Course Content
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('subjects.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List</p>
                        </a>
                    </li>
                </ul>
            </li> --}}

            
            {{-- GENERATE PAPER : OFF --}}

            
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->