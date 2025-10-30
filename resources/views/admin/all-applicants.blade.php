{{-- Superio admin all applicants --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Superio | All Applicants</title>
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

    <header class="main-header header-shaddow">
      <div class="container-fluid">
        <div class="main-box">
          <div class="nav-outer">
            <div class="logo-box">
              <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.svg') }}" alt="" title=""></a></div>
            </div>
            <nav class="nav main-menu"><ul class="navigation" id="navbar"></ul></nav>
          </div>
          <div class="outer-box">
            <button class="menu-btn"><span class="icon la la-bell"></span></button>
            <div class="dropdown dashboard-option">
              <a class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('assets/images/resource/company-6.png') }}" alt="avatar" class="thumb">
                <span class="name">{{ Auth::user()->name }}</span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="{{ route('admin.change-password') }}"><i class="la la-lock"></i>Change Password</a></li>
                <li><a href="{{ route('admin.change-details') }}"><i class="la la-user-edit"></i>Change Details</a></li>
                <li>
                  <form method="post" action="{{ route('logout') }}">@csrf
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
      </div>
      <div id="nav-mobile"></div>
    </header>

    <div class="sidebar-backdrop"></div>
    <div class="user-sidebar">
      <div class="sidebar-inner">
        <ul class="navigation">
          <li><a href="{{ route('admin.dashboard') }}"> <i class="la la-home"></i> Dashboard</a></li>
          <li><a href="{{ route('admin.company-profile') }}"><i class="la la-user-tie"></i>Company Profile</a></li>
          <li><a href="{{ route('admin.post-job') }}"><i class="la la-paper-plane"></i>Post a New Job</a></li>
          <li><a href="{{ route('admin.manage-jobs') }}"><i class="la la-briefcase"></i> Manage Jobs </a></li>
          <li class="active"><a href="{{ route('admin.all-applicants') }}"><i class="la la-file-invoice"></i> All Applicants</a></li>
          <li><a href="{{ route('admin.manage-categories') }}"><i class="la la-tags"></i> Manage Categories </a></li>
          <li>
            <form method="post" action="{{ route('logout') }}">@csrf
              <button type="submit" style="background:none;border:none;width:100%;text-align:left;padding:8px 20px;">
                <i class="la la-sign-out"></i>Logout
              </button>
            </form>
          </li>
        </ul>
      </div>
    </div>

    <section class="user-dashboard">
      <div class="dashboard-outer">
        <div class="upper-title-box">
          <h3>All Applicants</h3>
          <div class="text">All applications for your posted jobs</div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="ls-widget">
              <div class="widget-title"><h4>Applicants</h4></div>
              <div class="widget-content">
                @forelse($applications as $applicant)
                  <div class="candidate-block-three">
                    <div class="inner-box" style="display:flex;justify-content:space-between;align-items:center;gap:16px;">
                      <div class="content" style="display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
                        <figure class="image"><img src="{{ $applicant->avatar_url }}" alt="{{ $applicant->name }}" style="width:56px;height:56px;object-fit:cover;border-radius:50%;display:block;"></figure>
                        <div>
                          <h4 class="name" style="margin:0;">{{ $applicant->name }}</h4>
                          <div class="text-muted" style="font-size:14px;">Applied {{ $applicant->applied_at }} • {{ $applicant->status }}</div>
                          <ul class="candidate-info" style="margin:6px 0 0;padding:0;list-style:none;display:flex;gap:12px;flex-wrap:wrap;">
                            <li class="designation">{{ $applicant->position }}</li>
                            <li><span class="icon flaticon-map-locator"></span> {{ $applicant->location ?? 'N/A' }}</li>
                            <li><span class="icon la la-briefcase"></span> {{ $applicant->job_title }}</li>
                            <li><span class="icon la la-envelope"></span> {{ $applicant->email }}</li>
                            @if(!empty($applicant->phone))<li><span class="icon la la-phone"></span> {{ $applicant->phone }}</li>@endif
                          </ul>
                        </div>
                      </div>
                      <div class="option-box" style="display:flex;gap:8px;">
                        <a href="{{ $applicant->cv_url ?? '#' }}" target="_blank" class="theme-btn btn-style-three" style="white-space:nowrap;">Download CV</a>
                        <form method="POST" action="{{ route('admin.application.status', ['job' => $applicant->job_id, 'application' => $applicant->application_id]) }}">
                          @csrf<input type="hidden" name="status" value="shortlisted" />
                          <button type="submit" class="theme-btn btn-style-two" style="white-space:nowrap;">Shortlist</button>
                        </form>
                        <form method="POST" action="{{ route('admin.application.status', ['job' => $applicant->job_id, 'application' => $applicant->application_id]) }}">
                          @csrf<input type="hidden" name="status" value="rejected" />
                          <button type="submit" class="theme-btn btn-style-four" style="white-space:nowrap;">Reject</button>
                        </form>
                      </div>
                    </div>
                  </div>
                @empty
                  <div class="text-center" style="padding: 40px 0;">
                    <h4>No applicants yet</h4>
                    <a href="{{ route('admin.manage-jobs') }}" class="theme-btn btn-style-two"><i class="la la-arrow-left"></i> Back to Jobs</a>
                  </div>
                @endforelse

                @if($applications instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
                  <nav class="ls-pagination" style="margin-top:16px;">
                    <ul>
                      <li class="prev {{ $applications->onFirstPage() ? 'disabled' : '' }}">
                        <a href="{{ $applications->previousPageUrl() ?: '#' }}"><i class="fa fa-arrow-left"></i></a>
                      </li>
                      @for ($page = 1; $page <= $applications->lastPage(); $page++)
                        <li>
                          <a href="{{ $applications->url($page) }}" class="{{ $page === $applications->currentPage() ? 'current-page' : '' }}">{{ $page }}</a>
                        </li>
                      @endfor
                      <li class="next {{ $applications->hasMorePages() ? '' : 'disabled' }}">
                        <a href="{{ $applications->nextPageUrl() ?: '#' }}"><i class="fa fa-arrow-right"></i></a>
                      </li>
                    </ul>
                  </nav>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="copyright-text">
      <p>© {{ date('Y') }} BlueBridge IT Solutions. All Rights Reserved. This website was developed by BlueBridge IT Solutions.</p>
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
  <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>


