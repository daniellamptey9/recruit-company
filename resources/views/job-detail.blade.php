@extends('master')

@section('title','Job Detail')

@section('content')

    <!--Page Title-->
    <section class="page-title style-two">
      <div class="auto-container">
        <div class="title-outer">
          <h1>{{ $job->title ?? 'Job Detail' }}</h1>
          <ul class="page-breadcrumb">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('jobs') }}">Jobs</a></li>
            <li>Job Detail</li>
          </ul>
        </div>
      </div>
    </section>
    <!--End Page Title-->


    <!-- Job Detail Section -->
    <section class="job-detail-section">
      <div class="job-detail-outer">
        <div class="auto-container">
          @php
            // Ensure we have site company fallback
            $siteCompany = \App\Models\Company::first();
            $hasApplied = auth()->check() ? \App\Models\JobApplication::where('user_id', auth()->id())->where('job_id', $job->id)->exists() : false;
          @endphp
          <div class="row">
            <div class="content-column col-lg-8 col-md-12 col-sm-12">
              <div class="job-block-outer">
                <!-- Job Block -->
                <div class="job-block-seven style-two">
                  <div class="inner-box">
                    <div class="content">
                      <h4><a href="#">{{ $job->title }}</a></h4>
                      <ul class="job-info">
                        <li><span class="icon flaticon-briefcase"></span> {{ optional($job->company)->name ?? ($siteCompany->name ?? 'Company') }}</li>
                        <li><span class="icon flaticon-map-locator"></span> {{ $job->office_location ?? 'Location' }}</li>
                        <li><span class="icon flaticon-clock-3"></span> {{ $job->created_at?->diffForHumans() }}</li>
                        @if(!empty($job->salary_range))
                        <li><span class="icon flaticon-money"></span> {{ $job->salary_range }}</li>
                        @endif
                      </ul>
                      <ul class="job-other-info">
                        @if(!empty($job->job_type))
                        <li class="time">{{ $job->job_type }}</li>
                        @endif
                        @if(!empty($job->work_location))
                        <li class="privacy">{{ $job->work_location }}</li>
                        @endif
                        @if(!empty($job->deadline) && $job->deadline->isFuture() && $job->deadline->diffInDays(now()) <= 7)
                        <li class="required">Urgent</li>
                        @endif
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <div class="job-overview-two">
                <h4>Job Overview</h4>
                <ul>
                  <li>
                    <i class="icon icon-calendar"></i>
                    <h5>Date Posted:</h5>
                    <span>{{ $job->created_at?->diffForHumans() }}</span>
                  </li>
                  <li>
                    <i class="icon icon-expiry"></i>
                    <h5>Expiration date:</h5>
                    <span>{{ $job->formatted_deadline }}</span>
                  </li>
                  <li>
                    <i class="icon icon-location"></i>
                    <h5>Location:</h5>
                    <span>{{ $job->office_location ?? 'N/A' }}</span>
                  </li>
                  <li>
                    <i class="icon icon-user-2"></i>
                    <h5>Job Title:</h5>
                    <span>{{ $job->title }}</span>
                  </li>
                  @if(!empty($job->salary_range))
                  <li>
                    <i class="icon icon-salary"></i>
                    <h5>Salary:</h5>
                    <span>{{ $job->salary_range }}</span>
                  </li>
                  @endif
                </ul>
              </div>

           
              <div class="job-detail">

                <h4>Job Description</h4>
                <p>{!! nl2br(e($job->description)) !!}</p>

                @if(!empty($job->key_responsibilities))
                <h4>Key Responsibilities</h4>
                @php
                  $responsibilities = preg_split('/\r\n|\r|\n/', (string) $job->key_responsibilities);
                @endphp
                <ul class="list-style-three">
                  @foreach($responsibilities as $item)
                    @php $item = trim($item); @endphp
                    @if($item !== '')
                    <li>{{ $item }}</li>
                    @endif
                  @endforeach
                </ul>
                @endif

                @if(!empty($job->skills_experience))
                <h4>Skill & Experience</h4>
                @php
                  $skills = preg_split('/\r\n|\r|\n/', (string) $job->skills_experience);
                @endphp
                <ul class="list-style-three">
                  @foreach($skills as $skill)
                    @php $skill = trim($skill); @endphp
                    @if($skill !== '')
                    <li>{{ $skill }}</li>
                    @endif
                  @endforeach
                </ul>
                @endif
              </div>

              <!-- Other Options -->
              <div class="other-options">
                <div class="social-share">
                  <h5>Share this job</h5>
                  <a href="#" class="facebook"><i class="fab fa-facebook-f"></i> Facebook</a>
                  <a href="#" class="twitter"><i class="fab fa-twitter"></i> Twitter</a>
                  <a href="#" class="google"><i class="fab fa-google"></i> Google+</a>
                </div>
              </div>
            </div>

            <div class="sidebar-column col-lg-4 col-md-12 col-sm-12">
              <aside class="sidebar">
                <div class="btn-box">
                  @auth
                    @if($hasApplied)
                      <span class="theme-btn btn-style-two" style="pointer-events:none;opacity:.8;">Applied</span>
                    @else
                      <a href="{{ route('candidate.apply', $job->id) }}" class="theme-btn btn-style-one">Apply For Job</a>
                    @endif
                  @else
                    <a href="{{ route('login') }}" class="theme-btn btn-style-one">Login to Apply</a>
                  @endauth
                  <button class="bookmark-btn"><i class="flaticon-bookmark"></i></button>
                </div>

                <div class="sidebar-widget company-widget">
                  <div class="widget-content">
                    <div class="company-title">
                      <div class="company-logo"><img src="{{ optional($job->company)->logo_url ?? (optional(\App\Models\Company::first())->logo_url ?? asset('assets/images/resource/company-7.png')) }}" alt="" style="width:120px;height:120px;object-fit:contain;border-radius:6px;background:transparent;display:block;"></div>
                      <h5 class="company-name">{{ optional($job->company)->name ?? ($siteCompany->name ?? 'Company') }}</h5>
                      <a href="#" class="profile-link">View company profile</a>
                    </div>

                    <ul class="company-info">
                      @if(!empty($job->industry))
                      <li>Primary industry: <span>{{ $job->industry }}</span></li>
                      @endif
                      @if(!empty(optional($job->company)->team_size))
                      <li>Company size: <span>{{ optional($job->company)->formatted_team_size }}</span></li>
                      @endif
                      @if(!empty(optional($job->company)->established_since))
                      <li>Founded in: <span>{{ optional($job->company)->formatted_established }}</span></li>
                      @endif
                      <li>Phone: <span>{{ optional($job->company)->phone ?? ($siteCompany->phone ?? 'N/A') }}</span></li>
                      <li>Email: <span>{{ $job->company_email ?? optional($job->company)->email ?? ($siteCompany->email ?? 'N/A') }}</span></li>
                      <li>Location: <span>{{ optional($job->company)->city ?? ($siteCompany->city ?? 'N/A') }}, {{ optional($job->company)->country ?? ($siteCompany->country ?? '') }}</span></li>
                      <li>Social media:
                        <div class="social-links">
                          @if(!empty(optional($job->company)->facebook))<a href="{{ optional($job->company)->facebook }}"><i class="fab fa-facebook-f"></i></a>@endif
                          @if(!empty(optional($job->company)->twitter))<a href="{{ optional($job->company)->twitter }}"><i class="fab fa-twitter"></i></a>@endif
                          @if(!empty(optional($job->company)->instagram))<a href="{{ optional($job->company)->instagram }}"><i class="fab fa-instagram"></i></a>@endif
                          @if(!empty(optional($job->company)->linkedin))<a href="{{ optional($job->company)->linkedin }}"><i class="fab fa-linkedin-in"></i></a>@endif
                        </div>
                      </li>
                    </ul>

                    @if(!empty(optional($job->company)->website))
                    <div class="btn-box"><a href="{{ optional($job->company)->website }}" class="theme-btn btn-style-three">{{ optional($job->company)->website }}</a></div>
                    @endif
                  </div>
                </div>

                <div class="sidebar-widget contact-widget">
                  <h4 class="widget-title">Contact Us</h4>
                  <div class="widget-content">
                    <!-- Comment Form -->
                    <div class="default-form">
                      <!--Comment Form-->
                      <form>
                        <div class="row clearfix">
                          <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <input type="text" name="username" placeholder="Your Name" required>
                          </div>
                          <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <input type="email" name="email" placeholder="Email Address" required>
                          </div>
                          <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <textarea class="darma" name="message" placeholder="Message"></textarea>
                          </div>
                          <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <button class="theme-btn btn-style-one" type="submit" name="submit-form">Send Message</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </aside>
            </div>
          </div>

          <!-- Related Jobs -->
          <div class="related-jobs">
            <div class="title-box">
              <h3>Related Jobs</h3>
              <div class="text">You may also be interested in</div>
            </div>
            @php
              $relatedJobs = \App\Models\Job::where('is_active', true)
                ->where('id', '!=', $job->id)
                ->latest()
                ->take(4)
                ->get();
            @endphp
            <div class="row">
              @foreach($relatedJobs as $rel)
              <div class="job-block-four col-xl-3 col-lg-4 col-md-6 col-sm-12">
                <div class="inner-box">
                  <ul class="job-other-info">
                    @if(!empty($rel->job_type))<li class="time">{{ $rel->job_type }}</li>@endif
                  </ul>
                  <span class="company-logo"><img src="{{ optional($rel->company)->logo_url ?? asset('assets/images/resource/company-logo/3-1.png') }}" alt=""></span>
                  <span class="company-name">{{ optional($rel->company)->name ?? ($siteCompany->name ?? 'Company') }}</span>
                  <h4><a href="{{ route('job.detail', $rel->id) }}">{{ $rel->title }}</a></h4>
                  <div class="location"><span class="icon flaticon-map-locator"></span> {{ $rel->office_location ?? 'Location' }}</div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Job Detail Section -->

@endsection