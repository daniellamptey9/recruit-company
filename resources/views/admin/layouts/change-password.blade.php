@extends('admin.layouts.layout')

@section('content')

    <!-- Dashboard -->
    <section class="user-dashboard">
      <div class="dashboard-outer">
        <div class="upper-title-box">
          <h3>Change Password</h3>
          <div class="text">Ready to jump back in?</div>
        </div>

        <!-- Ls widget -->
        <div class="ls-widget">
          <div class="widget-title">
            <h4>Change Password</h4>
          </div>

          <div class="widget-content">
            <form class="default-form" method="POST" action="{{ route('admin.change-password.update') }}">
              @csrf
              <div class="row">
                <!-- Input -->
                <div class="form-group col-lg-7 col-md-12">
                  <label>Old Password</label>
                  <input type="password" name="current_password" placeholder="Enter current password" required>
                  @error('current_password')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Input -->
                <div class="form-group col-lg-7 col-md-12">
                  <label>New Password</label>
                  <input type="password" name="password" placeholder="Enter new password" required>
                  @error('password')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Input -->
                <div class="form-group col-lg-7 col-md-12">
                  <label>Confirm Password</label>
                  <input type="password" name="password_confirmation" placeholder="Confirm new password" required>
                  @error('password_confirmation')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Input -->
                <div class="form-group col-lg-6 col-md-12">
                  <button type="submit" class="theme-btn btn-style-one">Update</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- End Dashboard -->

@endsection