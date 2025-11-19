<style>
    .main-header {
    position: fixed; /* sidebar ko fix krta hai */
    top: 0; /* top se chipka dega */
    width: 100%;
}


 </style>
<header class="main-header">
    <!-- Logo -->
    <a href="{{route('dashboard')}}" class="logo blue-bg">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    {{-- <span class="logo-mini"><img src="assets/img/logo-small.png" alt=""></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><img src="assets/img/logo.png" alt=""></span> </a> --}}
    <h4 class="mt-3">Admin Dashboard</h4>
    <i class="fa-duotone fa-light fa-pipe"></i>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar blue-bg navbar-static-top">

      <!-- Sidebar toggle button-->
      {{-- <ul class="nav navbar-nav ">
        <li><a class="sidebar-toggle" data-toggle="push-menu" href=""></a> </li>
      </ul> --}}
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li>
                <div class="d-flex align-items-center justify-content-center mt-3" style="gap: 10px;">
                    <input
                      type="search"
                      placeholder="Search here ....."
                      class="form-control rounded-pill"
                      style="max-width: 300px;"
                    >
                    <button class="btn btn-sm btn-warning rounded-pill px-4">
                      Search
                    </button>
                  </div>

            </li>
          <!-- Messages -->
          <li class="dropdown messages-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-envelope-o"></i>
            <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 new messages</li>
              <li>
                <ul class="menu">
                  <li><a href="#">
                    <div class="pull-left"><img src="assets/img/img1.jpg" class="img-circle" alt="User Image"> <span class="profile-status online pull-right"></span></div>
                    <h4>Alex C. Patton</h4>
                    <p>I've finished it! See you so...</p>
                    <p><span class="time">9:30 AM</span></p>
                    </a></li>
                </ul>
              </li>
              <li class="footer"><a href="#">View All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications  -->
          <li class="dropdown messages-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-bell-o"></i>
            <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Notifications</li>
              <li>
                <ul class="menu">
                  <li><a href="#">
                    <div class="pull-left icon-circle red"><i class="icon-lightbulb"></i></div>
                    <h4>Alex C. Patton</h4>
                    <p>I've finished it! See you so...</p>
                    <p><span class="time">9:30 AM</span></p>
                    </a></li>
                </ul>
              </li>
              <li class="footer"><a href="#">Check all Notifications</a></li>
            </ul>
          </li>
          <!-- User Account  -->
          <li class="dropdown user user-menu p-ph-res mb-2"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="{{asset($globalUser->image)}}" class="rounded-circle" alt="User Image" width="40" height="40"> <span class="hidden-xs">{{$globalUser->name}}</span> </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <div class="pull-left user-img"><img src="{{asset($globalUser->image)}}" class="rounded-circle mb-2" width="40" height="40" alt="User"></div>
                <p class="text-left">{{$globalUser->name}} <small>{{$globalUser->email}}</small> </p>
              </li>
              <li><a href="{{route('update.profile')}}"><i class="icon-profile-male"></i> My Profile</a></li>
              <li><a href="{{route('logout')}}"><i class="fa fa-power-off"></i> Logout</a></li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>