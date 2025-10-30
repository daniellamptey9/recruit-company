{{-- Superio admin manage categories --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Superio | Manage Categories</title>
  <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
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
    
    .category-icon {
      font-size: 16px;
      margin-right: 8px;
    }
    
    .status-badge {
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 12px;
      font-weight: bold;
    }
    
    .status-badge.active {
      background-color: #d4edda;
      color: #155724;
    }
    
    .status-badge.inactive {
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
    
    .modal-footer {
      border-top: 1px solid #dee2e6;
      padding: 15px;
    }
    
    /* Preloader styles */
    .preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: #fff;
      z-index: 9999;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .preloader:before {
      content: '';
      width: 50px;
      height: 50px;
      border: 3px solid #f3f3f3;
      border-top: 3px solid #1967d2;
      border-radius: 50%;
      animation: spin 1s linear infinite;
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
          <li><a href="{{ route('admin.manage-jobs') }}"><i class="la la-briefcase"></i> Manage Jobs </a></li>
          <li class="active"><a href="{{ route('admin.manage-categories') }}"><i class="la la-tags"></i> Manage Categories </a></li>
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
          <h3>Manage Categories</h3>
          <div class="text">Manage job categories</div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

        @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

        <!-- Categories Table -->
        <div class="row">
          <div class="col-lg-12">
            <div class="ls-widget">
              <div class="tabs-box">
                <div class="widget-title">
                  <h4>All Categories</h4>
                  <div class="text-right">
                    <a href="{{ route('admin.create-category') }}" class="theme-btn btn-style-one">
                      <i class="la la-plus"></i> Add New Category
                    </a>
                  </div>
                </div>
                <div class="widget-content">
                  @if($categories->count() > 0)
                    <div class="table-outer">
                      <table class="default-table manage-job-table">
                        <thead>
                          <tr>
                            <th>Category Name</th>
                            <th>Icon</th>
                            <th>Sort Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($categories as $category)
                            <tr>
                              <td>
                                <h6>{{ $category->name }}</h6>
                                @if($category->description)
                                  <span class="info">{{ Str::limit($category->description, 50) }}</span>
                                @endif
                              </td>
                              <td>
                                <i class="{{ $category->icon }} category-icon"></i>
                                <small>{{ $category->icon }}</small>
                              </td>
                              <td>{{ $category->sort_order }}</td>
                              <td>
                                <span class="status-badge {{ $category->is_active ? 'active' : 'inactive' }}">
                                  {{ $category->is_active ? 'Active' : 'Inactive' }}
                                </span>
                              </td>
                              <td>
                                <div class="option-box">
                                  <ul class="option-list">
                                    <li>
                                      <a href="{{ route('admin.edit-category', $category->id) }}" data-text="Edit">
                                        <span class="la la-pencil"></span>
                                      </a>
                                    </li>
                                    <li>
                                      <form method="POST" action="{{ route('admin.destroy-category', $category->id) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" data-text="Delete" style="background: none; border: none; padding: 0;">
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
                    @if($categories->hasPages())
                      <div class="ls-pagination">
                        <div class="pagination-info-wrapper">
                          <div class="pagination-info">
                            <span>Showing <strong>{{ $categories->firstItem() }}</strong> to <strong>{{ $categories->lastItem() }}</strong> of <strong>{{ $categories->total() }}</strong> categories</span>
                          </div>
                          <div class="pagination-links">
                            {{ $categories->links('pagination::bootstrap-4') }}
                          </div>
                        </div>
                      </div>
                    @endif
                  @else
                    <div class="text-center" style="padding: 40px 0;">
                      <h4>No categories found</h4>
                      <p>Start by creating your first category!</p>
                      <a href="{{ route('admin.create-category') }}" class="theme-btn btn-style-one">
                        <i class="la la-plus"></i> Add New Category
                      </a>
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

    // Hide preloader when page loads
    $(window).on('load', function() {
      $('.preloader').fadeOut(500);
    });

    // Hide preloader when document is ready (fallback)
    $(document).ready(function() {
      setTimeout(function() {
        $('.preloader').fadeOut(500);
      }, 1000);
    });

    // Force hide preloader after 5 seconds
    setTimeout(function() {
      $('.preloader').fadeOut(500);
    }, 5000);

    // Simple page functionality
    $(document).ready(function() {
      // Any page-specific functionality can go here
    });
  </script>
</body>
</html>
