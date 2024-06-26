@if(Auth::check())
    @php
        $user = Auth::user();
    @endphp

    @if ($user instanceof \App\Models\User)
  
  <nav id="stacked-menu" class="stacked-menu">
        
                  <!-- .menu -->
                  <ul class="menu">
                    <!-- .menu-item -->
                    <li class="menu-item has-active">
                      <a href="/admin/dashboard" class="menu-link"><span class="menu-icon fas fa-home"></span> <span class="menu-text">Dashboard</span></a>
                    </li><!-- /.menu-item -->
                    <!-- .menu-item -->
                    <li class="menu-item has-child">
                      <a href="#" class="menu-link"><span class="menu-icon fa fa-book"></span> <span class="menu-text">Manage Courses</span> </a> <!-- child menu -->
                      <ul class="menu">
                        <li class="menu-item">
                          <a href="{{route('courses.create')}}" class="menu-link">Create New Course</a>
                          <a href="{{route('courses.index')}}" class="menu-link">View All Course</a>
                        </li>
                        
                        
                        
                      </ul><!-- /child menu -->
                    </li><!-- /.menu-item -->
                    <!-- .menu-item -->
                    <li class="menu-item has-child">
                      <a href="#" class="menu-link"><span class="menu-icon far fa-file "></span> <span class="menu-text">Manage Test</span></a> <!-- child menu -->
                      <ul class="menu">
                        <li class="menu-item">
                          <a href="{{route('createView.index')}}" class="menu-link">Create New</a>
                        </li>
                        <li class="menu-item">
                          <a href="{{route('courses.tests.index')}}" class="menu-link">View All Tests </a>
                        </li>
                        <!-- //this is a comment -->
                        
                      </ul><!-- /child menu -->
                    </li>
                    <li class="menu-item has-child">
                      <a href="#" class="menu-link"><span class="menu-icon fa fa-graduation-cap"></span> <span class="menu-text">Manage Levels</span></a> <!-- child menu -->
                      <ul class="menu">
                        <li class="menu-item">
                          <a href="{{route('levels.create')}}" class="menu-link">Add New Level</a>
                          <a href="{{route('levels.index')}}" class="menu-link">All levels</a>
                                              
                        </li>

                      </ul><!-- /child menu -->
                    </li>
                    <li class="menu-item has-child">
                      <a href="#" class="menu-link"><span class="menu-icon fa fa-user"></span> <span class="menu-text">Manage Users</span></a> <!-- child menu -->
                      <ul class="menu">
                        <li class="menu-item">
                          <a href="/register" class="menu-link">Create New Examiner</a>
                          <a href="{{ route('users.index') }}" class="menu-link">All Examiners</a>
                          <a href="{{route('students.create')}}" class="menu-link">Add Student</a>
                          <a href="{{route('students.index')}}" class="menu-link">All Student</a>                      
                        </li>

                      </ul><!-- /child menu -->
                    </li>
              
    </nav>
    @endif
    @endif
