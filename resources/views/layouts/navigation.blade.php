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

            {{-- <li class="nav-item">
                <a href="{{ route('grades.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        {{ __('Add Class') }}
                    </p>
                </a>
            </li> --}}

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        Class
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('grades.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Class</p>
                        </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('grades.list') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Class List</p>
                        </a>
                    </li>
                </ul>

            </li>
            {{-- Subject : ON --}}
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        Subject
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('subjects.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Subject</p>
                        </a>
                    </li>
                </ul>
                
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('subjects.list') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Subject List</p>
                        </a>
                    </li>
                </ul>
                
            </li>
            {{-- Subject : OFF --}}
            


            {{-- Chapter : ON --}}
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        Chapter
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('chapters.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Chapter</p>
                        </a>
                    </li>
                </ul>
                
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('chapters.list') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Chapters List</p>
                        </a>
                    </li>
                </ul>
                
            </li>
            {{-- Chapter : OFF --}}

            {{-- Content : ON --}}
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        Content
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('contents.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Content</p>
                        </a>
                    </li>
                </ul>
                
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('contents.list') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Content List</p>
                        </a>
                    </li>
                </ul>
                
            </li>
            {{-- CONTENT : OFF --}}

            {{-- Past Papers : ON --}}
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        Past Paper
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('past-papers.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Past Paper</p>
                        </a>
                    </li>
                </ul>
                
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('past-papers.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Past Paper List</p>
                        </a>
                    </li>
                </ul>
                
            </li>
            {{-- PAST PAPERS : OFF --}}

            {{-- QUIZ : ON --}}
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
                        <a href="{{ route('quizzes.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Quiz</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('quizzes.questions-list') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Question List</p>
                        </a>
                    </li>
                </ul>
                
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('quizzes.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Stats</p>
                        </a>
                    </li>
                </ul>
                
            </li>
            {{-- QUIZ : OFF --}}

            {{-- GENERATE PAPER : ON --}}
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        Generate Paper
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('generate-papers.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Questions</p>
                        </a>
                    </li>
                </ul>
                
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('generate-papers.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Question List</p>
                        </a>
                    </li>
                </ul>
                
            </li>
            {{-- GENERATE PAPER : OFF --}}

            
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->