@extends('master')


@section('content')

  <!-- Banner Section-->
  <section class="banner-section-five" style="background-image: url();">
      <div class="auto-container">
        <div class="row">
          <div class="content-column col-lg-7 col-md-12 col-sm-12">
            <div class="inner-column wow fadeInUp" data-wow-delay="500ms">
              <div class="title-box">
                <h3>There Are <span class="colored">93,178</span> Postings Here<br> For you!</h3>
                <div class="text">Find Jobs, Employment & Career Opportunities</div>
              </div>

              <!-- Job Search Form -->
              <div class="job-search-form wow fadeInUp" data-wow-delay="1000ms">
                <form method="post" action="job-list-v10.html">
                  <div class="row">
                    <div class="form-group col-lg-5 col-md-12 col-sm-12">
                      <span class="icon flaticon-search-1"></span>
                      <input type="text" name="field_name" placeholder="Job title, keywords, or company">
                    </div>
                    <!-- Form Group -->
                    <div class="form-group col-lg-4 col-md-12 col-sm-12 location">
                      <span class="icon flaticon-map-locator"></span>
                      <input type="text" name="field_name" placeholder="City or postcode">
                    </div>
                    <!-- Form Group -->
                    <div class="form-group col-lg-3 col-md-12 col-sm-12 btn-box">
                      <button type="submit" class="theme-btn btn-style-seven"><span class="btn-title">Find Jobs</span></button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- Job Search Form -->
            </div>
          </div>

          <div class="image-column col-lg-5 col-md-12">
            <div class="image-box">
              <div class="row">
                <div class="column col-lg-6 col-md-6 col-sm-12 wow fadeInLeft" data-wow-delay="1500ms">
                  <figure class="image anm" data-speed-x="2"><img src="{{ asset('assets/images/resource/banner-img-4.png') }}" alt=""></figure>
                </div>
                <div class="column col-lg-6 col-md-6 col-sm-12 wow fadeInRight" data-wow-delay="2000ms">
                  <figure class="image anm" data-speed-x="2"><img src="{{ asset('assets/images/resource/banner-img-5.png') }}" alt=""></figure>
                  <figure class="image anm" data-speed-x="2"><img src="{{ asset('assets/images/resource/banner-img-6.png') }}" alt=""></figure>
                </div>
              </div>

              <!-- Info BLock One -->
              <div class="info_block wow fadeIn anm" data-wow-delay="2500ms" data-speed-x="2" data-speed-y="2">
                <span class="icon flaticon-email-3"></span>
                <p>Work Inquiry From <br>Ali Tufan</p>
              </div>

              <!-- Info BLock Two -->
              <div class="info_block_two wow fadeIn anm" data-wow-delay="3000ms" data-speed-x="3" data-speed-y="3">
                <p>10k+ Candidates</p>
                <div class="image"><img src="{{ asset('assets/images/resource/multi-peoples.png') }}" alt=""></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Banner Section-->

    <!-- Job Section -->
    <section class="job-section-four">
      <div class="auto-container">
        <div class="sec-title text-center">
          <h2>Featured Jobs</h2>
          <div class="text">Know your worth and find the job that qualify your life</div>
        </div>

        @php
          if (!isset($featuredJobs)) {
            try {
              $featuredJobs = \App\Models\Job::where('is_featured', true)
                ->where('is_active', true)
                ->latest()
                ->take(6)
                ->get();
            } catch (\Throwable $e) {
              $featuredJobs = collect();
            }
          }
          $siteCompany = \App\Models\Company::first();
        @endphp

        <div class="row">
          @forelse(($featuredJobs ?? collect()) as $job)
          <div class="job-block-four col-lg-4 col-md-6 col-sm-12">
            <div class="inner-box">
              <ul class="job-other-info">
                <li class="time">{{ $job->job_type ?? 'Full Time' }}</li>
                @if(!empty($job->work_location))
                <li class="privacy">{{ $job->work_location }}</li>
                @endif
              </ul>
              <span class="company-logo"><img src="{{ asset('assets/images/resource/company-logo/3-1.png') }}" alt=""></span>
              <span class="company-name">{{ optional($job->company)->name ?? ($siteCompany->name ?? 'Company') }}</span>
              <h4><a href="{{ route('job.detail', $job->id) }}">{{ $job->title }}</a></h4>
              <div class="location"><span class="icon flaticon-map-locator"></span> {{ $job->office_location ?? $job->city ?? 'Location' }}</div>
            </div>
          </div>
          @empty
          <div class="col-12 text-center">
            <p>No featured jobs available at the moment.</p>
            <a href="{{ route('jobs') }}" class="theme-btn btn-style-seven">View All Jobs</a>
          </div>
          @endforelse
        </div>

        <div class="btn-box">
          <a href="{{ route('jobs') }}" class="theme-btn btn-style-seven">View All Jobs</a>
        </div>
      </div>
    </section>
    <!-- End Job Section -->

    <!-- Job Categories -->
    <section class="job-categories style-two">
      <div class="auto-container">
        <div class="sec-title text-center">
          <h2>Popular Job Categories</h2>
          <div class="text">2020 jobs live - 293 added today.</div>
        </div>

        @php
          if (!isset($popularCategories)) {
            try {
              $popularCategories = \App\Models\Category::active()
                ->withCount(['jobs' => function ($q) { $q->where('is_active', true); }])
                ->ordered()
                ->take(9)
                ->get();
            } catch (\Throwable $e) {
              $popularCategories = collect();
            }
          }
        @endphp

        <div class="row wow fadeInUp">
          @forelse(($popularCategories ?? collect()) as $category)
          <div class="category-block col-lg-4 col-md-6 col-sm-12">
            <div class="inner-box">
              <div class="content">
                <span class="icon {{ $category->icon }}"></span>
                <h4><a href="{{ route('category.jobs', $category->slug) }}">{{ $category->name }}</a></h4>
                @php
                  // Prefer eager-loaded count from pivot relationship
                  $openCount = isset($category->jobs_count)
                    ? (int) $category->jobs_count
                    : (int) $category->jobs()->where('is_active', true)->count();

                  // Fallback: count jobs by JSON categories when pivot isn't populated
                  if ($openCount === 0) {
                    try {
                      $jsonCount = \App\Models\Job::where('is_active', true)
                        ->where(function ($q) use ($category) {
                          $q->whereJsonContains('categories', $category->name);
                          if (!empty($category->slug)) {
                            $q->orWhereJsonContains('categories', $category->slug);
                          }
                        })
                        ->count();
                      $openCount = (int) $jsonCount;
                    } catch (\Throwable $e) {
                      // ignore JSON errors, keep $openCount as-is
                    }
                  }
                @endphp
                <p>({{ $openCount }} open {{ $openCount === 1 ? 'position' : 'positions' }})</p>
              </div>
            </div>
          </div>
          @empty
          <div class="col-12 text-center">
            <p>No categories available.</p>
          </div>
          @endforelse
        </div>
      </div>
    </section>
    <!-- End Job Categories -->

    <!-- About Section -->
    <section class="about-section-two style-two">
      <div class="auto-container">
        <div class="row ">
          <!-- Content Column -->
          <div class="content-column col-lg-6 col-md-12 col-sm-12 order-2">
            <div class="inner-column wow fadeInLeft">
              <div class="sec-title">
                <h2>Get applications from the <br>world best talents.</h2>
                <div class="text">Search all the open positions on the web. Get your own personalized salary estimate. Read reviews on over 600,000 companies worldwide.</div>
              </div>
              <ul class="list-style-one">
                <li>Bring to the table win-win survival</li>
                <li>Capitalize on low hanging fruit to identify</li>
                <li>But I must explain to you how all this</li>
              </ul>
              <a href="#" class="theme-btn btn-style-seven">Post a Job</a>
            </div>
          </div>

          <!-- Image Column -->
          <div class="image-column col-lg-6 col-md-12 col-sm-12 wow fadeInRight">
            <figure class="image-box"><img src="{{ asset('assets/images/resource/image-4.png') }}" alt=""></figure>

            <!-- Count Employers -->
            <div class="applicants-list">
              <div class="title-box">
                <h4>Applicants List</h4>
              </div>
              <ul class="applicants">
                <li class="applicant">
                  <figure class="image"><img src="{{ asset('assets/images/resource/applicant-1.png') }}" alt=""></figure>
                  <h4 class="name">Brooklyn Simmons</h4>
                  <span class="designation">Web Developer</span>
                </li>

                <li class="applicant">
                  <figure class="image"><img src="{{ asset('assets/images/resource/applicant-2.png') }}" alt=""></figure>
                  <h4 class="name">Courtney Henry</h4>
                  <span class="designation">Web Developer</span>
                </li>

                <li class="applicant">
                  <figure class="image"><img src="{{ asset('assets/images/resource/applicant-3.png') }}" alt=""></figure>
                  <h4 class="name">Marvin McKinney</h4>
                  <span class="designation">Web Developer</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End About Section -->

    <!-- News Section Two -->
    <section class="news-section-two style-two">
      <div class="auto-container">
        <div class="sec-title text-center">
          <h2>Recent News Articles</h2>
          <div class="text">Fresh job related news content posted each day.</div>
        </div>

        <div class="row wow fadeInUp">
          <!-- News Block -->
          <div class="news-block col-lg-4 col-md-6 col-sm-12">
            <div class="inner-box">
              <div class="image-box">
                <figure class="image"><img src="{{ asset('assets/images/resource/news-1.jpg') }}" alt="" /></figure>
              </div>
              <div class="lower-content">
                <ul class="post-meta">
                  <li><a href="#">August 31, 2021</a></li>
                  <li><a href="#">12 Comment</a></li>
                </ul>
                <h3><a href="blog-single.html">Attract Sales And Profits</a></h3>
              </div>
            </div>
          </div>

          <!-- News Block -->
          <div class="news-block col-lg-4 col-md-6 col-sm-12">
            <div class="inner-box">
              <div class="image-box">
                <figure class="image"><img src="{{ asset('assets/images/resource/news-2.jpg') }}" alt="" /></figure>
              </div>
              <div class="lower-content">
                <ul class="post-meta">
                  <li><a href="#">August 31, 2021</a></li>
                  <li><a href="#">12 Comment</a></li>
                </ul>
                <h3><a href="blog-single.html">5 Tips For Your Job Interviews</a></h3>
              </div>
            </div>
          </div>

          <!-- News Block -->
          <div class="news-block col-lg-4 col-md-6 col-sm-12">
            <div class="inner-box">
              <div class="image-box">
                <figure class="image"><img src="{{ asset('assets/images/resource/news-3.jpg') }}" alt="" /></figure>
              </div>
              <div class="lower-content">
                <ul class="post-meta">
                  <li><a href="#">August 31, 2021</a></li>
                  <li><a href="#">12 Comment</a></li>
                </ul>
                <h3><a href="blog-single.html">An Overworked Newspaper Editor</a></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End News Section -->

    <!-- Testimonial Section Three -->
    <section class="testimonial-section-three">
      <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title text-center">
          <h2>Testimonials From Our Customers</h2>
          <div class="text">Lorem ipsum dolor sit amet elit, sed do eiusmod tempor</div>
        </div>

        <div class="carousel-outer wow fadeInUp">
          <!-- Testimonial Carousel -->
          <div class="testimonial-carousel-two owl-carousel owl-theme">
            <!-- Slide Item -->
            <div class="slide-item">
              <div class="image-column">
                <figure class="image"><img src="{{ asset('assets/images/resource/testimonial-image.jpg') }}" alt=""></figure>
              </div>
              <div class="content-column">
                <!--Testimonial Block -->
                <div class="testimonial-block-three">
                  <div class="inner-box">
                    <h4 class="title">Great quality!</h4>
                    <div class="text">Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything! Can’t quite… The Mitech team works really hard to ensure high level of quality</div>
                    <div class="info-box">
                      <h4 class="name">Gabriel Nolan</h4>
                      <span class="designation">Consultant</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Slide Item -->
            <div class="slide-item">
              <div class="image-column">
                <figure class="image"><img src="{{ asset('assets/images/resource/testimonial-image.jpg') }}" alt=""></figure>
              </div>
              <div class="content-column">
                <!--Testimonial Block -->
                <div class="testimonial-block-three">
                  <div class="inner-box">
                    <h4 class="title">Great quality!</h4>
                    <div class="text">Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything! Can’t quite… The Mitech team works really hard to ensure high level of quality</div>
                    <div class="info-box">
                      <h4 class="name">Gabriel Nolan</h4>
                      <span class="designation">Consultant</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Slide Item -->
            <div class="slide-item">
              <div class="image-column">
                <figure class="image"><img src="{{ asset('assets/images/resource/testimonial-image.jpg') }}" alt=""></figure>
              </div>
              <div class="content-column">
                <!--Testimonial Block -->
                <div class="testimonial-block-three">
                  <div class="inner-box">
                    <h4 class="title">Great quality!</h4>
                    <div class="text">Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything! Can’t quite… The Mitech team works really hard to ensure high level of quality</div>
                    <div class="info-box">
                      <h4 class="name">Gabriel Nolan</h4>
                      <span class="designation">Consultant</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Testimonial Section Three -->

    <!--Clients Section-->
    <section class="clients-section-two alternate">
      <div class="sponsors-outer wow fadeInUp">
        <!--Sponsors Carousel-->
        <ul class="sponsors-carousel owl-carousel owl-theme">
          <li class="slide-item">
            <figure class="image-box"><a href="#"><img src="{{ asset('assets/images/clients/1-1.png') }}" alt=""></a></figure>
          </li>
          <li class="slide-item">
            <figure class="image-box"><a href="#"><img src="{{ asset('assets/images/clients/1-2.png') }}" alt=""></a></figure>
          </li>
          <li class="slide-item">
            <figure class="image-box"><a href="#"><img src="{{ asset('assets/images/clients/1-3.png') }}" alt=""></a></figure>
          </li>
          <li class="slide-item">
            <figure class="image-box"><a href="#"><img src="{{ asset('assets/images/clients/1-4.png') }}" alt=""></a></figure>
          </li>
          <li class="slide-item">
            <figure class="image-box"><a href="#"><img src="{{ asset('assets/images/clients/1-5.png') }}" alt=""></a></figure>
          </li>
          <li class="slide-item">
            <figure class="image-box"><a href="#"><img src="{{ asset('assets/images/clients/1-6.png') }}" alt=""></a></figure>
          </li>
          <li class="slide-item">
            <figure class="image-box"><a href="#"><img src="{{ asset('assets/images/clients/1-7.png') }}" alt=""></a></figure>
          </li>
        </ul>
      </div>
    </section>
    <!-- End Clients Section-->

    <!-- Top Companies -->
    <section class="top-companies">
      <div class="auto-container">
        <div class="sec-title">
          <h2>Top Company Registered</h2>
          <div class="text">Some of the companies we've helped recruit excellent applicants over the years.</div>
        </div>

        <div class="carousel-outer wow fadeInUp">

          <div class="companies-carousel owl-carousel owl-theme default-dots">
            <!-- Company Block -->
            <div class="company-block">
              <div class="inner-box">
                <figure class="image"><img src="{{ asset('assets/images/resource/company-1.png') }}" alt=""></figure>
                <h4 class="name">Udemy</h4>
                <div class="location"><i class="flaticon-map-locator"></i> London, UK</div>
                <a href="#" class="theme-btn btn-style-four">15 Open Position</a>
              </div>
            </div>

            <!-- Company Block -->
            <div class="company-block">
              <div class="inner-box">
                <figure class="image"><img src="{{ asset('assets/images/resource/company-2.png') }}" alt=""></figure>
                <h4 class="name">Stripe</h4>
                <div class="location"><i class="flaticon-map-locator"></i> London, UK</div>
                <a href="#" class="theme-btn btn-style-four">22 Open Position</a>
              </div>
            </div>

            <!-- Company Block -->
            <div class="company-block">
              <div class="inner-box">
                <figure class="image"><img src="{{ asset('assets/images/resource/company-3.png') }}" alt=""></figure>
                <h4 class="name">Dropbox</h4>
                <div class="location"><i class="flaticon-map-locator"></i> London, UK</div>
                <a href="#" class="theme-btn btn-style-four">22 Open Position</a>
              </div>
            </div>

            <!-- Company Block -->
            <div class="company-block">
              <div class="inner-box">
                <figure class="image"><img src="{{ asset('assets/images/resource/company-4.png') }}" alt=""></figure>
                <h4 class="name">Figma</h4>
                <div class="location"><i class="flaticon-map-locator"></i> London, UK</div>
                <a href="#" class="theme-btn btn-style-four">22 Open Position</a>
              </div>
            </div>

            <!-- Company Block -->
            <div class="company-block">
              <div class="inner-box">
                <figure class="image"><img src="{{ asset('assets/images/resource/company-1.png') }}" alt=""></figure>
                <h4 class="name">Udemy</h4>
                <div class="location"><i class="flaticon-map-locator"></i> London, UK</div>
                <a href="#" class="theme-btn btn-style-four">15 Open Position</a>
              </div>
            </div>

            <!-- Company Block -->
            <div class="company-block">
              <div class="inner-box">
                <figure class="image"><img src="{{ asset('assets/images/resource/company-2.png') }}" alt=""></figure>
                <h4 class="name">Stripe</h4>
                <div class="location"><i class="flaticon-map-locator"></i> London, UK</div>
                <a href="#" class="theme-btn btn-style-four">22 Open Position</a>
              </div>
            </div>

            <!-- Company Block -->
            <div class="company-block">
              <div class="inner-box">
                <figure class="image"><img src="{{ asset('assets/images/resource/company-3.png') }}" alt=""></figure>
                <h4 class="name">Dropbox</h4>
                <div class="location"><i class="flaticon-map-locator"></i> London, UK</div>
                <a href="#" class="theme-btn btn-style-four">22 Open Position</a>
              </div>
            </div>

            <!-- Company Block -->
            <div class="company-block">
              <div class="inner-box">
                <figure class="image"><img src="{{ asset('assets/images/resource/company-4.png') }}" alt=""></figure>
                <h4 class="name">Figma</h4>
                <div class="location"><i class="flaticon-map-locator"></i> London, UK</div>
                <a href="#" class="theme-btn btn-style-four">22 Open Position</a>
              </div>
            </div>

            <!-- Company Block -->
            <div class="company-block">
              <div class="inner-box">
                <figure class="image"><img src="{{ asset('assets/images/resource/company-1.png') }}" alt=""></figure>
                <h4 class="name">Udemy</h4>
                <div class="location"><i class="flaticon-map-locator"></i> London, UK</div>
                <a href="#" class="theme-btn btn-style-four">15 Open Position</a>
              </div>
            </div>

            <!-- Company Block -->
            <div class="company-block">
              <div class="inner-box">
                <figure class="image"><img src="{{ asset('assets/images/resource/company-2.png') }}" alt=""></figure>
                <h4 class="name">Stripe</h4>
                <div class="location"><i class="flaticon-map-locator"></i> London, UK</div>
                <a href="#" class="theme-btn btn-style-four">22 Open Position</a>
              </div>
            </div>

            <!-- Company Block -->
            <div class="company-block">
              <div class="inner-box">
                <figure class="image"><img src="{{ asset('assets/images/resource/company-3.png') }}" alt=""></figure>
                <h4 class="name">Dropbox</h4>
                <div class="location"><i class="flaticon-map-locator"></i> London, UK</div>
                <a href="#" class="theme-btn btn-style-four">22 Open Position</a>
              </div>
            </div>

            <!-- Company Block -->
            <div class="company-block">
              <div class="inner-box">
                <figure class="image"><img src="{{ asset('assets/images/resource/company-4.png') }}" alt=""></figure>
                <h4 class="name">Figma</h4>
                <div class="location"><i class="flaticon-map-locator"></i> London, UK</div>
                <a href="#" class="theme-btn btn-style-four">22 Open Position</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Top Companies -->

    <!-- Subscribe Section -->
    <section class="subscribe-section">
      <div class="auto-container">
        <div class="outer-box wow fadeInUp">
          <div class="sec-title">
            <h2>Subscribe Our Newsletter</h2>
            <div class="text">Advertise your jobs to millions of monthly users and search 15.8 million<br> CVs in our database.</div>
          </div>

          <div class="form-column">
            <div class="subscribe-form">
              <form method="post" action="#">
                <div class="form-group">
                  <div class="response"></div>
                </div>
                <div class="form-group">
                  <input type="email" name="email" class="email" value="" placeholder="Your e-mail" required>
                  <button type="button" id="subscribe-newslatters" class="theme-btn btn-style-seven">Subscribe</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Subscribe Section -->


@endsection