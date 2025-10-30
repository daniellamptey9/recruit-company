@extends('admin.layouts.layout')

@section('content')

  <style>
    .la-spin { animation: spin 1s linear infinite; }
    @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    .btn:disabled { opacity: 0.6; cursor: not-allowed; }
    .toast-top-right { top: 12px; right: 12px; }
    .category-icon { font-size: 16px; margin-right: 8px; }
    .status-badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; }
    .status-badge.active { background-color: #d4edda; color: #155724; }
    .status-badge.inactive { background-color: #f8d7da; color: #721c24; }
    .ls-pagination { margin-top: 30px; padding: 20px 0; border-top: 1px solid #e8e8e8; }
    .pagination-info-wrapper { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; }
    .pagination-info { color: #666; font-size: 13px; font-weight: 400; }
    .pagination-info strong { color: #1967d2; font-weight: 600; }
    .pagination-links { display: flex; align-items: center; }
    .pagination-links .pagination { margin: 0; display: flex; list-style: none; padding: 0; gap: 4px; }
    .pagination-links .pagination .page-item { margin: 0; }
    .pagination-links .pagination .page-link { color: #666; background-color: #fff; border: 1px solid #e0e0e0; padding: 6px 12px; border-radius: 4px; text-decoration: none; min-width: 32px; height: 32px; text-align: center; display: inline-flex; align-items: center; justify-content: center; transition: all 0.2s ease; font-size: 13px; font-weight: 500; line-height: 1; }
    .pagination-links .pagination .page-link i { font-size: 14px; line-height: 1; }
    .pagination-links .pagination .page-link:hover { background-color: #1967d2; color: #fff; border-color: #1967d2; transform: translateY(-1px); box-shadow: 0 2px 4px rgba(25, 103, 210, 0.2); }
    .pagination-links .pagination .page-item.active .page-link { background-color: #1967d2; border-color: #1967d2; color: #fff; font-weight: 600; box-shadow: 0 2px 4px rgba(25, 103, 210, 0.2); }
    .pagination-links .pagination .page-item.disabled .page-link { color: #ccc; background-color: #f8f9fa; border-color: #e0e0e0; cursor: not-allowed; opacity: 0.6; }
    .pagination-links .pagination .page-item.disabled .page-link:hover { background-color: #f8f9fa; color: #ccc; border-color: #e0e0e0; transform: none; box-shadow: none; }
    @media (max-width: 768px) {
      .pagination-info-wrapper { flex-direction: column; align-items: center; text-align: center; }
      .pagination-links .pagination { flex-wrap: wrap; justify-content: center; }
      .pagination-links .pagination .page-link { padding: 5px 10px; min-width: 30px; height: 30px; font-size: 12px; }
      .pagination-links .pagination .page-link i { font-size: 13px; }
    }
    .modal-footer { border-top: 1px solid #dee2e6; padding: 15px; }
    .preloader { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: #fff; z-index: 9999; display: flex; align-items: center; justify-content: center; }
    .preloader:before { content: ''; width: 50px; height: 50px; border: 3px solid #f3f3f3; border-top: 3px solid #1967d2; border-radius: 50%; animation: spin 1s linear infinite; }
  </style>

  <!-- Dashboard -->
  <section class="user-dashboard">
      <div class="dashboard-outer">
        <div class="upper-title-box">
          <h3>Edit Category</h3>
          <div class="text">Update category information</div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif

        @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif

        <!-- Edit Category Form -->
        <div class="row">
          <div class="col-lg-12">
            <div class="ls-widget">
              <div class="tabs-box">
                <div class="widget-title">
                  <h4>Category Information</h4>
                </div>
                <div class="widget-content">
                  <form method="POST" action="{{ route('admin.update-category', $category->id) }}" class="default-form">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                      <!-- Category Name -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $category->name) }}" placeholder="e.g., Information Technology" required>
                        @error('name')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Description -->
                      <div class="form-group col-lg-12 col-md-12">
                        <label>Description</label>
                        <textarea name="description" placeholder="Brief description of this category">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Icon -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Icon Class</label>
                        <div class="input-group">
                          <input type="text" name="icon" value="{{ old('icon', $category->icon) }}" placeholder="e.g., la la-laptop-code" id="iconInput">
                          <button type="button" class="btn btn-outline-secondary" id="iconPickerBtn">
                            <i class="la la-search"></i> Pick Icon
                          </button>
                        </div>
                        <small class="text-muted">Use Line Awesome icon classes (e.g., la la-laptop-code)</small>
                        <div class="mt-2">
                          <i class="{{ old('icon', $category->icon) }} icon-preview" id="iconPreview"></i>
                          <span class="ms-2 text-muted" id="iconName">{{ old('icon', $category->icon) }}</span>
                        </div>
                        @error('icon')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Sort Order -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}" placeholder="0" min="0">
                        <small class="text-muted">Lower numbers appear first</small>
                        @error('sort_order')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Status -->
                      <div class="form-group col-lg-12 col-md-12">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                            Active Category
                          </label>
                          <small class="text-muted">Inactive categories won't appear in job posting forms</small>
                        </div>
                      </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="form-group col-lg-12">
                      <button type="submit" class="theme-btn btn-style-one">
                        <i class="la la-save"></i> Update Category
                      </button>
                      <a href="{{ route('admin.manage-categories') }}" class="theme-btn btn-style-two">
                        <i class="la la-arrow-left"></i> Back to Categories
                      </a>
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