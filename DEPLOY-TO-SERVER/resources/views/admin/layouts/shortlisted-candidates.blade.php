@extends('admin.layouts.layout')

@section('content')

    <!-- Dashboard -->
    <section class="user-dashboard">
      <div class="dashboard-outer">
        <div class="upper-title-box">
          <h3>Shortlisted Candidates</h3>
          <div class="text">Candidates you have shortlisted</div>
        </div>

        <div class="row">

          <div class="col-lg-12">
            <!-- applicants Widget -->
            <div class="applicants-widget ls-widget">
              <div class="widget-title">
                <h4>Shortlist</h4>
 
                <div class="chosen-outer">
                  <!--search box-->
                  <div class="search-box-one">
                    <form method="get" action="#">
                      <div class="form-group">
                        <span class="icon flaticon-search-1"></span>
                        <input type="search" name="search" value="" placeholder="Search">
                      </div>
                    </form>
                  </div>

                  <!--Tabs Box-->
                  <select class="chosen-select">
                    <option>Newest</option>
                    <option>Oldest</option>
                  </select>
                </div>
              </div>
              <div class="widget-content">
                @forelse($applications as $applicant)
                  <div class="candidate-block-three">
                    <div class="inner-box">
                      <div class="content">
                        <figure class="image"><img src="{{ $applicant->avatar_url ?? asset('assets/images/resource/candidate-1.png') }}" alt="{{ $applicant->name }}" style="width:60px;height:60px;object-fit:cover;border-radius:50%;display:block;"></figure>
                        <h4 class="name"><a href="#">{{ $applicant->name }}</a></h4>
                        <ul class="candidate-info">
                          <li class="designation">{{ $applicant->position ?? 'Applicant' }}</li>
                          @if(!empty($applicant->location))<li><span class="icon flaticon-map-locator"></span> {{ $applicant->location }}</li>@endif
                          @if(!empty($applicant->job_title))<li><span class="icon la la-briefcase"></span> {{ $applicant->job_title }}</li>@endif
                          @if(!empty($applicant->email))<li><span class="icon la la-envelope"></span> {{ $applicant->email }}</li>@endif
                          @if(!empty($applicant->phone))<li><span class="icon la la-phone"></span> {{ $applicant->phone }}</li>@endif
                          <li><span class="icon la la-clock"></span> Shortlisted: {{ $applicant->applied_at ?? '' }}</li>
                        </ul>
                        @if(!empty($applicant->skills))
                          <ul class="post-tags">
                            @foreach(($applicant->skills ?? []) as $skill)
                              <li><a href="#">{{ $skill }}</a></li>
                            @endforeach
                          </ul>
                        @endif
                      </div>
                      <div class="option-box">
                        <div class="resume-action" style="display:flex;flex-wrap:wrap;gap:8px;align-items:center;">
                          <a href="{{ $applicant->cv_url ?? '#' }}" class="theme-btn btn-style-three" target="_blank" style="margin:0;white-space:nowrap;"><span class="la la-download"></span> Download CV</a>
                          <form method="POST" action="{{ route('admin.application.status', ['job' => $applicant->job_id, 'application' => $applicant->application_id]) }}">
                            @csrf
                            <input type="hidden" name="status" value="rejected" />
                            <button type="submit" class="theme-btn btn-style-four" style="margin:0;white-space:nowrap;"><span class="la la-times-circle"></span> Reject</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                @empty
                  <div class="text-center" style="padding: 40px 0;">
                    <h4>No shortlisted candidates yet</h4>
                    <a href="{{ route('admin.all-applicants') }}" class="theme-btn btn-style-two"><i class="la la-arrow-left"></i> View All Applicants</a>
                  </div>
                @endforelse

                @if($applications instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
                  <nav class="ls-pagination mb-5">
                    <div class="pagination-links">
                      {{ $applications->links('pagination::bootstrap-4') }}
                    </div>
                  </nav>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Dashboard -->

@endsection