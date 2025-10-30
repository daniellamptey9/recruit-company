{{-- Superio admin dashboard (dashboard.html) --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Superio | Dashboard</title>
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
    <div class="preloader"></div>
    <span class="header-span"></span>
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

    <!-- Sidebar Backdrop -->
    <div class="sidebar-backdrop"></div>

    <!-- User Sidebar -->
    <div class="user-sidebar">

      <div class="sidebar-inner">
        <ul class="navigation">
          <li class="active"><a href="{{ route('admin.dashboard') }}"> <i class="la la-home"></i> Dashboard</a></li>
          <li><a href="{{ route('admin.company-profile') }}"><i class="la la-user-tie"></i>Company Profile</a></li>
          <li><a href="{{ route('admin.post-job') }}"><i class="la la-paper-plane"></i>Post a New Job</a></li>
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
          <h3>Howdy, {{ Auth::user()->name }}!</h3>
          <div class="text">Ready to jump back in?</div>
        </div>
        <div class="row">
          <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="ui-item">
              <div class="left">
                <i class="icon flaticon-briefcase"></i>
              </div>
              <div class="right">
                <h4>{{ $postedJobs }}</h4>
                <p>Posted Jobs</p>
              </div>
            </div>
          </div>
          <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="ui-item ui-red">
              <div class="left">
                <i class="icon la la-file-invoice"></i>
              </div>
              <div class="right">
                <h4>{{ $applicationsCount }}</h4>
                <p>Application</p>
              </div>
            </div>
          </div>
          <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="ui-item ui-yellow">
              <div class="left">
                <i class="icon la la-comment-o"></i>
              </div>
              <div class="right">
                <h4>{{ $messagesCount }}</h4>
                <p>Messages</p>
              </div>
            </div>
          </div>
          <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="ui-item ui-green">
              <div class="left">
                <i class="icon la la-bookmark-o"></i>
              </div>
              <div class="right">
                <h4>{{ $shortlistCount }}</h4>
                <p>Shortlist</p>
              </div>
            </div>
          </div>
        </div>

        <div class="row">


          <div class="col-xl-7 col-lg-12">
            <!-- Graph widget -->
            <div class="graph-widget ls-widget">
              <div class="tabs-box">
                <div class="widget-title">
                  <h4>Your Profile Views</h4>
                  <div class="chosen-outer">
                    <!--Tabs Box-->
                    <select class="chosen-select">
                      <option>Last 6 Months</option>
                      <option>Last 12 Months</option>
                      <option>Last 16 Months</option>
                      <option>Last 24 Months</option>
                      <option>Last 5 year</option>
                    </select>
                  </div>
                </div>

                <div class="widget-content">
                  <canvas id="chart" width="100" height="45"></canvas>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-5 col-lg-12">
            <!-- Notification Widget -->
            <div class="notification-widget ls-widget">
              <div class="widget-title">
                <h4>Notifications</h4>
              </div>
              <div class="widget-content">
                <ul class="notification-list">
                  <li><span class="icon flaticon-briefcase"></span> <strong>Wade Warren</strong> applied for a job <span class="colored">Web Developer</span></li>
                  <li><span class="icon flaticon-briefcase"></span> <strong>Henry Wilson</strong> applied for a job <span class="colored">Senior Product Designer</span></li>
                  <li class="success"><span class="icon flaticon-briefcase"></span> <strong>Raul Costa</strong> applied for a job <span class="colored">Product Manager, Risk</span></li>
                  <li><span class="icon flaticon-briefcase"></span> <strong>Jack Milk</strong> applied for a job <span class="colored">Technical Architect</span></li>
                  <li class="success"><span class="icon flaticon-briefcase"></span> <strong>Michel Arian</strong> applied for a job <span class="colored">Software Engineer</span></li>
                  <li><span class="icon flaticon-briefcase"></span> <strong>Ali Tufan</strong> applied for a job <span class="colored">UI Designer</span></li>
                </ul>
              </div>
            </div>
          </div>


          <div class="col-lg-12">
            <!-- applicants Widget -->
            <div class="applicants-widget ls-widget">
              <div class="widget-title">
                <h4>Recent Applicants</h4>
              </div>
              <div class="widget-content">
                <div class="row">
                  <!-- Candidate block three -->
                  <div class="candidate-block-three col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-box">
                      <div class="content">
                        <figure class="image"><img src="{{ asset('assets/images/resource/candidate-1.png') }}" alt=""></figure>
                        <h4 class="name"><a href="#">Darlene Robertson</a></h4>
                        <ul class="candidate-info">
                          <li class="designation">UI Designer</li>
                          <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                          <li><span class="icon flaticon-money"></span> $99 / hour</li>
                        </ul>
                        <ul class="post-tags">
                          <li><a href="#">App</a></li>
                          <li><a href="#">Design</a></li>
                          <li><a href="#">Digital</a></li>
                        </ul>
                      </div>
                      <div class="option-box">
                        <ul class="option-list">
                          <li><button data-text="View Aplication"><span class="la la-eye"></span></button></li>
                          <li><button data-text="Approve Aplication"><span class="la la-check"></span></button></li>
                          <li><button data-text="Reject Aplication"><span class="la la-times-circle"></span></button></li>
                          <li><button data-text="Delete Aplication"><span class="la la-trash"></span></button></li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <!-- Candidate block three -->
                  <div class="candidate-block-three col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-box">
                      <div class="content">
                        <figure class="image"><img src="{{ asset('assets/images/resource/candidate-2.png') }}" alt=""></figure>
                        <h4 class="name"><a href="#">Wade Warren</a></h4>
                        <ul class="candidate-info">
                          <li class="designation">UI Designer</li>
                          <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                          <li><span class="icon flaticon-money"></span> $99 / hour</li>
                        </ul>
                        <ul class="post-tags">
                          <li><a href="#">App</a></li>
                          <li><a href="#">Design</a></li>
                          <li><a href="#">Digital</a></li>
                        </ul>
                      </div>
                      <div class="option-box">
                        <ul class="option-list">
                          <li><button data-text="View Aplication"><span class="la la-eye"></span></button></li>
                          <li><button data-text="Approve Aplication"><span class="la la-check"></span></button></li>
                          <li><button data-text="Reject Aplication"><span class="la la-times-circle"></span></button></li>
                          <li><button data-text="Delete Aplication"><span class="la la-trash"></span></button></li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <!-- Candidate block three -->
                  <div class="candidate-block-three col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-box">
                      <div class="content">
                        <figure class="image"><img src="{{ asset('assets/images/resource/candidate-3.png') }}" alt=""></figure>
                        <h4 class="name"><a href="#">Leslie Alexander</a></h4>
                        <ul class="candidate-info">
                          <li class="designation">UI Designer</li>
                          <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                          <li><span class="icon flaticon-money"></span> $99 / hour</li>
                        </ul>
                        <ul class="post-tags">
                          <li><a href="#">App</a></li>
                          <li><a href="#">Design</a></li>
                          <li><a href="#">Digital</a></li>
                        </ul>
                      </div>
                      <div class="option-box">
                        <ul class="option-list">
                          <li><button data-text="View Aplication"><span class="la la-eye"></span></button></li>
                          <li><button data-text="Approve Aplication"><span class="la la-check"></span></button></li>
                          <li><button data-text="Reject Aplication"><span class="la la-times-circle"></span></button></li>
                          <li><button data-text="Delete Aplication"><span class="la la-trash"></span></button></li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <!-- Candidate block three -->
                  <div class="candidate-block-three col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-box">
                      <div class="content">
                        <figure class="image"><img src="{{ asset('assets/images/resource/candidate-1.png') }}" alt=""></figure>
                        <h4 class="name"><a href="#">Darlene Robertson</a></h4>
                        <ul class="candidate-info">
                          <li class="designation">UI Designer</li>
                          <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                          <li><span class="icon flaticon-money"></span> $99 / hour</li>
                        </ul>
                        <ul class="post-tags">
                          <li><a href="#">App</a></li>
                          <li><a href="#">Design</a></li>
                          <li><a href="#">Digital</a></li>
                        </ul>
                      </div>
                      <div class="option-box">
                        <ul class="option-list">
                          <li><button data-text="View Aplication"><span class="la la-eye"></span></button></li>
                          <li><button data-text="Approve Aplication"><span class="la la-check"></span></button></li>
                          <li><button data-text="Reject Aplication"><span class="la la-times-circle"></span></button></li>
                          <li><button data-text="Delete Aplication"><span class="la la-trash"></span></button></li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <!-- Candidate block three -->
                  <div class="candidate-block-three col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-box">
                      <div class="content">
                        <figure class="image"><img src="{{ asset('assets/images/resource/candidate-2.png') }}" alt=""></figure>
                        <h4 class="name"><a href="#">Wade Warren</a></h4>
                        <ul class="candidate-info">
                          <li class="designation">UI Designer</li>
                          <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                          <li><span class="icon flaticon-money"></span> $99 / hour</li>
                        </ul>
                        <ul class="post-tags">
                          <li><a href="#">App</a></li>
                          <li><a href="#">Design</a></li>
                          <li><a href="#">Digital</a></li>
                        </ul>
                      </div>
                      <div class="option-box">
                        <ul class="option-list">
                          <li><button data-text="View Aplication"><span class="la la-eye"></span></button></li>
                          <li><button data-text="Approve Aplication"><span class="la la-check"></span></button></li>
                          <li><button data-text="Reject Aplication"><span class="la la-times-circle"></span></button></li>
                          <li><button data-text="Delete Aplication"><span class="la la-trash"></span></button></li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <!-- Candidate block three -->
                  <div class="candidate-block-three col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-box">
                      <div class="content">
                        <figure class="image"><img src="{{ asset('assets/images/resource/candidate-3.png') }}" alt=""></figure>
                        <h4 class="name"><a href="#">Leslie Alexander</a></h4>
                        <ul class="candidate-info">
                          <li class="designation">UI Designer</li>
                          <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                          <li><span class="icon flaticon-money"></span> $99 / hour</li>
                        </ul>
                        <ul class="post-tags">
                          <li><a href="#">App</a></li>
                          <li><a href="#">Design</a></li>
                          <li><a href="#">Digital</a></li>
                        </ul>
                      </div>
                      <div class="option-box">
                        <ul class="option-list">
                          <li><button data-text="View Aplication"><span class="la la-eye"></span></button></li>
                          <li><button data-text="Approve Aplication"><span class="la la-check"></span></button></li>
                          <li><button data-text="Reject Aplication"><span class="la la-times-circle"></span></button></li>
                          <li><button data-text="Delete Aplication"><span class="la la-trash"></span></button></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Dashboard -->

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
  <script src="{{ asset('assets/js/script.js') }}"></script>
  <script src="{{ asset('assets/js/chart.min.js') }}"></script>
  <script>
    Chart.defaults.global.defaultFontFamily = "Sofia Pro";
    Chart.defaults.global.defaultFontColor = '#888';
    Chart.defaults.global.defaultFontSize = '14';

    var ctx = document.getElementById('chart').getContext('2d');

    var chart = new Chart(ctx, {

      type: 'line',
      // The data for our dataset
      data: {
        labels: ["January", "February", "March", "April", "May", "June"],
        // Information about the dataset
        datasets: [{
          label: "Views",
          backgroundColor: 'transparent',
          borderColor: '#1967D2',
          borderWidth: "1",
          data: [196, 132, 215, 362, 210, 252],
          pointRadius: 3,
          pointHoverRadius: 3,
          pointHitRadius: 10,
          pointBackgroundColor: "#1967D2",
          pointHoverBackgroundColor: "#1967D2",
          pointBorderWidth: "2",
        }]
      },

      // Configuration options
      options: {

        layout: {
          padding: 10,
        },

        legend: {
          display: false
        },
        title: {
          display: false
        },

        scales: {
          yAxes: [{
            scaleLabel: {
              display: false
            },
            gridLines: {
              borderDash: [6, 10],
              color: "#d8d8d8",
              lineWidth: 1,
            },
          }],
          xAxes: [{
            scaleLabel: {
              display: false
            },
            gridLines: {
              display: false
            },
          }],
        },

        tooltips: {
          backgroundColor: '#333',
          titleFontSize: 13,
          titleFontColor: '#fff',
          bodyFontColor: '#fff',
          bodyFontSize: 13,
          displayColors: false,
          xPadding: 10,
          yPadding: 10,
          intersect: false
        }
      },
    });
  </script>

</body>
</html>


