@extends('admin.layouts.layout')

@section('content')

    <!-- Dashboard -->
    <section class="user-dashboard">
      <div class="dashboard-outer">
        <div class="upper-title-box">
          <h3>All Applicants</h3>
          <div class="text">All applications for your posted jobs</div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <!-- Ls widget -->
            <div class="ls-widget">
              <div class="tabs-box">
                <div class="widget-title">
                  <h4>Applicant</h4>

                  <div class="chosen-outer">
                    <select class="chosen-select">
                      <option>Select Jobs</option>
                    </select>
                    <select class="chosen-select">
                      <option>All Status</option>
                    </select>
                  </div>
                </div>

                <div class="widget-content">
                  @php 
                    $collection = $applications instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator ? $applications->getCollection() : collect($applications);
                    $approved = $collection->where('status', 'shortlisted');
                    $rejected = $collection->where('status', 'rejected');
                  @endphp

                  <div class="aplicants-upper-bar" style="display:flex;align-items:center;justify-content:space-between;gap:16px;">
                    <h6>All Applicants</h6>
                    <ul class="aplicantion-status tab-buttons clearfix" style="list-style:none;margin:0;padding:0;display:flex;gap:10px;flex-wrap:wrap;">
                      <li class="tab-btn active-btn totals" style="padding:6px 10px;border-radius:16px;background:#1967d2;color:#fff;">Total(s): {{ $collection->count() }}</li>
                      <li class="tab-btn approved" style="padding:6px 10px;border-radius:16px;background:#d4edda;color:#155724;">Approved: {{ $approved->count() }}</li>
                      <li class="tab-btn rejected" style="padding:6px 10px;border-radius:16px;background:#f8d7da;color:#721c24;">Rejected(s): {{ $rejected->count() }}</li>
                    </ul>
                  </div>

                  <div class="row">
                    @forelse($collection as $applicant)
                      <div class="candidate-block-three col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-box" style="padding:16px 20px;border:1px solid #eee;border-radius:8px;margin-bottom:12px;background:#fff;">
                          <div class="content" style="display:flex;gap:16px;align-items:flex-start;flex-wrap:wrap;">
                            <figure class="image" style="margin:0;">
                              <img src="{{ $applicant->avatar_url ?? asset('assets/images/resource/candidate-1.png') }}" alt="{{ $applicant->name }}" style="width:56px;height:56px;object-fit:cover;border-radius:50%;display:block;">
                            </figure>
                            <div>
                              <h4 class="name" style="margin:0 0 4px 0;">{{ $applicant->name }}</h4>
                              <div class="text-muted" style="font-size:13px;">Applied {{ $applicant->applied_at ?? '' }} • {{ $applicant->status ?? 'pending' }}</div>
                              <ul class="candidate-info" style="margin:6px 0 0;padding:0;list-style:none;display:flex;gap:12px;flex-wrap:wrap;color:#666;">
                                @if(!empty($applicant->position))<li class="designation">{{ $applicant->position }}</li>@endif
                                @if(!empty($applicant->location))<li><span class="icon flaticon-map-locator"></span> {{ $applicant->location }}</li>@endif
                                @if(!empty($applicant->job_title))<li><span class="icon la la-briefcase"></span> {{ $applicant->job_title }}</li>@endif
                                @if(!empty($applicant->email))<li><span class="icon la la-envelope"></span> {{ $applicant->email }}</li>@endif
                                @if(!empty($applicant->phone))<li><span class="icon la la-phone"></span> {{ $applicant->phone }}</li>@endif
                              </ul>
                              @if(!empty($applicant->skills))
                                <ul class="post-tags" style="list-style:none;margin:8px 0 0;padding:0;display:flex;gap:8px;flex-wrap:wrap;">
                                  @foreach($applicant->skills as $skill)
                                    <li><a href="#" style="display:inline-block;padding:4px 8px;background:#f1f3f4;color:#555;border-radius:12px;font-size:12px;text-decoration:none;">{{ $skill }}</a></li>
                                  @endforeach
                                </ul>
                              @endif
                            </div>
                          </div>
                          <div class="option-box" style="margin-top:12px;">
                                <div class="resume-action" style="display:flex;flex-wrap:wrap;gap:8px;align-items:center;">
                                  <a href="{{ $applicant->cv_url ?? '#' }}" class="theme-btn btn-style-three" target="_blank" style="margin:0;white-space:nowrap;"><span class="la la-download"></span> Download CV</a>
                                  @if(($applicant->status ?? '') === 'shortlisted')
                                    <button type="button" class="theme-btn btn-style-two" style="margin:0;white-space:nowrap;opacity:.7;cursor:default;">
                                      <span class="la la-check"></span> Shortlisted
                                    </button>
                                  @else
                                    <form method="POST" action="{{ route('admin.application.status', ['job' => $applicant->job_id, 'application' => $applicant->application_id]) }}">
                                      @csrf
                                      <input type="hidden" name="status" value="shortlisted" />
                                      <button type="submit" class="theme-btn btn-style-two" style="margin:0;white-space:nowrap;"><span class="la la-check"></span> Shortlist</button>
                                    </form>
                                  @endif
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
                      <div class="col-12">
                        <div class="text-center" style="padding:40px 0;">
                          <h4>No applicants yet</h4>
                          <a href="{{ route('admin.manage-jobs') }}" class="theme-btn btn-style-two"><i class="la la-arrow-left"></i> Back to Jobs</a>
                        </div>
                      </div>
                    @endforelse
                  </div>

                  @if($applications instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
                    <div class="ls-pagination" style="margin-top:16px;">
                      <div class="pagination-links">
                        {{ $applications->links('pagination::bootstrap-4') }}
                      </div>
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Dashboard -->


@endsection
