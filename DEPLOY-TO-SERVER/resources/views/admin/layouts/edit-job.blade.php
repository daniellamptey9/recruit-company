@extends('admin.layouts.layout')

@section('content')


  <style>
    .la-spin {
      animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    
    .btn:disabled {
      opacity: 0.6;
      cursor: not-allowed;
    }
    
    .toast-top-right {
      top: 12px;
      right: 12px;
    }
  </style>



    <!-- Dashboard -->
    <section class="user-dashboard">
      <div class="dashboard-outer">
        <div class="upper-title-box">
          <h3>Edit Job</h3>
          <div class="text">Update job details</div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <!-- Ls widget -->
            <div class="ls-widget">
              <div class="tabs-box">
                <div class="widget-title">
                  <h4>Job Details</h4>
                </div>

                <div class="widget-content">
                  <form class="default-form" method="POST" action="{{ route('admin.job.update', $job->id) }}">
                    @csrf
                    @method('PUT')
                    
                    <!-- Hidden fields to ensure checkboxes work with PUT method -->
                    <input type="hidden" name="is_active" value="0">
                    <input type="hidden" name="is_featured" value="0">
                    
                    @if ($errors->any())
                      <div class="alert alert-danger">
                        <ul class="mb-0">
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif
                    <div class="row">
                      <!-- Input -->
                      <div class="form-group col-lg-12 col-md-12">
                        <label>Job Title</label>
                        <input type="text" name="title" value="{{ old('title', $job->title ?? '') }}" placeholder="Enter job title" required>
                        @error('title')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- About Company -->
                      <div class="form-group col-lg-12 col-md-12">
                        <label>Job Description</label>
                        <textarea name="description" placeholder="Enter detailed job description" required>{{ old('description', $job->description ?? '') }}</textarea>
                        @error('description')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Key Responsibilities -->
                      <div class="form-group col-lg-12 col-md-12">
                        <label>Key Responsibilities</label>
                        <textarea name="key_responsibilities" placeholder="List key responsibilities (one per line)">{{ old('key_responsibilities', $job->key_responsibilities ?? '') }}</textarea>
                        @error('key_responsibilities')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Skill & Experience -->
                      <div class="form-group col-lg-12 col-md-12">
                        <label>Skill & Experience</label>
                        <textarea name="skills_experience" placeholder="List required skills & experience (one per line)">{{ old('skills_experience', $job->skills_experience ?? '') }}</textarea>
                        @error('skills_experience')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Hidden fields for company info -->
                      <input type="hidden" name="company_email" value="{{ $job->company_email }}">
                      <input type="hidden" name="contact_person" value="{{ $job->contact_person }}">

                      <!-- Search Select -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Job Categories</label>
                        <select data-placeholder="Select Categories" class="chosen-select multiple" multiple tabindex="4" name="categories[]">
                          @php
                            $selectedCategories = old('categories', $job->categories ?? []);
                          @endphp
                          @foreach(\App\Models\Category::where('is_active', true)->orderBy('name')->get() as $category)
                            <option value="{{ $category->name }}" {{ in_array($category->name, $selectedCategories) ? 'selected' : '' }}>{{ $category->name }}</option>
                          @endforeach
                        </select>
                        @error('categories')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group col-lg-6 col-md-12">
                        <label>Job Type</label>
                        <select class="chosen-select" name="job_type" required>
                          <option value="">Select Job Type</option>
                          <option value="Full-time" {{ old('job_type', $job->job_type ?? '') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                          <option value="Part-time" {{ old('job_type', $job->job_type ?? '') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                          <option value="Contract" {{ old('job_type', $job->job_type ?? '') == 'Contract' ? 'selected' : '' }}>Contract</option>
                          <option value="Freelance" {{ old('job_type', $job->job_type ?? '') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                          <option value="Internship" {{ old('job_type', $job->job_type ?? '') == 'Internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                        @error('job_type')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Offered Salary</label>
                        <select class="chosen-select" name="salary_range" required>
                          <option value="">Select Salary Range</option>
                          <option value="$30,000 - $50,000" {{ old('salary_range', $job->salary_range ?? '') == '$30,000 - $50,000' ? 'selected' : '' }}>$30,000 - $50,000</option>
                          <option value="$50,000 - $70,000" {{ old('salary_range', $job->salary_range ?? '') == '$50,000 - $70,000' ? 'selected' : '' }}>$50,000 - $70,000</option>
                          <option value="$70,000 - $90,000" {{ old('salary_range', $job->salary_range ?? '') == '$70,000 - $90,000' ? 'selected' : '' }}>$70,000 - $90,000</option>
                          <option value="$90,000 - $120,000" {{ old('salary_range', $job->salary_range ?? '') == '$90,000 - $120,000' ? 'selected' : '' }}>$90,000 - $120,000</option>
                          <option value="$120,000+" {{ old('salary_range', $job->salary_range ?? '') == '$120,000+' ? 'selected' : '' }}>$120,000+</option>
                          <option value="Negotiable" {{ old('salary_range', $job->salary_range ?? '') == 'Negotiable' ? 'selected' : '' }}>Negotiable</option>
                        </select>
                        @error('salary_range')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group col-lg-6 col-md-12">
                        <label>Career Level</label>
                        <select class="chosen-select" name="career_level" required>
                          <option value="">Select Career Level</option>
                          <option value="Entry Level" {{ old('career_level', $job->career_level ?? '') == 'Entry Level' ? 'selected' : '' }}>Entry Level</option>
                          <option value="Mid Level" {{ old('career_level', $job->career_level ?? '') == 'Mid Level' ? 'selected' : '' }}>Mid Level</option>
                          <option value="Senior Level" {{ old('career_level', $job->career_level ?? '') == 'Senior Level' ? 'selected' : '' }}>Senior Level</option>
                          <option value="Executive" {{ old('career_level', $job->career_level ?? '') == 'Executive' ? 'selected' : '' }}>Executive</option>
                        </select>
                        @error('career_level')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group col-lg-6 col-md-12">
                        <label>Experience Required</label>
                        <select class="chosen-select" name="experience" required>
                          <option value="">Select Experience</option>
                          <option value="0-1 years" {{ old('experience', $job->experience ?? '') == '0-1 years' ? 'selected' : '' }}>0-1 years</option>
                          <option value="1-3 years" {{ old('experience', $job->experience ?? '') == '1-3 years' ? 'selected' : '' }}>1-3 years</option>
                          <option value="3-5 years" {{ old('experience', $job->experience ?? '') == '3-5 years' ? 'selected' : '' }}>3-5 years</option>
                          <option value="5-10 years" {{ old('experience', $job->experience ?? '') == '5-10 years' ? 'selected' : '' }}>5-10 years</option>
                          <option value="10+ years" {{ old('experience', $job->experience ?? '') == '10+ years' ? 'selected' : '' }}>10+ years</option>
                        </select>
                        @error('experience')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group col-lg-6 col-md-12">
                        <label>Gender Preference</label>
                        <select class="chosen-select" name="gender_preference">
                          <option value="">No Preference</option>
                          <option value="Male" {{ old('gender_preference', $job->gender_preference ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                          <option value="Female" {{ old('gender_preference', $job->gender_preference ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                          <option value="Any" {{ old('gender_preference', $job->gender_preference ?? '') == 'Any' ? 'selected' : '' }}>Any</option>
                        </select>
                        @error('gender_preference')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group col-lg-6 col-md-12">
                        <label>Industry</label>
                        <select class="chosen-select" name="industry" required>
                          <option value="">Select Industry</option>
                          <option value="Technology" {{ old('industry', $job->industry ?? '') == 'Technology' ? 'selected' : '' }}>Technology</option>
                          <option value="Finance" {{ old('industry', $job->industry ?? '') == 'Finance' ? 'selected' : '' }}>Finance</option>
                          <option value="Healthcare" {{ old('industry', $job->industry ?? '') == 'Healthcare' ? 'selected' : '' }}>Healthcare</option>
                          <option value="Education" {{ old('industry', $job->industry ?? '') == 'Education' ? 'selected' : '' }}>Education</option>
                          <option value="Retail" {{ old('industry', $job->industry ?? '') == 'Retail' ? 'selected' : '' }}>Retail</option>
                          <option value="Manufacturing" {{ old('industry', $job->industry ?? '') == 'Manufacturing' ? 'selected' : '' }}>Manufacturing</option>
                          <option value="Other" {{ old('industry', $job->industry ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('industry')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group col-lg-6 col-md-12">
                        <label>Qualification Required</label>
                        <select class="chosen-select" name="qualification">
                          <option value="">Select Qualification</option>
                          <option value="High School" {{ old('qualification', $job->qualification ?? '') == 'High School' ? 'selected' : '' }}>High School</option>
                          <option value="Diploma" {{ old('qualification', $job->qualification ?? '') == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                          <option value="Bachelor's Degree" {{ old('qualification', $job->qualification ?? '') == 'Bachelor\'s Degree' ? 'selected' : '' }}>Bachelor's Degree</option>
                          <option value="Master's Degree" {{ old('qualification', $job->qualification ?? '') == 'Master\'s Degree' ? 'selected' : '' }}>Master's Degree</option>
                          <option value="PhD" {{ old('qualification', $job->qualification ?? '') == 'PhD' ? 'selected' : '' }}>PhD</option>
                          <option value="No Specific Requirement" {{ old('qualification', $job->qualification ?? '') == 'No Specific Requirement' ? 'selected' : '' }}>No Specific Requirement</option>
                        </select>
                        @error('qualification')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-12 col-md-12">
                        <label>Application Deadline Date</label>
                        <input type="date" name="deadline" value="{{ old('deadline', $job->deadline ? $job->deadline->format('Y-m-d') : '') }}" placeholder="Select deadline date" required>
                        @error('deadline')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Work Location</label>
                        <select class="chosen-select" name="work_location" required>
                          <option value="">Select Work Location</option>
                          <option value="On-site" {{ old('work_location', $job->work_location ?? '') == 'On-site' ? 'selected' : '' }}>On-site</option>
                          <option value="Remote" {{ old('work_location', $job->work_location ?? '') == 'Remote' ? 'selected' : '' }}>Remote</option>
                          <option value="Hybrid" {{ old('work_location', $job->work_location ?? '') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                        @error('work_location')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Office Location</label>
                        <input type="text" name="office_location" value="{{ old('office_location', $job->office_location ?? '') }}" placeholder="e.g., Melbourne, VIC" required>
                        @error('office_location')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Job Status Options -->
                      <div class="form-group col-lg-6 col-md-6">
                        <div class="checkbox-outer">
                          <input type="checkbox" name="is_active" id="is_active" value="1" {{ $job->is_active ? 'checked' : '' }}>
                          <label for="is_active">Active Job</label>
                          <small class="form-text text-muted">Job will be visible to candidates</small>
                          <small class="form-text text-info">Current: {{ $job->is_active ? 'Active' : 'Inactive' }}</small>
                        </div>
                      </div>

                      <div class="form-group col-lg-6 col-md-6">
                        <div class="checkbox-outer">
                          <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ $job->is_featured ? 'checked' : '' }}>
                          <label for="is_featured">Featured Job</label>
                          <small class="form-text text-muted">Job will appear on homepage featured section</small>
                          <small class="form-text text-info">Current: {{ $job->is_featured ? 'Featured' : 'Regular' }}</small>
                        </div>
                      </div>


                      <!-- Input -->
                      <div class="form-group col-lg-12 col-md-12 text-right">
                        <a href="{{ route('admin.manage-jobs') }}" class="theme-btn btn-style-two">Cancel</a>
                        <button type="submit" class="theme-btn btn-style-one">Update Job</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Dashboard -->

@endsection


