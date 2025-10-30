@extends('admin.layouts.layout')

@section('content')

  <style>
    .job-details-card {
      background: #fff;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }
    
    .job-title {
      color: #1967d2;
      font-size: 28px;
      font-weight: 600;
      margin-bottom: 10px;
    }
    
    .job-meta {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 20px;
    }
    
    .job-meta-item {
      display: flex;
      align-items: center;
      color: #666;
    }
    
    .job-meta-item i {
      margin-right: 8px;
      color: #1967d2;
    }
    
    .job-description {
      line-height: 1.6;
      color: #333;
      margin-bottom: 30px;
    }
    
    .job-requirements {
      background: #f8f9fa;
      padding: 20px;
      border-radius: 6px;
      margin-bottom: 20px;
    }
    
    .job-requirements h4 {
      color: #1967d2;
      margin-bottom: 15px;
    }
    
    .requirement-item {
      display: flex;
      margin-bottom: 10px;
    }
    
    .requirement-label {
      font-weight: 600;
      min-width: 150px;
      color: #555;
    }
    
    .requirement-value {
      color: #333;
    }
    
    .job-actions {
      display: flex;
      gap: 15px;
      margin-top: 30px;
    }
    
    .status-badge {
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
    }
    
    .status-badge.active {
      background: #d4edda;
      color: #155724;
    }
    
    .status-badge.inactive {
      background: #f8d7da;
      color: #721c24;
    }
  </style>

  <!-- Dashboard -->
  <section class="user-dashboard">
      <div class="dashboard-outer">
        <div class="upper-title-box">
          <h3>Job Details</h3>
          <div class="text">View job information</div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="job-details-card">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <h1 class="job-title">{{ $job->title }}</h1>
                <span class="status-badge {{ $job->is_active ? 'active' : 'inactive' }}">
                  {{ $job->is_active ? 'Active' : 'Inactive' }}
                </span>
              </div>

              <div class="job-meta">
                <div class="job-meta-item">
                  <i class="la la-briefcase"></i>
                  <span>{{ $job->job_type }}</span>
                </div>
                <div class="job-meta-item">
                  <i class="la la-dollar-sign"></i>
                  <span>{{ $job->salary_range }}</span>
                </div>
                <div class="job-meta-item">
                  <i class="la la-map-marker"></i>
                  <span>{{ $job->work_location }} - {{ $job->office_location }}</span>
                </div>
                <div class="job-meta-item">
                  <i class="la la-calendar"></i>
                  <span>Deadline: {{ $job->formatted_deadline }}</span>
                </div>
                <div class="job-meta-item">
                  <i class="la la-industry"></i>
                  <span>{{ $job->industry }}</span>
                </div>
              </div>

              <div class="job-description">
                <h4>Job Description</h4>
                <p>{{ $job->description }}</p>
              </div>

              <div class="job-requirements">
                <h4>Job Requirements</h4>
                <div class="requirement-item">
                  <span class="requirement-label">Career Level:</span>
                  <span class="requirement-value">{{ $job->career_level }}</span>
                </div>
                <div class="requirement-item">
                  <span class="requirement-label">Experience:</span>
                  <span class="requirement-value">{{ $job->experience }}</span>
                </div>
                @if($job->qualification)
                <div class="requirement-item">
                  <span class="requirement-label">Qualification:</span>
                  <span class="requirement-value">{{ $job->qualification }}</span>
                </div>
                @endif
                @if($job->gender_preference)
                <div class="requirement-item">
                  <span class="requirement-label">Gender Preference:</span>
                  <span class="requirement-value">{{ $job->gender_preference }}</span>
                </div>
                @endif
                @if($job->categories && count($job->categories) > 0)
                <div class="requirement-item">
                  <span class="requirement-label">Specialisms:</span>
                  <span class="requirement-value">{{ implode(', ', $job->categories) }}</span>
                </div>
                @endif
              </div>

              <div class="job-requirements">
                <h4>Contact Information</h4>
                <div class="requirement-item">
                  <span class="requirement-label">Contact Person:</span>
                  <span class="requirement-value">{{ $job->contact_person }}</span>
                </div>
                <div class="requirement-item">
                  <span class="requirement-label">Email:</span>
                  <span class="requirement-value">{{ $job->company_email }}</span>
                </div>
              </div>

              <div class="job-actions">
                <a href="{{ route('admin.job.edit', $job->id) }}" class="theme-btn btn-style-one">
                  <i class="la la-edit"></i> Edit Job
                </a>
                <a href="{{ route('admin.job.applicants', $job->id) }}" class="theme-btn btn-style-four">
                  <i class="la la-users"></i> View Applicants
                </a>
                <a href="{{ route('admin.manage-jobs') }}" class="theme-btn btn-style-two">
                  <i class="la la-arrow-left"></i> Back to Jobs
                </a>
                <form method="POST" action="{{ route('admin.job.destroy', $job->id) }}" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" onclick="return confirm('Are you sure you want to delete this job?')" class="theme-btn btn-style-three">
                    <i class="la la-trash"></i> Delete Job
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Dashboard -->


@endsection