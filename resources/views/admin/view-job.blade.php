{{-- Superio admin view job --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Superio | View Job</title>
  <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  
  <style>
    .job-details-card {
      background: #fff;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }
    
    .job-title {
      color: #1967d2;
      font-size: 28px;
      font-weight: 600;
      margin-bottom: 10px;
    }
    
    .job-meta {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 20px;
    }
    
    .job-meta-item {
      display: flex;
      align-items: center;
      color: #666;
    }
    
    .job-meta-item i {
      margin-right: 8px;
      color: #1967d2;
    }
    
    .job-description {
      line-height: 1.6;
      color: #333;
      margin-bottom: 30px;
    }
    
    .job-requirements {
      background: #f8f9fa;
      padding: 20px;
      border-radius: 6px;
      margin-bottom: 20px;
    }
    
    .job-requirements h4 {
      color: #1967d2;
      margin-bottom: 15px;
    }
    
    .requirement-item {
      display: flex;
      margin-bottom: 10px;
    }
    
    .requirement-label {
      font-weight: 600;
      min-width: 150px;
      color: #555;
    }
    
    .requirement-value {
      color: #333;
    }
    
    .job-actions {
      display: flex;
      gap: 15px;
      margin-top: 30px;
    }
    
    .status-badge {
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
    }
    
    .status-badge.active {
      background: #d4edda;
      color: #155724;
    }
    
    .status-badge.inactive {
      background: #f8d7da;
      color: #721c24;
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
          <li><a href="{{ route('admin.post-job') }}"><i class="la la-paper-plane"></i>Post a New Job</a></li>
          <li class="active"><a href="{{ route('admin.manage-jobs') }}"><i class="la la-briefcase"></i> Manage Jobs </a></li>
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
          <h3>Job Details</h3>
          <div class="text">View job information</div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="job-details-card">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <h1 class="job-title">{{ $job->title }}</h1>
                <span class="status-badge {{ $job->is_active ? 'active' : 'inactive' }}">
                  {{ $job->is_active ? 'Active' : 'Inactive' }}
                </span>
              </div>

              <div class="job-meta">
                <div class="job-meta-item">
                  <i class="la la-briefcase"></i>
                  <span>{{ $job->job_type }}</span>
                </div>
                <div class="job-meta-item">
                  <i class="la la-dollar-sign"></i>
                  <span>{{ $job->salary_range }}</span>
                </div>
                <div class="job-meta-item">
                  <i class="la la-map-marker"></i>
                  <span>{{ $job->work_location }} - {{ $job->office_location }}</span>
                </div>
                <div class="job-meta-item">
                  <i class="la la-calendar"></i>
                  <span>Deadline: {{ $job->formatted_deadline }}</span>
                </div>
                <div class="job-meta-item">
                  <i class="la la-industry"></i>
                  <span>{{ $job->industry }}</span>
                </div>
              </div>

              <div class="job-description">
                <h4>Job Description</h4>
                <p>{{ $job->description }}</p>
              </div>

              <div class="job-requirements">
                <h4>Job Requirements</h4>
                <div class="requirement-item">
                  <span class="requirement-label">Career Level:</span>
                  <span class="requirement-value">{{ $job->career_level }}</span>
                </div>
                <div class="requirement-item">
                  <span class="requirement-label">Experience:</span>
                  <span class="requirement-value">{{ $job->experience }}</span>
                </div>
                @if($job->qualification)
                <div class="requirement-item">
                  <span class="requirement-label">Qualification:</span>
                  <span class="requirement-value">{{ $job->qualification }}</span>
                </div>
                @endif
                @if($job->gender_preference)
                <div class="requirement-item">
                  <span class="requirement-label">Gender Preference:</span>
                  <span class="requirement-value">{{ $job->gender_preference }}</span>
                </div>
                @endif
                @if($job->categories && count($job->categories) > 0)
                <div class="requirement-item">
                  <span class="requirement-label">Specialisms:</span>
                  <span class="requirement-value">{{ implode(', ', $job->categories) }}</span>
                </div>
                @endif
              </div>

              <div class="job-requirements">
                <h4>Contact Information</h4>
                <div class="requirement-item">
                  <span class="requirement-label">Contact Person:</span>
                  <span class="requirement-value">{{ $job->contact_person }}</span>
                </div>
                <div class="requirement-item">
                  <span class="requirement-label">Email:</span>
                  <span class="requirement-value">{{ $job->company_email }}</span>
                </div>
              </div>

              <div class="job-actions">
                <a href="{{ route('admin.job.edit', $job->id) }}" class="theme-btn btn-style-one">
                  <i class="la la-edit"></i> Edit Job
                </a>
                <a href="{{ route('admin.job.applicants', $job->id) }}" class="theme-btn btn-style-four">
                  <i class="la la-users"></i> View Applicants
                </a>
                <a href="{{ route('admin.manage-jobs') }}" class="theme-btn btn-style-two">
                  <i class="la la-arrow-left"></i> Back to Jobs
                </a>
                <form method="POST" action="{{ route('admin.job.destroy', $job->id) }}" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" onclick="return confirm('Are you sure you want to delete this job?')" class="theme-btn btn-style-three">
                    <i class="la la-trash"></i> Delete Job
                  </button>
                </form>
              </div>
            </div>
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
  </script>
</body>
</html>

