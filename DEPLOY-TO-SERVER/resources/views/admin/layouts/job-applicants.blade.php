@extends('admin.layouts.layout')

@section('content')

   <!-- Dashboard -->
   <section class="user-dashboard">
      <div class="dashboard-outer">
        <div class="upper-title-box">
          <h3>Applicants for: {{ $job->title }}</h3>
          <div class="text">Manage and review applications</div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="applicants-widget ls-widget">
              <div class="widget-title">
                <h4>Applicants</h4>
                <div class="chosen-outer">
                  <div class="search-box-one">
                    <form method="get" action="#">
                      <div class="form-group">
                        <span class="icon flaticon-search-1"></span>
                        <input type="search" name="search" value="" placeholder="Search applicants">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="widget-content">
                @if($applicants->count() === 0)
                  <div class="text-center" style="padding: 40px 0;">
                    <h4>No applicants yet</h4>
                    <p>Share the job to get more applications.</p>
                    <a href="{{ route('admin.manage-jobs') }}" class="theme-btn btn-style-two"><i class="la la-arrow-left"></i> Back to Jobs</a>
                  </div>
                @else
                  @foreach($applicants as $applicant)
                    <div class="candidate-block-three">
                      <div class="inner-box">
                        <div class="content">
                          <figure class="image"><img src="{{ $applicant->avatar_url ?? asset('assets/images/resource/candidate-1.png') }}" alt="{{ $applicant->name }}" style="width:60px;height:60px;object-fit:cover;border-radius:50%;display:block;"></figure>
                          <h4 class="name"><a href="#">{{ $applicant->name }}</a></h4>
                          <ul class="candidate-info">
                            <li class="designation">{{ $applicant->position ?? 'Applicant' }}</li>
                            <li><span class="icon flaticon-map-locator"></span> {{ $applicant->location ?? 'N/A' }}</li>
                            <li><span class="icon flaticon-money"></span> {{ $applicant->expected_salary ?? 'N/A' }}</li>
                            <li><span class="icon la la-envelope"></span> {{ $applicant->email ?? 'N/A' }}</li>
                            <li><span class="icon la la-phone"></span> {{ $applicant->phone ?? 'N/A' }}</li>
                            <li><span class="icon la la-clock"></span> Applied: {{ $applicant->applied_at ?? '' }}</li>
                          </ul>
                          <ul class="post-tags">
                            @foreach(($applicant->skills ?? []) as $skill)
                              <li><a href="#">{{ $skill }}</a></li>
                            @endforeach
                          </ul>
                          @if(!empty($applicant->cover_letter))
                          <div class="mt-2">
                            <strong>Cover Letter:</strong>
                            <p style="white-space:pre-line;">{{ $applicant->cover_letter }}</p>
                          </div>
                          @endif
                        </div>
                        <div class="option-box">
                          <div class="resume-action" style="display:flex;flex-wrap:wrap;gap:8px;align-items:center;">
                            <a href="{{ $applicant->cv_url ?? '#' }}" class="theme-btn btn-style-three" target="_blank" style="margin:0;white-space:nowrap;"><span class="la la-download"></span> Download CV</a>
                            @if(($applicant->status ?? '') === 'shortlisted')
                              <button type="button" class="theme-btn btn-style-two" style="margin:0;white-space:nowrap;opacity:.7;cursor:default;">
                                <span class="la la-check"></span> Shortlisted
                              </button>
                            @else
                              <form method="POST" action="{{ route('admin.application.status', ['job' => $job->id, 'application' => $applicant->application_id]) }}">
                                @csrf
                                <input type="hidden" name="status" value="shortlisted" />
                                <button type="submit" class="theme-btn btn-style-two" style="margin:0;white-space:nowrap;"><span class="la la-check"></span> Shortlist</button>
                              </form>
                            @endif
                            <form method="POST" action="{{ route('admin.application.status', ['job' => $job->id, 'application' => $applicant->application_id]) }}">
                              @csrf
                              <input type="hidden" name="status" value="rejected" />
                              <button type="submit" class="theme-btn btn-style-four" style="margin:0;white-space:nowrap;"><span class="la la-times-circle"></span> Reject</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Dashboard -->

@endsection