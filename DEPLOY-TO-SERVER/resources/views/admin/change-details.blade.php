{{-- Superio admin change details (dashboard-change-password.html) --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Superio | Change Details</title>
  <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  
  <style>
    .la-spin {
      animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    
    .btn:disabled {
      opacity: 0.6;
      cursor: not-allowed;
    }
    
    .toast-top-right {
      top: 12px;
      right: 12px;
    }
  </style>
</head>
<body>
  <div class="page-wrapper dashboard">
    <div class="preloader"></div>
    <span class="header-span"></span>
    
    <!-- Main Header-->
    <header class="main-header header-shaddow">
      <div class="container-fluid">
        <!-- Main box -->
        <div class="main-box">
          <!--Nav Outer -->
          <div class="nav-outer">
            <div class="logo-box">
              <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.svg') }}" alt="" title=""></a></div>
            </div>

            <nav class="nav main-menu">
              <ul class="navigation" id="navbar">
                <!-- Navigation links removed for admin dashboard -->
              </ul>
            </nav>
            <!-- Main Menu End-->
          </div>

          <div class="outer-box">
            <button class="menu-btn">
              <span class="count">1</span>
              <span class="icon la la-heart-o"></span>
            </button>

            <button class="menu-btn">
              <span class="icon la la-bell"></span>
            </button>

            <!-- Dashboard Option -->
            <div class="dropdown dashboard-option">
              <a class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('assets/images/resource/company-6.png') }}" alt="avatar" class="thumb">
                <span class="name">{{ Auth::user()->name }}</span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="{{ route('admin.change-password') }}"><i class="la la-lock"></i>Change Password</a></li>
                <li><a href="#"><i class="la la-user-edit"></i>Change Details</a></li>
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

            <button id="toggle-user-sidebar"><img src="{{ asset('assets/images/resource/company-6.png') }}" alt="avatar" class="thumb"></button>
            <a href="#nav-mobile" class="mobile-nav-toggler navbar-trigger"><span class="flaticon-menu-1"></span></a>
          </div>
        </div>
      </div>

      <!-- Mobile Nav -->
      <div id="nav-mobile"></div>
    </header>
    <!--End Main Header -->

    <!-- Sidebar Backdrop -->
    <div class="sidebar-backdrop"></div>

    <!-- User Sidebar -->
    <div class="user-sidebar">
      <div class="sidebar-inner">
        <ul class="navigation">
          <li><a href="{{ route('admin.dashboard') }}"> <i class="la la-home"></i> Dashboard</a></li>
          <li><a href="{{ route('admin.company-profile') }}"><i class="la la-user-tie"></i>Company Profile</a></li>
          <li><a href="#"><i class="la la-paper-plane"></i>Post a New Job</a></li>
          <li><a href="{{ route('admin.manage-jobs') }}"><i class="la la-briefcase"></i> Manage Jobs </a></li>
          <li><a href="{{ route('admin.manage-categories') }}"><i class="la la-tags"></i> Manage Categories </a></li>
          <li><a href="#"><i class="la la-file-invoice"></i> All Applicants</a></li>
          <li><a href="#"><i class="la la-bookmark-o"></i>Shortlisted Resumes</a></li>
          <li><a href="#"><i class="la la-comment-o"></i>Messages</a></li>
          
          <li>
            <form method="post" action="{{ route('logout') }}">
              @csrf
              <button type="submit" style="background:none;border:none;width:100%;text-align:left;padding:8px 20px;">
                <i class="la la-sign-out"></i>Logout
              </button>
            </form>
          </li>
          <li><a href="#"><i class="la la-trash"></i>Delete Profile</a></li>
        </ul>
      </div>
    </div>
    <!-- End User Sidebar -->

    <!-- Dashboard -->
    <section class="user-dashboard">
      <div class="dashboard-outer">
        <div class="upper-title-box">
          <h3>Change Details</h3>
          <div class="text">Update your personal information</div>
        </div>

        <!-- Ls widget -->
        <div class="ls-widget">
          <div class="widget-title">
            <h4>Personal Information</h4>
          </div>

          <div class="widget-content">
            <form class="default-form" method="POST" action="{{ route('admin.change-details.update') }}" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <!-- Logo Upload -->
                <div class="form-group col-lg-7 col-md-12">
                  <label>Company Logo</label>
                  <input type="file" name="logo" accept="image/*">
                  @if(Auth::user()->logo)
                    <div class="mt-2"><img src="{{ Auth::user()->logo_url }}" alt="Logo" style="height:50px"></div>
                  @endif
                  @error('logo')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Input -->
                <div class="form-group col-lg-7 col-md-12">
                  <label>Full Name</label>
                  <input type="text" name="name" value="{{ Auth::user()->name }}" placeholder="Enter your full name" required>
                  @error('name')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Input -->
                <div class="form-group col-lg-7 col-md-12">
                  <label>Email Address</label>
                  <input type="email" name="email" value="{{ Auth::user()->email }}" placeholder="Enter your email address" required>
                  @error('email')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Input -->
                <div class="form-group col-lg-7 col-md-12">
                  <label>Role</label>
                  <input type="text" value="{{ ucfirst(Auth::user()->role) }}" placeholder="User Role" readonly>
                  <small class="text-muted">Role cannot be changed</small>
                </div>

                <!-- Input -->
                <div class="form-group col-lg-6 col-md-12">
                  <button type="submit" class="theme-btn btn-style-one">Update Details</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- End Dashboard -->

    <!-- Copyright -->
    <div class="copyright-text">
      <p>© {{ date('Y') }} BlueBridge IT Solutions. All Rights Reserved. This website was developed by BlueBridge IT Solutions.</p>
    </div>
  </div><!-- End Page Wrapper -->

  <script src="{{ asset('assets/js/jquery.js') }}"></script>
  <script src="{{ asset('assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/chosen.min.js') }}"></script>
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
  
  <!-- Toast Notification Library -->
  <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.css">
  
  <script>
    // Toast notification configuration
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    };

    // Show success/error messages
    @if(session('success'))
      toastr.success('{{ session('success') }}');
    @endif

    @if(session('error'))
      toastr.error('{{ session('error') }}');
    @endif

    @if($errors->any())
      @foreach($errors->all() as $error)
        toastr.error('{{ $error }}');
      @endforeach
    @endif

    // Handle form submission with loading states
    $(document).ready(function() {
      $('form').on('submit', function(e) {
        var $form = $(this);
        var $submitBtn = $form.find('button[type="submit"]');
        
        // Show loading state
        $submitBtn.prop('disabled', true);
        $submitBtn.html('<i class="la la-spinner la-spin"></i> Updating...');
        
        // Re-enable button after 5 seconds (in case of slow response)
        setTimeout(function() {
          $submitBtn.prop('disabled', false);
          $submitBtn.html('Update Details');
        }, 5000);
      });
    });
  </script>
</body>
</html>

