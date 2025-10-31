@extends('master')

@section('title','Jobs')

@section('content')
  <!--Page Title-->
  <section class="page-title style-two">
      <div class="auto-container">
        <div class="title-outer">
                <h1>Find Jobs</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Jobs</li>
                </ul> 
            </div>

     
      </div>
    </section>
    <!--End Page Title-->

    <!-- Listing Section -->
    <section class="ls-section">
      <div class="auto-container">
        <div class="filters-backdrop"></div>

           <!-- Job Search Form -->
           <div class="job-search-form">
          <form method="post" action="job-list-v10.html">
            <div class="row">
              <!-- Form Group -->
              <div class="form-group col-lg-4 col-md-12 col-sm-12">
                <span class="icon flaticon-search-1"></span>
                <input type="text" name="field_name" placeholder="Job title, keywords, or company">
              </div>

              <!-- Form Group -->
              <div class="form-group col-lg-3 col-md-12 col-sm-12 location">
                <span class="icon flaticon-map-locator"></span>
                <input type="text" name="field_name" placeholder="City or postcode">
              </div>

              <!-- Form Group -->
              <div class="form-group col-lg-3 col-md-12 col-sm-12 location">
                <span class="icon flaticon-briefcase"></span>
                <select class="chosen-select">
                  <option value="">All Categories</option>
                  <option value="44">Accounting / Finance</option>
                  <option value="106">Automotive Jobs</option>
                  <option value="46">Customer</option>
                  <option value="48">Design</option>
                  <option value="47">Development</option>
                  <option value="45">Health and Care</option>
                  <option value="105">Marketing</option>
                  <option value="107">Project Management</option>
                </select>
              </div>

              <!-- Form Group -->
              <div class="form-group col-lg-2 col-md-12 col-sm-12 text-right">
                <button type="submit" class="theme-btn btn-style-one">Find Jobs</button>
              </div>
            </div>
          </form>
        </div>
        <!-- Job Search Form -->

        <div class="row">

          <!-- Filters Column -->
          <div class="filters-column col-lg-4 col-md-12 col-sm-12">
            <div class="inner-column">
              <div class="filters-outer">
                <button type="button" class="theme-btn close-filters">X</button>

                <!-- Switchbox Outer -->
                <div class="switchbox-outer">
                  <h4>Job type</h4>
                  <ul class="switchbox">
                    <li>
                      <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider round"></span>
                        <span class="title">Freelance</span>
                      </label>
                    </li>
                    <li>
                      <label class="switch">
                        <input type="checkbox">
                        <span class="slider round"></span>
                        <span class="title">Full Time</span>
                      </label>
                    </li>
                    <li>
                      <label class="switch">
                        <input type="checkbox">
                        <span class="slider round"></span>
                        <span class="title">Internship</span>
                      </label>
                    </li>
                    <li>
                      <label class="switch">
                        <input type="checkbox">
                        <span class="slider round"></span>
                        <span class="title">Part Time</span>
                      </label>
                    </li>
                    <li>
                      <label class="switch">
                        <input type="checkbox">
                        <span class="slider round"></span>
                        <span class="title">Temporary</span>
                      </label>
                    </li>
                  </ul>
                </div>

                <!-- Checkboxes Ouer -->
                <div class="checkbox-outer">
                  <h4>Date Posted</h4>
                  <ul class="checkboxes">
                    <li>
                      <input id="check-f" type="checkbox" name="check">
                      <label for="check-f">All</label>
                    </li>
                    <li>
                      <input id="check-a" type="checkbox" name="check">
                      <label for="check-a">Last Hour</label>
                    </li>
                    <li>
                      <input id="check-b" type="checkbox" name="check">
                      <label for="check-b">Last 24 Hours</label>
                    </li>
                    <li>
                      <input id="check-c" type="checkbox" name="check">
                      <label for="check-c">Last 7 Days</label>
                    </li>
                    <li>
                      <input id="check-d" type="checkbox" name="check">
                      <label for="check-d">Last 14 Days</label>
                    </li>
                    <li>
                      <input id="check-e" type="checkbox" name="check">
                      <label for="check-e">Last 30 Days</label>
                    </li>
                  </ul>
                </div>

                <!-- Checkboxes Ouer -->
                <div class="checkbox-outer">
                  <h4>Experience Level</h4>
                  <ul class="checkboxes square">
                    <li>
                      <input id="check-ba" type="checkbox" name="check">
                      <label for="check-ba">All</label>
                    </li>
                    <li>
                      <input id="check-bb" type="checkbox" name="check">
                      <label for="check-bb">Internship</label>
                    </li>
                    <li>
                      <input id="check-bc" type="checkbox" name="check">
                      <label for="check-bc">Entry level</label>
                    </li>
                    <li>
                      <input id="check-bd" type="checkbox" name="check">
                      <label for="check-bd">Associate</label>
                    </li>
                    <li>
                      <input id="check-be" type="checkbox" name="check">
                      <label for="check-be">Mid-Senior level4</label>
                    </li>
                    <li>
                      <button class="view-more"><span class="icon flaticon-plus"></span> View More</button>
                    </li>
                  </ul>
                </div>

                <!-- Filter Block -->
                <div class="filter-block">
                  <h4>Salary</h4>

                  <div class="range-slider-one salary-range">
                    <div class="salary-range-slider"></div>
                    <div class="input-outer">
                      <div class="amount-outer">
                        <span class="amount salary-amount">
                          $<span class="min">0</span>
                          $<span class="max">0</span>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Filter Block -->
                <div class="filter-block">
                  <h4>Tags</h4>
                  <ul class="tags-style-one">
                    <li><a href="#">app</a></li>
                    <li><a href="#">administrative</a></li>
                    <li><a href="#">android</a></li>
                    <li><a href="#">wordpress</a></li>
                    <li><a href="#">design</a></li>
                    <li><a href="#">react</a></li>
                  </ul>
                </div>
              </div>

              <!-- Call To Action -->
              <div class="call-to-action-four">
                <h5>Recruiting?</h5>
                <p>Advertise your jobs to millions of monthly users and search 15.8 million CVs in our database.</p>
                <a href="#" class="theme-btn btn-style-one bg-blue"><span class="btn-title">Start Recruiting Now</span></a>
                <div class="image" style="background-image: url(images/resource/ads-bg-4.png);"></div>
              </div>
              <!-- End Call To Action -->
            </div>
          </div>

          <!-- Content Column -->
          <div class="content-column col-lg-8 col-md-12 col-sm-12">
            <div class="ls-outer">
              <button type="button" class="theme-btn btn-style-two toggle-filters">Show Filters</button>

              <!-- ls Switcher -->
              <div class="ls-switcher">
                <div class="showing-result">
                  <div class="text">
                    @if(isset($jobs) && ($jobs instanceof \Illuminate\Contracts\Pagination\Paginator || $jobs instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator))
                      Showing <strong>{{ $jobs->firstItem() }}</strong>-<strong>{{ $jobs->lastItem() }}</strong> of <strong>{{ $jobs->total() }}</strong> jobs
                    @elseif(isset($jobs) && is_countable($jobs))
                      Showing <strong>1</strong>-<strong>{{ count($jobs) }}</strong> of <strong>{{ count($jobs) }}</strong> jobs
                    @else
                      Showing jobs
                    @endif
                  </div>
                </div>
                <div class="sort-by">
                  <select class="chosen-select">
                    <option>New Jobs</option>
                    <option>Freelance</option>
                    <option>Full Time</option>
                    <option>Internship</option>
                    <option>Part Time</option>
                    <option>Temporary</option>
                  </select>

                  <select class="chosen-select">
                    <option>Show 10</option>
                    <option>Show 20</option>
                    <option>Show 30</option>
                    <option>Show 40</option>
                    <option>Show 50</option>
                    <option>Show 60</option>
                  </select>
                </div>
              </div>


              @php
                if (!isset($jobs)) {
                  try {
                    $query = \App\Models\Job::query()->where('is_active', true);

                    $categoryFilter = request('category');
                    if (!empty($categoryFilter)) {
                      // Try resolve category by slug or name
                      $categoryModel = \App\Models\Category::where('slug', $categoryFilter)
                        ->orWhere('name', $categoryFilter)
                        ->first();

                      $query->where(function ($q) use ($categoryModel, $categoryFilter) {
                        // 1) Pivot relation when available
                        if ($categoryModel) {
                          $q->whereHas('jobCategories', function ($qq) use ($categoryModel) {
                            $qq->where('job_categories.id', $categoryModel->id);
                          });
                        }

                        // 2) JSON categories fallback with common casing variants
                        $candidates = [];
                        if ($categoryModel) {
                          $name = (string) $categoryModel->name;
                          $slug = (string) $categoryModel->slug;
                          $candidates = [
                            $name,
                            $slug,
                            strtolower($name),
                            strtoupper($name),
                            ucwords(strtolower($name)),
                            str_replace(['-', '_'], ' ', $slug),
                          ];
                        } else {
                          $val = (string) $categoryFilter;
                          $candidates = [
                            $val,
                            strtolower($val),
                            strtoupper($val),
                            ucwords(strtolower($val)),
                            str_replace(['-', '_'], ' ', $val),
                          ];
                        }

                        foreach (array_unique($candidates) as $cand) {
                          if ($cand !== '') {
                            $q->orWhereJsonContains('categories', $cand);
                          }
                        }
                      });
                    }

                    $jobs = $query->latest()->paginate(5)->withQueryString();
                  } catch (\Throwable $e) {
                    $jobs = collect();
                  }
                }
                $siteCompany = \App\Models\Company::first();
              @endphp

              @forelse($jobs as $job)
              <div class="job-block">
                <div class="inner-box">
                  <div class="content">
                    <span class="company-logo"><img src="{{ optional($job->company)->logo_url ?? asset('assets/images/resource/company-logo/1-1.png') }}" alt=""></span>
                    <h4><a href="{{ route('job.detail', $job->id) }}">{{ $job->title }}</a></h4>
                    <ul class="job-info">
                      <li><span class="icon flaticon-briefcase"></span> {{ optional($job->company)->name ?? ($siteCompany->name ?? 'Company') }}</li>
                      <li><span class="icon flaticon-map-locator"></span> {{ $job->office_location ?? 'Location' }}</li>
                      <li><span class="icon flaticon-clock-3"></span> {{ $job->created_at?->diffForHumans() }}</li>
                      @if(!empty($job->salary_range))
                      <li><span class="icon flaticon-money"></span> {{ $job->salary_range }}</li>
                      @endif
                    </ul>
                    <ul class="job-other-info">
                      <li class="time">{{ $job->job_type ?? 'Full Time' }}</li>
                      @if(!empty($job->work_location))
                      <li class="privacy">{{ $job->work_location }}</li>
                      @endif
                    </ul>
                    <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                  </div>
                </div>
              </div>
              @empty
              <div class="text-center py-4">
                <p>No jobs found.</p>
              </div>
              @endforelse

              @if($jobs instanceof \Illuminate\Contracts\Pagination\Paginator || $jobs instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
                <nav class="ls-pagination">
                  <ul>
                    <li class="prev {{ $jobs->onFirstPage() ? 'disabled' : '' }}">
                      <a href="{{ $jobs->previousPageUrl() ?: '#' }}"><i class="fa fa-arrow-left"></i></a>
                    </li>
                    @for ($page = 1; $page <= $jobs->lastPage(); $page++)
                      <li>
                        <a href="{{ $jobs->url($page) }}" class="{{ $page === $jobs->currentPage() ? 'current-page' : '' }}">{{ $page }}</a>
                      </li>
                    @endfor
                    <li class="next {{ $jobs->hasMorePages() ? '' : 'disabled' }}">
                      <a href="{{ $jobs->nextPageUrl() ?: '#' }}"><i class="fa fa-arrow-right"></i></a>
                    </li>
                  </ul>
                </nav>
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--End Listing Page Section -->
@endsection