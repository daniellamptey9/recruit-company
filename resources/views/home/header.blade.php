<header class="main-header header-style-three">
      <div class="container-fluid">
        <!-- Main box -->
        <div class="main-box">
          <!--Nav Outer -->
          <div class="nav-outer">
            <div class="logo-box">
              @php
                $company = \App\Models\Company::first();
                $siteOwner = \App\Models\User::where('role','admin')->first();
                $logoUrl = ($siteOwner && $siteOwner->logo) ? $siteOwner->logo_url : (($company && isset($company->logo_url)) ? $company->logo_url : asset('assets/images/logo.svg'));
              @endphp
              <div class="logo"><a href="{{ route('home') }}"><img src="{{ $logoUrl }}" alt="" title=""></a></div>
            </div>

            <nav class="nav main-menu">
              <ul class="navigation" id="navbar">
                <li class="{{ Request::routeIs('home') ? 'current' : '' }}"><a href="{{ route('home') }}">Home</a></li>

                <li class="{{ Request::routeIs('jobs') ? 'current' : '' }}"><a href="{{ route('jobs') }}">Find Jobs</a></li>

                <li class="dropdown">
                  <span>Services</span>
                  <ul>
                    <li><a href="#">Permanent Recruitment</a></li>
                    <li><a href="#">Temporary & Contract Staffing</a></li>
                    <li><a href="#">Executive Search</a></li>
                    <li><a href="#">HR Consulting</a></li>
                    <li><a href="#">Payroll Outsourcing</a></li>
                    <li><a href="#">Training & Development</a></li>
                  </ul>
                </li>

                <li class="{{ Request::routeIs('about') ? 'current' : '' }}"><a href="{{ route('about') }}">About Us</a></li>

                <li class="{{ Request::routeIs('contact') ? 'current' : '' }}"><a href="{{ route('contact') }}">Contact Us</a></li>


                <!-- Only for Mobile View -->
                <!-- <li class="mm-add-listing">
                  <a href="add-listing.html" class="theme-btn btn-style-one">Job Post</a>
                  <span>
                    <span class="contact-info">
                      <span class="phone-num"><span>Call us</span><a href="tel:1234567890">123 456 7890</a></span>
                      <span class="address">329 Queensberry Street, North Melbourne VIC <br>3051, Australia.</span>
                      <a href="mailto:support@superio.com" class="email">support@superio.com</a>
                    </span>
                    <span class="social-links">
                      <a href="#"><span class="fab fa-facebook-f"></span></a>
                      <a href="#"><span class="fab fa-twitter"></span></a>
                      <a href="#"><span class="fab fa-instagram"></span></a>
                      <a href="#"><span class="fab fa-linkedin-in"></span></a>
                    </span>
                  </span>
                </li> -->
              </ul>
            </nav>
            <!-- Main Menu End-->
          </div>

            <div class="outer-box">
              <div class="btn-box">
                @guest
                  <a href="{{ route('login') }}" class="theme-btn btn-style-four">Login / Register</a>
                @else
                  <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('candidate.dashboard') }}" class="theme-btn btn-style-four">Dashboard</a>
                  <form method="post" action="{{ route('logout') }}" style="display:inline-block;margin-left:10px;">
                    @csrf
                    <button type="submit" class="theme-btn btn-style-seven" style="border:none;cursor:pointer;">Logout</button>
                  </form>
                @endguest
              </div>
            </div>
        </div>
      </div>

      <!-- Mobile Header -->
      <div class="mobile-header">
        <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.svg') }}" alt="" title=""></a></div>

        <!--Nav Box-->
        <div class="nav-outer clearfix">

          <div class="outer-box">
            <!-- Login/Register -->
            <div class="login-box">
              <a href="{{ route('login') }}" class="call-modal"><span class="icon-user"></span></a>
            </div>

            <a href="#nav-mobile" class="mobile-nav-toggler navbar-trigger"><span class="flaticon-menu-1"></span></a>
          </div>
        </div>
      </div>

      <!-- Mobile Nav -->
      <div id="nav-mobile"></div>
    </header>