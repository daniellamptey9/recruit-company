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
    
    .icon-preview {
      font-size: 20px;
      margin-left: 10px;
      vertical-align: middle;
    }
  </style>

   <!-- Dashboard -->
   <section class="user-dashboard">
      <div class="dashboard-outer">
        <div class="upper-title-box">
          <h3>Create New Category!</h3>
          <div class="text">Add a new job category to organize your job postings</div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <!-- Ls widget -->
            <div class="ls-widget">
              <div class="tabs-box">
                <div class="widget-title">
                  <h4>Category Details</h4>
                </div>

                <div class="widget-content">
                  <div class="post-job-steps">
                    <div class="step">
                      <span class="icon flaticon-briefcase"></span>
                      <h5>Category Information</h5>
                    </div>
                  </div>

                  <form class="default-form" method="POST" action="{{ route('admin.store-category') }}">
                    @csrf
                    <div class="row">
                      <!-- Category Name -->
                      <div class="form-group col-lg-12 col-md-12">
                        <label>Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g., Information Technology" required>
                        @error('name')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Description -->
                      <div class="form-group col-lg-12 col-md-12">
                        <label>Description</label>
                        <textarea name="description" placeholder="Brief description of this category">{{ old('description') }}</textarea>
                        @error('description')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Icon -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Icon Class</label>
                        <input type="text" name="icon" value="{{ old('icon', 'la la-briefcase') }}" placeholder="e.g., la la-laptop-code" id="iconInput">
                        <small class="form-text text-muted">Use Line Awesome icon classes (e.g., la la-laptop-code)</small>
                        <div class="mt-2">
                          <i class="{{ old('icon', 'la la-briefcase') }} icon-preview" id="iconPreview"></i>
                          <span class="ms-2 text-muted" id="iconName">{{ old('icon', 'la la-briefcase') }}</span>
                        </div>
                        @error('icon')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Sort Order -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" placeholder="0" min="0">
                        <small class="form-text text-muted">Lower numbers appear first</small>
                        @error('sort_order')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Status -->
                      <div class="form-group col-lg-6 col-md-6">
                        <div class="checkbox-outer">
                          <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                          <label for="is_active">Active Category</label>
                          <small class="form-text text-muted">Category will be visible to users</small>
                        </div>
                      </div>

                      <!-- Submit Buttons -->
                      <div class="form-group col-lg-12 col-md-12 text-right">
                        <a href="{{ route('admin.manage-categories') }}" class="theme-btn btn-style-two" style="margin-right: 10px;">
                          <i class="la la-arrow-left"></i> Back to Categories
                        </a>
                        <button type="submit" class="theme-btn btn-style-one">
                          <i class="la la-save"></i> Create Category
                        </button>
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