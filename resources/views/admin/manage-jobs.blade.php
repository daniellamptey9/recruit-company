{{-- Superio admin manage jobs --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Superio | Manage Jobs</title>
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
    
    .job-status {
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 12px;
      font-weight: bold;
    }
    
    .job-status.active {
      background-color: #d4edda;
      color: #155724;
    }
    
    .job-status.inactive {
      background-color: #f8d7da;
      color: #721c24;
    }
    
    .ls-pagination {
      margin-top: 30px;
      padding: 20px 0;
      border-top: 1px solid #e8e8e8;
    }
    
    .pagination-info-wrapper {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 15px;
    }
    
    .pagination-info {
      color: #666;
      font-size: 13px;
      font-weight: 400;
    }
    
    .pagination-info strong {
      color: #1967d2;
      font-weight: 600;
    }
    
    .pagination-links {
      display: flex;
      align-items: center;
    }
    
    .pagination-links .pagination {
      margin: 0;
      display: flex;
      list-style: none;
      padding: 0;
      gap: 4px;
    }
    
    .pagination-links .pagination .page-item {
      margin: 0;
    }
    
    .pagination-links .pagination .page-link {
      color: #666;
      background-color: #fff;
      border: 1px solid #e0e0e0;
      padding: 6px 12px;
      border-radius: 4px;
      text-decoration: none;
      min-width: 32px;
      height: 32px;
      text-align: center;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s ease;
      font-size: 13px;
      font-weight: 500;
      line-height: 1;
    }
    
    .pagination-links .pagination .page-link i {
      font-size: 14px;
      line-height: 1;
    }
    
    .pagination-links .pagination .page-link:hover {
      background-color: #1967d2;
      color: #fff;
      border-color: #1967d2;
      transform: translateY(-1px);
      box-shadow: 0 2px 4px rgba(25, 103, 210, 0.2);
    }
    
    .pagination-links .pagination .page-item.active .page-link {
      background-color: #1967d2;
      border-color: #1967d2;
      color: #fff;
      font-weight: 600;
      box-shadow: 0 2px 4px rgba(25, 103, 210, 0.2);
    }
    
    .pagination-links .pagination .page-item.disabled .page-link {
      color: #ccc;
      background-color: #f8f9fa;
      border-color: #e0e0e0;
      cursor: not-allowed;
      opacity: 0.6;
    }
    
    .pagination-links .pagination .page-item.disabled .page-link:hover {
      background-color: #f8f9fa;
      color: #ccc;
      border-color: #e0e0e0;
      transform: none;
      box-shadow: none;
    }
    
    @media (max-width: 768px) {
      .pagination-info-wrapper {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }
      
      .pagination-links .pagination {
        flex-wrap: wrap;
        justify-content: center;
      }
      
      .pagination-links .pagination .page-link {
        padding: 5px 10px;
        min-width: 30px;
        height: 30px;
        font-size: 12px;
      }
      
      .pagination-links .pagination .page-link i {
        font-size: 13px;
      }
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
          <h3>Manage Jobs</h3>
          <div class="text">Manage all your job postings</div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <!-- Ls widget -->
            <div class="ls-widget">
              <div class="tabs-box">
                <div class="widget-title">
                  <h4>All Jobs</h4>
                  <div class="text-right">
                    <a href="{{ route('admin.post-job') }}" class="theme-btn btn-style-one">Post New Job</a>
                  </div>
                </div>

                <div class="widget-content">
                  @if($jobs->count() > 0)
                    <div class="table-outer">
                      <table class="default-table manage-job-table">
                        <thead>
                          <tr>
                            <th>Job Title</th>
                            <th>Job Type</th>
                            <th>Salary Range</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($jobs as $job)
                            <tr>
                              <td>
                                <h6>{{ $job->title }}</h6>
                                <span class="info">{{ $job->industry }} • {{ $job->office_location }}</span>
                              </td>
                              <td>{{ $job->job_type }}</td>
                              <td>{{ $job->salary_range }}</td>
                              <td>{{ $job->formatted_deadline }}</td>
                              <td>
                                <span class="job-status {{ $job->is_active ? 'active' : 'inactive' }}">
                                  {{ $job->is_active ? 'Active' : 'Inactive' }}
                                </span>
                              </td>
                              <td>
                                <span class="job-status {{ $job->is_featured ? 'active' : 'inactive' }}">
                                  {{ $job->is_featured ? 'Featured' : 'Regular' }}
                                </span>
                              </td>
                              <td>
                                <div class="option-box">
                                  <ul class="option-list">
                                    <li>
                                      <a href="{{ route('admin.job.show', $job->id) }}" data-text="View">
                                        <span class="la la-eye"></span>
                                      </a>
                                    </li>
                                    <li>
                                      <a href="{{ route('admin.job.edit', $job->id) }}" data-text="Edit">
                                        <span class="la la-pencil"></span>
                                      </a>
                                    </li>
                                    <li>
                                      <form method="POST" action="{{ route('admin.job.destroy', $job->id) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this job?')" data-text="Delete">
                                          <span class="la la-trash"></span>
                                        </button>
                                      </form>
                                    </li>
                                  </ul>
                                </div>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>

                    <!-- Pagination -->
                    @if($jobs->hasPages())
                      <div class="ls-pagination">
                        <div class="pagination-info-wrapper">
                          <div class="pagination-info">
                            <span>Showing <strong>{{ $jobs->firstItem() }}</strong> to <strong>{{ $jobs->lastItem() }}</strong> of <strong>{{ $jobs->total() }}</strong> jobs</span>
                          </div>
                          <div class="pagination-links">
                            {{ $jobs->links('pagination::bootstrap-4') }}
                          </div>
                        </div>
                      </div>
                    @endif
                  @else
                    <div class="text-center" style="padding: 40px 0;">
                      <h4>No jobs posted yet</h4>
                      <p>Start by posting your first job!</p>
                      <a href="{{ route('admin.post-job') }}" class="theme-btn btn-style-one">Post New Job</a>
                    </div>
                  @endif
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
