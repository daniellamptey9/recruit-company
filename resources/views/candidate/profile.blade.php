{{-- Superio candidate profile (candidate-dashboard-profile.html) --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Superio | My Profile</title>
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
                <!-- Navigation links removed for candidate dashboard -->
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
                <li><a href="{{ route('candidate.change-password') }}"><i class="la la-lock"></i>Change Password</a></li>
                <li><a href="{{ route('candidate.change-details') }}"><i class="la la-user-edit"></i>Change Details</a></li>
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
          <li><a href="{{ route('candidate.dashboard') }}"> <i class="la la-home"></i> Dashboard</a></li>
          <li class="active"><a href="{{ route('candidate.profile') }}"><i class="la la-user-tie"></i>My Profile</a></li>
          <li><a href="{{ route('candidate.resume') }}"><i class="la la-file-invoice"></i>My Resume</a></li>
          <li><a href="{{ route('candidate.applications') }}"><i class="la la-briefcase"></i> Applied Jobs </a></li>
          <li><a href="#"><i class="la la-bell"></i>Job Alerts</a></li>
          <li><a href="#"><i class="la la-bookmark-o"></i>Shortlisted Jobs</a></li>
          <li><a href="#"><i class="la la-file-invoice"></i> CV manager</a></li>
          <li><a href="#"><i class="la la-box"></i>Packages</a></li>
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

        <div class="skills-percentage">
          <h4>Skills Percentage</h4>
          <p>Put value for "Cover Image" field to increase your skill up to "85%"</p>

          <!-- Pie Graph -->
          <div class="pie-graph">
            <div class="graph-outer">
              <input type="text" class="dial" data-fgColor="#7367F0" data-bgColor="transparent" data-width="234" data-height="234" data-linecap="normal" value="30">
              <div class="inner-text count-box"><span class="count-text txt" data-stop="30" data-speed="2000"></span>%</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End User Sidebar -->

    <!-- Dashboard -->
    <section class="user-dashboard">
      <div class="dashboard-outer">
        <div class="upper-title-box">
          <h3>My Profile</h3>
          <div class="text">Manage your personal information and professional details</div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <!-- Ls widget -->
            <div class="ls-widget">
              <div class="tabs-box">
                <div class="widget-title">
                  <h4>Personal Information</h4>
                </div>

                <div class="widget-content">

                  <form class="default-form" method="POST" action="{{ route('candidate.profile.update') }}">
                    @csrf
                    <div class="row">
                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Full Name</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" placeholder="Enter your full name" required>
                        @error('name')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Job Title</label>
                        <input type="text" name="job_title" value="{{ Auth::user()->job_title ?? '' }}">
                        @error('job_title')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Phone</label>
                        <input type="text" name="phone" value="{{ Auth::user()->phone ?? '' }}">
                        @error('phone')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Email address</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}" required>
                        @error('email')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                 

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Current Salary($)</label>
                        <input type="text" name="current_salary" value="{{ Auth::user()->current_salary ?? '' }}" placeholder="e.g., 50000 or 50K-70K">
                        @error('current_salary')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Expected Salary($)</label>
                        <input type="text" name="expected_salary" value="{{ Auth::user()->expected_salary ?? '' }}" placeholder="e.g., 70000 or 70K-90K">
                        @error('expected_salary')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Experience</label>
                        <input type="text" name="experience" value="{{ Auth::user()->experience ?? '' }}" placeholder="5-10 Years">
                        @error('experience')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Age</label>
                        <select name="age_range" class="chosen-select">
                          <option value="">Select Age Range</option>
                          <option value="23-27" {{ (Auth::user()->age_range ?? '') == '23-27' ? 'selected' : '' }}>23 - 27 Years</option>
                          <option value="24-28" {{ (Auth::user()->age_range ?? '') == '24-28' ? 'selected' : '' }}>24 - 28 Years</option>
                          <option value="25-29" {{ (Auth::user()->age_range ?? '') == '25-29' ? 'selected' : '' }}>25 - 29 Years</option>
                          <option value="26-30" {{ (Auth::user()->age_range ?? '') == '26-30' ? 'selected' : '' }}>26 - 30 Years</option>
                        </select>
                        @error('age_range')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Education Levels</label>
                        <input type="text" name="education" value="{{ Auth::user()->education ?? '' }}" placeholder="Bachelor's Degree">
                        @error('education')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Languages</label>
                        <input type="text" name="languages" value="{{ Auth::user()->languages ?? '' }}" placeholder="English, Spanish">
                        @error('languages')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>


                      <!-- About Company -->
                      <div class="form-group col-lg-12 col-md-12">
                        <label>Description</label>
                        <textarea name="description" placeholder="Tell us about yourself, your skills, experience, and what makes you unique...">{{ Auth::user()->description ?? '' }}</textarea>
                        @error('description')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <button type="submit" class="theme-btn btn-style-one">Save Profile</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Ls widget -->
            <div class="ls-widget">
              <div class="tabs-box">
                <div class="widget-title">
                  <h4>Social Network</h4>
                </div>

                <div class="widget-content">
                  <form class="default-form" method="POST" action="{{ route('candidate.profile.social') }}">
                    @csrf
                    <div class="row">
                     

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>LinkedIn</label>
                        <input type="url" name="linkedin" value="{{ Auth::user()->linkedin ?? '' }}" placeholder="www.linkedin.com/in/yourprofile">
                        @error('linkedin')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>


                      <!-- Input -->
                     
                    </div>
                    <div class="form-group col-lg-6 col-md-12">
                        <button type="submit" class="theme-btn btn-style-one">Save Social Links</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Ls widget -->
            <div class="ls-widget">
              <div class="tabs-box">
                <div class="widget-title">
                  <h4>Contact Information</h4>
                </div>

                <div class="widget-content">
                  <form class="default-form" method="POST" action="{{ route('candidate.profile.contact') }}">
                    @csrf
                    <div class="row">
                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Country</label>
                        <input type="text" name="country" value="{{ Auth::user()->country ?? '' }}" placeholder="Enter your country">
                        @error('country')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>City</label>
                        <input type="text" name="city" value="{{ Auth::user()->city ?? '' }}" placeholder="Enter your city">
                        @error('city')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-12 col-md-12">
                        <label>Complete Address</label>
                        <input type="text" name="address" value="{{ Auth::user()->address ?? '' }}" placeholder="Enter your complete address">
                        @error('address')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <button type="submit" class="theme-btn btn-style-one">Save Contact Info</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
    <!-- End Dashboard -->

    <!-- Copyright -->
    <div class="copyright-text">
      <p>© {{ date('Y') }} Superio. All Rights Reserved. This website was developed by BlueBridge IT Solutions.</p>
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
  <script src="{{ asset('assets/js/knob.js') }}"></script>
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
        $submitBtn.html('<i class="la la-spinner la-spin"></i> Saving...');
        
        // Re-enable button after 5 seconds (in case of slow response)
        setTimeout(function() {
          $submitBtn.prop('disabled', false);
          $submitBtn.html('Save Profile');
        }, 5000);
      });
    });
  </script>
</body>
</html>
