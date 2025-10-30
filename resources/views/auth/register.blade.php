<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Mine Care Recruitment | Register</title>

  <!-- Stylesheets -->
  <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">

  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">

  <!-- Responsive -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
  <!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<body>

  <div class="page-wrapper">

    <!-- Preloader -->
    <div class="preloader"></div>

    <!-- Main Header-->
    <header class="main-header">
      <div class="container-fluid">
        <!-- Main box -->
        <div class="main-box">
          <!--Nav Outer -->
          <div class="nav-outer">
            <div class="logo-box">
              <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo-2.svg') }}" alt="" title=""></a></div>
            </div>
          </div>

          <div class="outer-box">
            <!-- Login/Register -->
            <div class="btn-box">
              <a href="login-popup.html" class="theme-btn btn-style-three call-modal">Login / Register</a>
            
            </div>
          </div>
        </div>
      </div>

      <!-- Mobile Header -->
      <div class="mobile-header">
        <div class="logo"><a href="index.html"><img src="images/logo.svg" alt="" title=""></a></div>

        <!--Nav Box-->
        <div class="nav-outer clearfix">

          <div class="outer-box">
            <!-- Login/Register -->
            <div class="login-box">
              <a href="login-popup.html" class="call-modal"><span class="icon-user"></span></a>
            </div>

            <a href="#nav-mobile" class="mobile-nav-toggler navbar-trigger"><span class="flaticon-menu-1"></span></a>
          </div>
        </div>
      </div>

      <!-- Mobile Nav -->
      <div id="nav-mobile"></div>
    </header>
    <!--End Main Header -->

    <!-- Info Section -->
    <div class="login-section">
      <div class="image-layer" style="background-image: url({{ asset('assets/images/background/12.jpg') }});"></div>
      <div class="outer-box">
        <!-- Login Form -->
        <div class="login-form default-form">
          <div class="form-inner">
            <h3>Create a Free Mine Care Recruitment Account</h3>

             <!--Register Form-->
             <form method="post" action="{{ route('register.store') }}">
              @csrf
             

               <div class="form-group">
                 <label>Full Name</label>
                 <input type="text" name="name" value="{{ old('name') }}" placeholder="Your full name" required>
               </div>

               <div class="form-group">
                 <label>Email Address</label>
                 <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
               </div>

               <div class="form-group">
                 <label>Phone (optional)</label>
                 <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Phone number">
               </div>

               <div class="form-group">
                 <label>Country (optional)</label>
                 <input type="text" name="country" value="{{ old('country') }}" placeholder="Country">
               </div>

               <div class="form-group">
                 <label>City (optional)</label>
                 <input type="text" name="city" value="{{ old('city') }}" placeholder="City">
               </div>

              <div class="form-group">
                <label>Password</label>
                 <input id="password-field" type="password" name="password" placeholder="Password" required>
              </div>

              <div class="form-group">
                 <label>Confirm Password</label>
                 <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
              </div>

               @if ($errors->any())
               <div class="form-group">
                 <div class="alert alert-danger">{{ $errors->first() }}</div>
               </div>
               @endif

               <div class="form-group">
                 <button class="theme-btn btn-style-one " type="submit" name="Register">Register</button>
               </div>
            </form>

            <div class="bottom-box">
              <div class="divider"><span>or</span></div>
              <div class="btn-box row">
                <div class="col-lg-6 col-md-12">
                  <a href="#" class="theme-btn social-btn-two facebook-btn"><i class="fab fa-facebook-f"></i> Log In via Facebook</a>
                </div>
                <div class="col-lg-6 col-md-12">
                  <a href="#" class="theme-btn social-btn-two google-btn"><i class="fab fa-google"></i> Log In via Gmail</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--End Login Form -->
      </div>
    </div>
    <!-- End Info Section -->


  </div><!-- End Page Wrapper -->


  <script src="{{ asset('assets/js/jquery.js') }}"></script>
  <script src="{{ asset('assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.fancybox.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.modal.min.js') }}"></script>
  <script src="{{ asset('assets/js/mmenu.polyfills.js') }}"></script>
  <script src="{{ asset('assets/js/mmenu.js') }}"></script>
  <script src="{{ asset('assets/js/appear.js') }}"></script>
  <script src="{{ asset('assets/js/ScrollMagic.min.js') }}"></script>
  <script src="{{ asset('assets/js/rellax.min.js') }}"></script>
  <script src="{{ asset('assets/js/owl.js') }}"></script>
  <script src="{{ asset('assets/js/wow.js') }}"></script>
  <script src="{{ asset('assets/js/script.js') }}"></script>

</body>

</html>