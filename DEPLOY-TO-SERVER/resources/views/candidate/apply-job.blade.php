@extends('master')

@section('title','Apply for ' . $job->title)

@section('content')
  <!--Page Title-->
  <section class="page-title style-two">
    <div class="auto-container">
      <div class="title-outer">
        <h1>Apply for {{ $job->title }}</h1>
        <ul class="page-breadcrumb">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="{{ route('jobs') }}">Jobs</a></li>
          <li>Apply</li>
        </ul>
      </div>
    </div>
  </section>

  <section class="ls-section">
    <div class="auto-container">
      @php 
        $siteCompany = \App\Models\Company::first(); 
        // Strictly use companies.logo per requirement
        $logoUrl = ($siteCompany && $siteCompany->logo_url) ? $siteCompany->logo_url : asset('assets/images/resource/company-7.png');
      @endphp
      <div class="row">
        <div class="content-column col-lg-8 col-md-12 col-sm-12">
          <div class="ls-outer">
            <div class="ls-switcher">
              <div class="showing-result">
                <div class="text">You're applying to <strong>{{ $job->title }}</strong></div>
              </div>
            </div>

            <div class="ls-widget">
              <div class="widget-content">
                <form class="default-form" method="POST" action="{{ route('candidate.apply.submit', $job->id) }}" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Cover Letter (optional)</label>
                      <textarea name="cover_letter" placeholder="Write a brief cover letter...">{{ old('cover_letter') }}</textarea>
                      @error('cover_letter')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-group col-lg-12 col-md-12">
                      <label>Upload Resume (PDF/DOC/DOCX, max 5MB)</label>
                      <input type="file" name="resume_file" accept=".pdf,.doc,.docx" required>
                      @error('resume_file')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-group col-lg-12 col-md-12">
                      <label>Additional Information (optional)</label>
                      <textarea name="additional_info" placeholder="Any extra info to share?">{{ old('additional_info') }}</textarea>
                      @error('additional_info')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-group col-lg-12 col-md-12">
                      <button type="submit" class="theme-btn btn-style-one">Submit Application</button>
                      <a href="{{ route('job.detail', $job->id) }}" class="theme-btn btn-style-two">Cancel</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="sidebar-column col-lg-4 col-md-12 col-sm-12">
          <aside class="sidebar">
            <div class="sidebar-widget company-widget">
              <div class="widget-content">
                <div class="company-title">
                  <div class="company-logo"><img src="{{ $logoUrl }}" alt=""></div>
                  <h5 class="company-name">{{ optional($job->company)->name ?? ($siteCompany->name ?? 'Company') }}</h5>
                </div>
                <ul class="company-info">
                  <li>Location: <span>{{ $job->office_location ?? 'N/A' }}</span></li>
                  @if(!empty($job->salary_range))
                  <li>Salary: <span>{{ $job->salary_range }}</span></li>
                  @endif
                  <li>Type: <span>{{ $job->job_type ?? 'N/A' }}</span></li>
                </ul>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </section>
@endsection


