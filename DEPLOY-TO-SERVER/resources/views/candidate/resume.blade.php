{{-- Candidate Resume - simplified professional version --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Superio | My Resume</title>
  <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>
<body>
  <div class="page-wrapper dashboard">
    <div class="preloader"></div>
    <span class="header-span"></span>

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

    <div class="sidebar-backdrop"></div>

    <div class="user-sidebar">
      <div class="sidebar-inner">
        <ul class="navigation">
          <li><a href="{{ route('candidate.dashboard') }}"> <i class="la la-home"></i> Dashboard</a></li>
          <li><a href="{{ route('candidate.profile') }}"><i class="la la-user-tie"></i>My Profile</a></li>
          <li class="active"><a href="{{ route('candidate.resume') }}"><i class="la la-file-invoice"></i>My Resume</a></li>
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
      </div>
    </div>

    <section class="user-dashboard">
      <div class="dashboard-outer">
        <div class="upper-title-box">
          <h3>My Resume</h3>
          <div class="text">Keep your resume up-to-date</div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="ls-widget">
              <div class="widget-title">
                <h4>Resume Summary</h4>
              </div>
              <div class="widget-content">
                <form class="default-form" method="POST" action="{{ route('candidate.resume.update') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Professional Summary</label>
                      <textarea name="professional_summary" placeholder="Briefly summarize your experience, strengths and career goals">{{ old('professional_summary', $activeResume->professional_summary ?? '') }}</textarea>
                      @error('professional_summary')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-group col-lg-12 col-md-12">
                      <label>Education</label>
                      <textarea name="education" placeholder="e.g., B.Sc. Computer Science, University Name (2015 - 2019)
M.Sc. Data Science, University Name (2019 - 2021)">{{ old('education', $activeResume->education ?? '') }}</textarea>
                      @error('education')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-group col-lg-12 col-md-12">
                      <label>Work Experience</label>
                      <textarea name="work_experience" placeholder="e.g., Frontend Developer at ACME (2021 - Present)
- Built and maintained React apps
- Collaborated with designers and backend team

Software Engineer at XYZ (2019 - 2021)
- Implemented APIs, wrote tests, improved performance">{{ old('work_experience', $activeResume->work_experience ?? '') }}</textarea>
                      @error('work_experience')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-group col-lg-12 col-md-12">
                      <label>Key Skills</label>
                      <textarea name="key_skills" placeholder="e.g., Laravel, PHP, MySQL, REST APIs, Vue/React, Docker">{{ old('key_skills', $activeResume->key_skills ?? '') }}</textarea>
                      @error('key_skills')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-group col-lg-6 col-md-12">
                      <label>Upload CV (PDF/DOC, max 5MB) - Optional</label>
                      <input type="file" name="cv_file" accept=".pdf,.doc,.docx">
                      @error('cv_file')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                      @if($activeResume && $activeResume->cv_file)
                        <p class="mt-2">Current CV: <a href="{{ asset('storage/' . $activeResume->cv_file) }}" target="_blank">View CV</a></p>
                      @endif
                    </div>

                    <div class="form-group col-lg-6 col-md-12">
                      <label>Upload Resume (PDF/DOC, max 5MB) - Required</label>
                      <input type="file" name="resume_file" accept=".pdf,.doc,.docx" required>
                      @error('resume_file')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                      @if($activeResume && $activeResume->resume_file)
                        <p class="mt-2">Current Resume: <a href="{{ asset('storage/' . $activeResume->resume_file) }}" target="_blank">View Resume</a></p>
                      @endif
                    </div>

                    <div class="form-group col-lg-12 col-md-12">
                      <button type="submit" class="theme-btn btn-style-one">Save Resume</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="copyright-text">
      <p>© {{ date('Y') }} Superio. All Rights Reserved. This website was developed by BlueBridge IT Solutions.</p>
    </div>
  </div>

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
</body>
</html>
