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
          <h3>Change Details</h3>
          <div class="text">Update your personal information</div>
        </div>

        <!-- Ls widget -->
        <div class="ls-widget">
          <div class="widget-title">
            <h4>Personal Information</h4>
          </div>

          <div class="widget-content">
            <form class="default-form" method="POST" action="{{ route('admin.change-details.update') }}" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <!-- Logo Upload -->
                <div class="form-group col-lg-7 col-md-12">
                  <label>Company Logo</label>
                  <input type="file" name="logo" accept="image/*">
                  @if(Auth::user()->logo)
                    <div class="mt-2"><img src="{{ Auth::user()->logo_url }}" alt="Logo" style="height:50px"></div>
                  @endif
                  @error('logo')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Input -->
                <div class="form-group col-lg-7 col-md-12">
                  <label>Full Name</label>
                  <input type="text" name="name" value="{{ Auth::user()->name }}" placeholder="Enter your full name" required>
                  @error('name')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Input -->
                <div class="form-group col-lg-7 col-md-12">
                  <label>Email Address</label>
                  <input type="email" name="email" value="{{ Auth::user()->email }}" placeholder="Enter your email address" required>
                  @error('email')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Input -->
                <div class="form-group col-lg-7 col-md-12">
                  <label>Role</label>
                  <input type="text" value="{{ ucfirst(Auth::user()->role) }}" placeholder="User Role" readonly>
                  <small class="text-muted">Role cannot be changed</small>
                </div>

                <!-- Input -->
                <div class="form-group col-lg-6 col-md-12">
                  <button type="submit" class="theme-btn btn-style-one">Update Details</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- End Dashboard -->


@endsection