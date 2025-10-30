@extends('master')

@section('title', $category->name . ' Jobs')

@section('content')
  <!--Page Title-->
  <section class="page-title style-two">
    <div class="auto-container">
      <div class="title-outer">
        <h1>{{ $category->name }} Jobs</h1>
        <ul class="page-breadcrumb">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="{{ route('jobs') }}">Jobs</a></li>
          <li>{{ $category->name }}</li>
        </ul>
      </div>
    </div>
  </section>
  <!--End Page Title-->

  <!-- Listing Section -->
  <section class="ls-section">
    <div class="auto-container">
      <div class="filters-backdrop"></div>

      <div class="row">
        <!-- Content Column -->
        <div class="content-column col-lg-12 col-md-12 col-sm-12">
          <div class="ls-outer">
            <div class="ls-switcher">
              <div class="showing-result">
                <div class="text">
                  @if($jobs instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
                    Showing <strong>{{ $jobs->firstItem() }}</strong>-<strong>{{ $jobs->lastItem() }}</strong> of <strong>{{ $jobs->total() }}</strong> jobs
                  @else
                    Showing jobs
                  @endif
                </div>
              </div>
            </div>

            @php $siteCompany = \App\Models\Company::first(); @endphp

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
              <p>No jobs found in {{ $category->name }}.</p>
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


