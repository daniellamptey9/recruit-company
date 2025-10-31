@extends('admin.layouts.layout')

@section('content')


    <!-- Dashboard -->
    <section class="user-dashboard">
      <div class="dashboard-outer">
        <div class="upper-title-box">
          <h3>Post a New Job!</h3>
          <div class="text">Ready to jump back in?</div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <!-- Ls widget -->
            <div class="ls-widget">
              <div class="tabs-box">
                <div class="widget-title">
                  <h4>Post Job</h4>
                </div>

                <div class="widget-content">
                  <div class="post-job-steps">
                    <div class="step">
                      <span class="icon flaticon-briefcase"></span>
                      <h5>Job Details</h5>
                    </div>
                  </div>

                  <form class="default-form" method="POST" action="{{ route('admin.post-job.store') }}">
                    @csrf
                    <div class="row">
                      <!-- Input -->
                      <div class="form-group col-lg-12 col-md-12">
                        <label>Job Title</label>
                        <input type="text" name="title" placeholder="Enter job title" required>
                        @error('title')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- About Company -->
                      <div class="form-group col-lg-12 col-md-12">
                        <label>Job Description</label>
                        <textarea name="description" placeholder="Enter detailed job description" required></textarea>
                        @error('description')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Key Responsibilities -->
                      <div class="form-group col-lg-12 col-md-12">
                        <label>Key Responsibilities</label>
                        <textarea name="key_responsibilities" placeholder="List key responsibilities (one per line)"></textarea>
                        @error('key_responsibilities')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Skills & Experience -->
                      <div class="form-group col-lg-12 col-md-12">
                        <label>Skill & Experience</label>
                        <textarea name="skills_experience" placeholder="List required skills & experience (one per line)"></textarea>
                        @error('skills_experience')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Hidden fields for company info -->
                      <input type="hidden" name="company_email" value="{{ Auth::user()->email }}">
                      <input type="hidden" name="contact_person" value="{{ Auth::user()->name }}">

                      <!-- Search Select -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Job Categories</label>
                        <select data-placeholder="Select Categories" class="chosen-select multiple" multiple tabindex="4" name="categories[]">
                          @foreach(\App\Models\Category::where('is_active', true)->orderBy('name')->get() as $category)
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
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
                          <option value="Full-time">Full-time</option>
                          <option value="Part-time">Part-time</option>
                          <option value="Contract">Contract</option>
                          <option value="Freelance">Freelance</option>
                          <option value="Internship">Internship</option>
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
                          <option value="$30,000 - $50,000">$30,000 - $50,000</option>
                          <option value="$50,000 - $70,000">$50,000 - $70,000</option>
                          <option value="$70,000 - $90,000">$70,000 - $90,000</option>
                          <option value="$90,000 - $120,000">$90,000 - $120,000</option>
                          <option value="$120,000+">$120,000+</option>
                          <option value="Negotiable">Negotiable</option>
                        </select>
                        @error('salary_range')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group col-lg-6 col-md-12">
                        <label>Career Level</label>
                        <select class="chosen-select" name="career_level" required>
                          <option value="">Select Career Level</option>
                          <option value="Entry Level">Entry Level</option>
                          <option value="Mid Level">Mid Level</option>
                          <option value="Senior Level">Senior Level</option>
                          <option value="Executive">Executive</option>
                        </select>
                        @error('career_level')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group col-lg-6 col-md-12">
                        <label>Experience Required</label>
                        <select class="chosen-select" name="experience" required>
                          <option value="">Select Experience</option>
                          <option value="0-1 years">0-1 years</option>
                          <option value="1-3 years">1-3 years</option>
                          <option value="3-5 years">3-5 years</option>
                          <option value="5-10 years">5-10 years</option>
                          <option value="10+ years">10+ years</option>
                        </select>
                        @error('experience')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group col-lg-6 col-md-12">
                        <label>Gender Preference</label>
                        <select class="chosen-select" name="gender_preference">
                          <option value="">No Preference</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                          <option value="Any">Any</option>
                        </select>
                        @error('gender_preference')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group col-lg-6 col-md-12">
                        <label>Industry</label>
                        <select class="chosen-select" name="industry" required>
                          <option value="">Select Industry</option>
                          <option value="Technology">Technology</option>
                          <option value="Finance">Finance</option>
                          <option value="Healthcare">Healthcare</option>
                          <option value="Education">Education</option>
                          <option value="Retail">Retail</option>
                          <option value="Manufacturing">Manufacturing</option>
                          <option value="Other">Other</option>
                        </select>
                        @error('industry')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group col-lg-6 col-md-12">
                        <label>Qualification Required</label>
                        <select class="chosen-select" name="qualification">
                          <option value="">Select Qualification</option>
                          <option value="High School">High School</option>
                          <option value="Diploma">Diploma</option>
                          <option value="Bachelor's Degree">Bachelor's Degree</option>
                          <option value="Master's Degree">Master's Degree</option>
                          <option value="PhD">PhD</option>
                          <option value="No Specific Requirement">No Specific Requirement</option>
                        </select>
                        @error('qualification')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-12 col-md-12">
                        <label>Application Deadline Date</label>
                        <input type="date" name="deadline" placeholder="Select deadline date" required>
                        @error('deadline')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Work Location</label>
                        <select class="chosen-select" name="work_location" required>
                          <option value="">Select Work Location</option>
                          <option value="On-site">On-site</option>
                          <option value="Remote">Remote</option>
                          <option value="Hybrid">Hybrid</option>
                        </select>
                        @error('work_location')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Office Location</label>
                        <input type="text" name="office_location" placeholder="e.g., Melbourne, VIC" required>
                        @error('office_location')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Job Status Options -->
                      <div class="form-group col-lg-6 col-md-6">
                        <div class="checkbox-outer">
                          <input type="checkbox" name="is_active" id="is_active" value="1" checked>
                          <label for="is_active">Active Job</label>
                          <small class="form-text text-muted">Job will be visible to candidates</small>
                        </div>
                      </div>

                      <div class="form-group col-lg-6 col-md-6">
                        <div class="checkbox-outer">
                          <input type="checkbox" name="is_featured" id="is_featured" value="1">
                          <label for="is_featured">Featured Job</label>
                          <small class="form-text text-muted">Job will appear on homepage featured section</small>
                        </div>
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-12 col-md-12 text-right">
                        <button type="submit" class="theme-btn btn-style-one">Post Job</button>
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