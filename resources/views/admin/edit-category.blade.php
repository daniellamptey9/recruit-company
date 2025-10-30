{{-- Superio admin edit category --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Superio | Edit Category</title>
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
    
    .icon-preview {
      font-size: 20px;
      margin-left: 10px;
      vertical-align: middle;
    }
    
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
          <h3>Edit Category</h3>
          <div class="text">Update category information</div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif

        @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif

        <!-- Edit Category Form -->
        <div class="row">
          <div class="col-lg-12">
            <div class="ls-widget">
              <div class="tabs-box">
                <div class="widget-title">
                  <h4>Category Information</h4>
                </div>
                <div class="widget-content">
                  <form method="POST" action="{{ route('admin.update-category', $category->id) }}" class="default-form">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                      <!-- Category Name -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $category->name) }}" placeholder="e.g., Information Technology" required>
                        @error('name')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Description -->
                      <div class="form-group col-lg-12 col-md-12">
                        <label>Description</label>
                        <textarea name="description" placeholder="Brief description of this category">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Icon -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Icon Class</label>
                        <div class="input-group">
                          <input type="text" name="icon" value="{{ old('icon', $category->icon) }}" placeholder="e.g., la la-laptop-code" id="iconInput">
                          <button type="button" class="btn btn-outline-secondary" id="iconPickerBtn">
                            <i class="la la-search"></i> Pick Icon
                          </button>
                        </div>
                        <small class="text-muted">Use Line Awesome icon classes (e.g., la la-laptop-code)</small>
                        <div class="mt-2">
                          <i class="{{ old('icon', $category->icon) }} icon-preview" id="iconPreview"></i>
                          <span class="ms-2 text-muted" id="iconName">{{ old('icon', $category->icon) }}</span>
                        </div>
                        @error('icon')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Sort Order -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}" placeholder="0" min="0">
                        <small class="text-muted">Lower numbers appear first</small>
                        @error('sort_order')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Status -->
                      <div class="form-group col-lg-12 col-md-12">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                            Active Category
                          </label>
                          <small class="text-muted">Inactive categories won't appear in job posting forms</small>
                        </div>
                      </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="form-group col-lg-12">
                      <button type="submit" class="theme-btn btn-style-one">
                        <i class="la la-save"></i> Update Category
                      </button>
                      <a href="{{ route('admin.manage-categories') }}" class="theme-btn btn-style-two">
                        <i class="la la-arrow-left"></i> Back to Categories
                      </a>
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
  </div>

  <!-- Icon Picker Modal -->
  <div class="modal fade" id="iconPickerModal" tabindex="-1" aria-labelledby="iconPickerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="iconPickerModalLabel">Choose an Icon</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row" id="iconGrid">
            <!-- Icons will be populated by JavaScript -->
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

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

    // Icon picker functionality
    const iconList = [
      'la la-briefcase', 'la la-laptop-code', 'la la-chart-line', 'la la-paint-brush',
      'la la-heart', 'la la-graduation-cap', 'la la-car', 'la la-home',
      'la la-utensils', 'la la-shopping-cart', 'la la-plane', 'la la-gamepad',
      'la la-music', 'la la-camera', 'la la-book', 'la la-dumbbell',
      'la la-stethoscope', 'la la-gavel', 'la la-hammer', 'la la-wrench',
      'la la-palette', 'la la-pen', 'la la-calculator', 'la la-microscope',
      'la la-flask', 'la la-atom', 'la la-rocket', 'la la-satellite',
      'la la-mobile', 'la la-desktop', 'la la-server', 'la la-database',
      'la la-shield-alt', 'la la-lock', 'la la-key', 'la la-fingerprint',
      'la la-eye', 'la la-search', 'la la-bullhorn', 'la la-megaphone',
      'la la-phone', 'la la-envelope', 'la la-comments', 'la la-users',
      'la la-user-tie', 'la la-user-graduate', 'la la-user-md', 'la la-user-cog',
      'la la-tools', 'la la-cog', 'la la-settings', 'la la-sliders-h',
      'la la-chart-bar', 'la la-chart-pie', 'la la-chart-area', 'la la-trending-up',
      'la la-coins', 'la la-dollar-sign', 'la la-credit-card', 'la la-wallet',
      'la la-store', 'la la-shopping-bag', 'la la-truck', 'la la-shipping-fast',
      'la la-warehouse', 'la la-box', 'la la-archive', 'la la-folder',
      'la la-file', 'la la-file-alt', 'la la-clipboard', 'la la-list',
      'la la-check-circle', 'la la-times-circle', 'la la-exclamation-circle', 'la la-question-circle',
      'la la-info-circle', 'la la-lightbulb', 'la la-star', 'la la-thumbs-up',
      'la la-handshake', 'la la-award', 'la la-medal', 'la la-trophy',
      'la la-gem', 'la la-diamond', 'la la-crown', 'la la-magic',
      'la la-wand-magic-sparkles', 'la la-sparkles', 'la la-fire', 'la la-bolt',
      'la la-sun', 'la la-moon', 'la la-cloud', 'la la-rainbow'
    ];

    $(document).ready(function() {
      try {
        // Initialize icon picker
        initializeIconPicker();
        
        // Update icon preview on input change
        $('#iconInput').on('input', function() {
          updateIconPreview($(this).val());
        });

        // Icon picker button click
        $('#iconPickerBtn').on('click', function() {
          $('#iconPickerModal').modal('show');
        });

        // Form validation
        $('form').on('submit', function(e) {
          const name = $('input[name="name"]').val().trim();
          if (!name) {
            e.preventDefault();
            toastr.error('Category name is required');
            return false;
          }
        });

      } catch (error) {
        console.error('Error in edit category page:', error);
      }
    });

    function initializeIconPicker() {
      const iconGrid = $('#iconGrid');
      iconGrid.empty();
      
      iconList.forEach(function(iconClass) {
        const iconDiv = $(`
          <div class="col-2 col-md-1 mb-3 text-center">
            <div class="icon-option" data-icon="${iconClass}" style="cursor: pointer; padding: 10px; border: 2px solid transparent; border-radius: 5px; transition: all 0.3s;">
              <i class="${iconClass}" style="font-size: 24px; color: #666;"></i>
            </div>
          </div>
        `);
        
        iconDiv.find('.icon-option').on('click', function() {
          const selectedIcon = $(this).data('icon');
          $('#iconInput').val(selectedIcon);
          updateIconPreview(selectedIcon);
          $('#iconPickerModal').modal('hide');
        });
        
        iconDiv.find('.icon-option').on('mouseenter', function() {
          $(this).css({
            'border-color': '#1967d2',
            'background-color': '#f8f9fa'
          });
        }).on('mouseleave', function() {
          $(this).css({
            'border-color': 'transparent',
            'background-color': 'transparent'
          });
        });
        
        iconGrid.append(iconDiv);
      });
    }

    function updateIconPreview(iconClass) {
      $('#iconPreview').attr('class', iconClass + ' icon-preview');
      $('#iconName').text(iconClass);
    }
  </script>
</body>
</html>
