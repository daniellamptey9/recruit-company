{{-- Superio admin job applicants (dashboard-resumes.html) --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Superio | Applicants for {{ $job->title }}</title>
  <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>
<body>
  <div class="page-wrapper dashboard ">
    
    <span class="header-span"></span>

    <!-- Main Header-->
    <header class="main-header header-shaddow">
      <div class="container-fluid">
        <div class="main-box">
          <div class="nav-outer">
            <div class="logo-box">
              <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.svg') }}" alt="" title=""></a></div>
            </div>

            <nav class="nav main-menu">
              <ul class="navigation" id="navbar">
              </ul>
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
    <!--End Main Header -->

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
          <li><a href="{{ route('admin.all-applicants') }}"><i class="la la-file-invoice"></i> All Applicants</a></li>
          <li><a href="#"><i class="la la-bookmark-o"></i>Shortlisted Resumes</a></li>
          <li><a href="#"><i class="la la-box"></i>Packages</a></li>
          <li><a href="#"><i class="la la-comment-o"></i>Messages</a></li>
          <li><a href="#"><i class="la la-bell"></i>Resume Alerts</a></li>
          
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
          <h3>Applicants for: {{ $job->title }}</h3>
          <div class="text">Manage and review applications</div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="applicants-widget ls-widget">
              <div class="widget-title">
                <h4>Applicants</h4>
                <div class="chosen-outer">
                  <div class="search-box-one">
                    <form method="get" action="#">
                      <div class="form-group">
                        <span class="icon flaticon-search-1"></span>
                        <input type="search" name="search" value="" placeholder="Search applicants">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="widget-content">
                @if($applicants->count() === 0)
                  <div class="text-center" style="padding: 40px 0;">
                    <h4>No applicants yet</h4>
                    <p>Share the job to get more applications.</p>
                    <a href="{{ route('admin.manage-jobs') }}" class="theme-btn btn-style-two"><i class="la la-arrow-left"></i> Back to Jobs</a>
                  </div>
                @else
                  @foreach($applicants as $applicant)
                    <div class="candidate-block-three">
                      <div class="inner-box">
                        <div class="content">
                          <figure class="image"><img src="{{ $applicant->avatar_url ?? asset('assets/images/resource/candidate-1.png') }}" alt="{{ $applicant->name }}" style="width:60px;height:60px;object-fit:cover;border-radius:50%;display:block;"></figure>
                          <h4 class="name"><a href="#">{{ $applicant->name }}</a></h4>
                          <ul class="candidate-info">
                            <li class="designation">{{ $applicant->position ?? 'Applicant' }}</li>
                            <li><span class="icon flaticon-map-locator"></span> {{ $applicant->location ?? 'N/A' }}</li>
                            <li><span class="icon flaticon-money"></span> {{ $applicant->expected_salary ?? 'N/A' }}</li>
                            <li><span class="icon la la-envelope"></span> {{ $applicant->email ?? 'N/A' }}</li>
                            <li><span class="icon la la-phone"></span> {{ $applicant->phone ?? 'N/A' }}</li>
                            <li><span class="icon la la-clock"></span> Applied: {{ $applicant->applied_at ?? '' }}</li>
                          </ul>
                          <ul class="post-tags">
                            @foreach(($applicant->skills ?? []) as $skill)
                              <li><a href="#">{{ $skill }}</a></li>
                            @endforeach
                          </ul>
                          @if(!empty($applicant->cover_letter))
                          <div class="mt-2">
                            <strong>Cover Letter:</strong>
                            <p style="white-space:pre-line;">{{ $applicant->cover_letter }}</p>
                          </div>
                          @endif
                        </div>
                        <div class="option-box">
                          <div class="resume-action" style="display:flex;flex-wrap:wrap;gap:8px;align-items:center;">
                            <a href="{{ $applicant->cv_url ?? '#' }}" class="theme-btn btn-style-three" target="_blank" style="margin:0;white-space:nowrap;"><span class="la la-download"></span> Download CV</a>
                            <form method="POST" action="{{ route('admin.application.status', ['job' => $job->id, 'application' => $applicant->application_id]) }}">
                              @csrf
                              <input type="hidden" name="status" value="shortlisted" />
                              <button type="submit" class="theme-btn btn-style-two" style="margin:0;white-space:nowrap;"><span class="la la-check"></span> Shortlist</button>
                            </form>
                            <form method="POST" action="{{ route('admin.application.status', ['job' => $job->id, 'application' => $applicant->application_id]) }}">
                              @csrf
                              <input type="hidden" name="status" value="rejected" />
                              <button type="submit" class="theme-btn btn-style-four" style="margin:0;white-space:nowrap;"><span class="la la-times-circle"></span> Reject</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Dashboard -->

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
</body>
</html>


