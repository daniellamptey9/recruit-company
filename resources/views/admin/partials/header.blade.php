<header class="main-header header-shaddow">
  <div class="container-fluid">
    <div class="main-box">
      <div class="nav-outer">
        <div class="logo-box">
          <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.svg') }}" alt="" title=""></a></div>
        </div>
        <nav class="nav main-menu">
          <ul class="navigation" id="navbar"></ul>
        </nav>
      </div>

      <div class="outer-box">
        <button class="menu-btn">
          <span class="count">1</span>
          <span class="icon la la-heart-o"></span>
        </button>

        <button class="menu-btn">
          <span class="icon la la-bell"></span>
        </button>

        <div class="dropdown dashboard-option">
          <a class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('assets/images/resource/company-6.png') }}" alt="avatar" class="thumb">
            <span class="name">{{ Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('admin.change-password') }}"><i class="la la-lock"></i>Change Password</a></li>
            <li><a href="{{ route('admin.change-details') }}"><i class="la la-user-edit"></i>Change Details</a></li>
            <li>
              <form method="post" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="background:none;border:none;width:100%;text-align:left;padding:8px 20px;">
                  <i class="la la-sign-out"></i>Logout
                </button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="mobile-header">
    <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.svg') }}" alt="" title=""></a></div>
    <div class="nav-outer clearfix">
      <div class="outer-box">
        <div class="login-box">
          <a href="{{ route('login') }}" class="call-modal"><span class="icon-user"></span></a>
        </div>
        <button id="toggle-user-sidebar"><img src="{{ asset('assets/images/resource/company-6.png') }}" alt="avatar" class="thumb"></button>
        <a href="#nav-mobile" class="mobile-nav-toggler navbar-trigger"><span class="flaticon-menu-1"></span></a>
      </div>
    </div>
  </div>
  <div id="nav-mobile"></div>
</header>


