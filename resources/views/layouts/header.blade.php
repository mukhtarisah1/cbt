<header class="app-header app-header-dark">
        <!-- .top-bar -->
        <div class="top-bar">
          <!-- .top-bar-brand -->
          <div class="top-bar-brand">
            <!-- toggle aside menu -->
            <button class="hamburger hamburger-squeeze mr-2" type="button" data-toggle="aside-menu" aria-label="toggle aside menu"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button> <!-- /toggle aside menu -->
            <a href="index.html">
              
             <img class="rounded" src="{{url('assets/abduh.png')}}" alt="" height="50" width="50">
            
            
            </a>
          </div><!-- /.top-bar-brand -->
          <!-- .top-bar-list -->
          <div class="top-bar-list">
            <!-- .top-bar-item -->
            <div class="top-bar-item px-2 d-md-none d-lg-none d-xl-none">
              <!-- toggle menu -->
              <button class="hamburger hamburger-squeeze" type="button" data-toggle="aside" aria-label="toggle menu"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button> <!-- /toggle menu -->
            </div><!-- /.top-bar-item -->
            <!-- .top-bar-item -->
            <div class="top-bar-item top-bar-item-full">
            <h6 >Online Examination Platform</h6>
            </div><!-- /.top-bar-item -->
            <!-- .top-bar-item -->
            <div class="top-bar-item top-bar-item-right px-0 d-none d-sm-flex">
              <!-- .nav -->
              
              <!-- .btn-account -->
              <div class="dropdown d-none d-md-flex">
                <button class="btn-account" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="user-avatar user-avatar-md"></span> <span class="account-summary pr-lg-4 d-none d-lg-block">
                  <span class="account-name">
                    @if(Auth::check() && Auth::user()->is_admin == 1)
                        {{ Auth::user()->name }}
                    @elseif(Auth::guard('students')->check())
                        {{ Auth::guard('students')->user()->firstname }}
                    @endif
                  </span> </span></button> <!-- .dropdown-menu -->
                <div class="dropdown-menu">
                  <div class="dropdown-arrow d-lg-none" x-arrow=""></div>
                  <div class="dropdown-arrow ml-3 d-none d-lg-block"></div>
                  
                  <h6 class="dropdown-header d-none d-md-block d-lg-none"> Beni Arisandi </h6><a class="dropdown-item" href="#"><span class="dropdown-icon oi oi-person"></span> Profile</a> <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><span class="dropdown-icon oi oi-account-logout"></span>
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="get" class="d-none">
                                        @csrf
                                    </form>
                  
                
                  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                  <!---quilbots links--->
                  <!-- <link href="https://cdn.quilljs.com/1.2.4/quill.snow.css" rel="stylesheet">
                  <script src="https://cdn.quilljs.com/1.2.4/quill.min.js" type="text/javascript"></script>
                  <script src="https://cdn.quilljs.com/1.3.6/quill.toolbar.js"></script>
                  <script src="https://cdn.quilljs.com/1.3.6/quill.imageDropAndPaste.js"></script> -->
                </div><!-- /.dropdown-menu -->
              </div><!-- /.btn-account -->
            </div><!-- /.top-bar-item -->
          </div><!-- /.top-bar-list -->
        </div><!-- /.top-bar -->
      </header>