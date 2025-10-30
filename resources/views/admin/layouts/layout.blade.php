@extends('admin.master')

@section('content')

  <!-- Dashboard -->
  <section class="user-dashboard">
      <div class="dashboard-outer">
        <div class="upper-title-box">
          <h3>Howdy, {{ Auth::user()->name }}</h3>
          <div class="text">Ready to jump back in?</div>
        </div>
        <div class="row">
          <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="ui-item">
              <div class="left">
                <i class="icon flaticon-briefcase"></i>
              </div>
              <div class="right">
                <h4>{{ $postedJobs ?? 0 }}</h4>
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
                <h4>{{ $applicationsCount ?? 0 }}</h4>
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
                <h4>{{ $messagesCount ?? 0 }}</h4>
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
                <h4>{{ $shortlistCount ?? 0 }}</h4>
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
                  @forelse(($recentApplications ?? []) as $ra)
                    <li class="{{ ($ra->status ?? '') === 'shortlisted' ? 'success' : '' }}">
                      <span class="icon flaticon-briefcase"></span>
                      <strong>{{ $ra->name }}</strong> applied for a job <span class="colored">{{ $ra->job_title }}</span>
                    </li>
                  @empty
                    <li>No recent notifications.</li>
                  @endforelse
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
                  @forelse(($recentApplications ?? []) as $ra)
                    <div class="candidate-block-three col-lg-6 col-md-12 col-sm-12">
                      <div class="inner-box">
                        <div class="content">
                          <figure class="image"><img src="{{ $ra->avatar_url }}" alt="{{ $ra->name }}"></figure>
                          <h4 class="name"><a href="#">{{ $ra->name }}</a></h4>
                          <ul class="candidate-info">
                            <li class="designation">{{ $ra->position }}</li>
                            @if(!empty($ra->location))<li><span class="icon flaticon-map-locator"></span> {{ $ra->location }}</li>@endif
                            @if(!empty($ra->expected_salary))<li><span class="icon flaticon-money"></span> {{ $ra->expected_salary }}</li>@endif
                            <li><span class="icon la la-clock"></span> Applied: {{ $ra->applied_at }}</li>
                          </ul>
                          @if(!empty($ra->skills))
                            <ul class="post-tags">
                              @foreach($ra->skills as $skill)
                                <li><a href="#">{{ $skill }}</a></li>
                              @endforeach
                            </ul>
                          @endif
                        </div>
                      </div>
                    </div>
                  @empty
                    <div class="col-12"><div class="text-center" style="padding: 20px 0;">No recent applications</div></div>
                  @endforelse
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Dashboard -->

@endsection