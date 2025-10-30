{{-- Superio candidate dashboard (candidate-dashboard.html) --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Superio | Candidate Dashboard</title>
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
     

                <!-- Only for Mobile View -->
                <li class="mm-add-listing">
                  <a href="#" class="theme-btn btn-style-one">Job Post</a>
                  <span>
                    <span class="contact-info">
                      <span class="phone-num"><span>Call us</span><a href="tel:1234567890">123 456 7890</a></span>
                      <span class="address">329 Queensberry Street, North Melbourne VIC <br>3051, Australia.</span>
                      <a href="mailto:support@superio.com" class="email">support@superio.com</a>
                    </span>
                    <span class="social-links">
                      <a href="#"><span class="fab fa-facebook-f"></span></a>
                      <a href="#"><span class="fab fa-twitter"></span></a>
                      <a href="#"><span class="fab fa-instagram"></span></a>
                      <a href="#"><span class="fab fa-linkedin-in"></span></a>
                    </span>
                  </span>
                </li>
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
          <li class="active"><a href="{{ route('candidate.dashboard') }}"> <i class="la la-home"></i> Dashboard</a></li>
          <li><a href="{{ route('candidate.profile') }}"><i class="la la-user-tie"></i>My Profile</a></li>
          <li><a href="{{ route('candidate.resume') }}"><i class="la la-file-invoice"></i>My Resume</a></li>
          <li><a href="#"><i class="la la-briefcase"></i> Applied Jobs </a></li>
          <li><a href="#"><i class="la la-bell"></i>Job Alerts</a></li>
          <li><a href="#"><i class="la la-bookmark-o"></i>Shortlisted Jobs</a></li>
          <li><a href="#"><i class="la la-file-invoice"></i> CV manager</a></li>
          <li><a href="#"><i class="la la-box"></i>Packages</a></li>
          <li><a href="#"><i class="la la-comment-o"></i>Messages</a></li>
          <li><a href="#"><i class="la la-lock"></i>Change Password</a></li>
          <li><a href="#"><i class="la la-user-alt"></i>View Profile</a></li>
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
          <h3>Howdy, {{ Auth::user()->name }}!</h3>
          <div class="text">Ready to jump back in?</div>
        </div>
        <div class="row">
          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="ui-item">
              <div class="left">
                <i class="icon flaticon-briefcase"></i>
              </div>
              <div class="right">
                <h4>{{ $appliedJobs }}</h4>
                <p>Applied Jobs</p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="ui-item ui-red">
              <div class="left">
                <i class="icon la la-file-invoice"></i>
              </div>
              <div class="right">
                <h4>{{ $jobAlertsCount }}</h4>
                <p>Job Alerts</p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
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
          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
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
          <div class="col-lg-7">
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

          <div class="col-lg-5">
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
                <h4>Jobs Applied Recently</h4>
              </div>
              <div class="widget-content">
                <div class="row">
                  <!-- Job Block -->
                  <div class="job-block col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-box">
                      <div class="content">
                        <span class="company-logo"><img src="{{ asset('assets/images/resource/company-logo/1-1.png') }}" alt=""></span>
                        <h4><a href="#">Software Engineer (Android), Libraries</a></h4>
                        <ul class="job-info">
                          <li><span class="icon flaticon-briefcase"></span> Segment</li>
                          <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                          <li><span class="icon flaticon-clock-3"></span> 11 hours ago</li>
                          <li><span class="icon flaticon-money"></span> $35k - $45k</li>
                        </ul>
                        <ul class="job-other-info">
                          <li class="time">Full Time</li>
                          <li class="privacy">Private</li>
                          <li class="required">Urgent</li>
                        </ul>
                        <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                      </div>
                    </div>
                  </div>

                  <!-- Job Block -->
                  <div class="job-block col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-box">
                      <div class="content">
                        <span class="company-logo"><img src="{{ asset('assets/images/resource/company-logo/1-2.png') }}" alt=""></span>
                        <h4><a href="#">Recruiting Coordinator</a></h4>
                        <ul class="job-info">
                          <li><span class="icon flaticon-briefcase"></span> Segment</li>
                          <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                          <li><span class="icon flaticon-clock-3"></span> 11 hours ago</li>
                          <li><span class="icon flaticon-money"></span> $35k - $45k</li>
                        </ul>
                        <ul class="job-other-info">
                          <li class="time">Full Time</li>
                          <li class="privacy">Private</li>
                          <li class="required">Urgent</li>
                        </ul>
                        <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                      </div>
                    </div>
                  </div>

                  <!-- Job Block -->
                  <div class="job-block col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-box">
                      <div class="content">
                        <span class="company-logo"><img src="{{ asset('assets/images/resource/company-logo/1-3.png') }}" alt=""></span>
                        <h4><a href="#">Product Manager, Studio</a></h4>
                        <ul class="job-info">
                          <li><span class="icon flaticon-briefcase"></span> Segment</li>
                          <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                          <li><span class="icon flaticon-clock-3"></span> 11 hours ago</li>
                          <li><span class="icon flaticon-money"></span> $35k - $45k</li>
                        </ul>
                        <ul class="job-other-info">
                          <li class="time">Full Time</li>
                          <li class="privacy">Private</li>
                          <li class="required">Urgent</li>
                        </ul>
                        <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                      </div>
                    </div>
                  </div>

                  <!-- Job Block -->
                  <div class="job-block col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-box">
                      <div class="content">
                        <span class="company-logo"><img src="{{ asset('assets/images/resource/company-logo/1-4.png') }}" alt=""></span>
                        <h4><a href="#">Senior Product Designer</a></h4>
                        <ul class="job-info">
                          <li><span class="icon flaticon-briefcase"></span> Segment</li>
                          <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                          <li><span class="icon flaticon-clock-3"></span> 11 hours ago</li>
                          <li><span class="icon flaticon-money"></span> $35k - $45k</li>
                        </ul>
                        <ul class="job-other-info">
                          <li class="time">Full Time</li>
                          <li class="privacy">Private</li>
                          <li class="required">Urgent</li>
                        </ul>
                        <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                      </div>
                    </div>
                  </div>

                  <!-- Job Block -->
                  <div class="job-block col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-box">
                      <div class="content">
                        <span class="company-logo"><img src="{{ asset('assets/images/resource/company-logo/1-5.png') }}" alt=""></span>
                        <h4><a href="#">Senior Full Stack Engineer, Creator Success</a></h4>
                        <ul class="job-info">
                          <li><span class="icon flaticon-briefcase"></span> Segment</li>
                          <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                          <li><span class="icon flaticon-clock-3"></span> 11 hours ago</li>
                          <li><span class="icon flaticon-money"></span> $35k - $45k</li>
                        </ul>
                        <ul class="job-other-info">
                          <li class="time">Full Time</li>
                          <li class="privacy">Private</li>
                          <li class="required">Urgent</li>
                        </ul>
                        <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                      </div>
                    </div>
                  </div>

                  <!-- Job Block -->
                  <div class="job-block col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-box">
                      <div class="content">
                        <span class="company-logo"><img src="{{ asset('assets/images/resource/company-logo/1-6.png') }}" alt=""></span>
                        <h4><a href="#">Software Engineer (Android), Libraries</a></h4>
                        <ul class="job-info">
                          <li><span class="icon flaticon-briefcase"></span> Segment</li>
                          <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                          <li><span class="icon flaticon-clock-3"></span> 11 hours ago</li>
                          <li><span class="icon flaticon-money"></span> $35k - $45k</li>
                        </ul>
                        <ul class="job-other-info">
                          <li class="time">Full Time</li>
                          <li class="privacy">Private</li>
                          <li class="required">Urgent</li>
                        </ul>
                        <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
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

  <!-- Chart.js // documentation: http://www.chartjs.org/docs/latest/ -->
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