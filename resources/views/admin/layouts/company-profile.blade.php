@extends('admin.layouts.layout')

@section('content')

   <!-- Dashboard -->
   <section class="user-dashboard">
      <div class="dashboard-outer">
        <div class="upper-title-box">
          <h3>Company Profile!</h3>
          <div class="text">Ready to jump back in?</div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <!-- Ls widget -->
            <div class="ls-widget">
              <div class="tabs-box">
                <div class="widget-title">
                  <h4>My Profile</h4>
                </div>

                <div class="widget-content">
                  <form class="default-form" method="POST" action="{{ route('admin.company-profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <!-- Logo Upload -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Company Logo</label>
                        <div class="uploading-outer">
                          <div class="uploadButton">
                            <input class="uploadButton-input" type="file" name="logo" accept="image/*" id="upload" />
                            <label class="uploadButton-button ripple-effect" for="upload">Browse Logo</label>
                            <span class="uploadButton-file-name"></span>
                          </div>
                          <div class="text">Max file size is 2MB. Suitable files are .jpg, .png, .webp</div>
                        </div>
                        @if(isset($company) && !empty($company->logo))
                          <div class="mt-2">
                            <img src="{{ !empty($company->logo_url) ? $company->logo_url : asset('storage/' . $company->logo) }}" alt="Logo" style="height:60px;border-radius:6px;">
                          </div>
                        @endif
                        @error('logo')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Company name (optional)</label>
                        <input type="text" name="name" value="{{ $company->name ?? '' }}" placeholder="Invisionn">
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Email address</label>
                        <input type="text" name="email" value="{{ $company->email ?? '' }}" placeholder="creativelayers">
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Phone</label>
                        <input type="text" name="phone" value="{{ $company->phone ?? '' }}" placeholder="0 123 456 7890">
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Website</label>
                        <input type="text" name="website" value="{{ $company->website ?? '' }}" placeholder="www.invision.com">
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Est. Since</label>
                        <input type="text" name="established_since" value="{{ $company->formatted_established ?? '' }}" placeholder="06.04.2020">
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Team Size</label>
                        <select class="chosen-select" name="team_size">
                          <option value="10 - 50" {{ ($company->team_size ?? '') == '10 - 50' ? 'selected' : '' }}>10 - 50</option>
                          <option value="50 - 100" {{ ($company->team_size ?? '') == '50 - 100' ? 'selected' : '' }}>50 - 100</option>
                          <option value="100 - 150" {{ ($company->team_size ?? '') == '100 - 150' ? 'selected' : '' }}>100 - 150</option>
                          <option value="200 - 250" {{ ($company->team_size ?? '') == '200 - 250' ? 'selected' : '' }}>200 - 250</option>
                          <option value="300 - 350" {{ ($company->team_size ?? '') == '300 - 350' ? 'selected' : '' }}>300 - 350</option>
                          <option value="500 - 1000" {{ ($company->team_size ?? '') == '500 - 1000' ? 'selected' : '' }}>500 - 1000</option>
                        </select>
                      </div>


                      <!-- About Company -->
                      <div class="form-group col-lg-12 col-md-12">
                        <label>About Company</label>
                        <textarea name="about" placeholder="Spent several years working on sheep on Wall Street. Had moderate success investing in Yugo's on Wall Street. Managed a small team buying and selling Pogo sticks for farmers. Spent several years licensing licorice in West Palm Beach, FL. Developed several new methods for working it banjos in the aftermarket. Spent a weekend importing banjos in West Palm Beach, FL.In this position, the Software Engineer collaborates with Evention's Development team to continuously enhance our current software solutions as well as create new solutions to eliminate the back-office operations and management challenges present">{{ $company->about ?? '' }}</textarea>
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <button type="submit" class="theme-btn btn-style-one">Save</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Ls widget -->
            <div class="ls-widget">
              <div class="tabs-box">
                <div class="widget-title">
                  <h4>Social Network</h4>
                </div>

                <div class="widget-content">
                  <form class="default-form" method="POST" action="{{ route('admin.company-profile.update') }}">
                    @csrf
                    <div class="row">
                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Facebook</label>
                        <input type="text" name="facebook" value="{{ $company->facebook ?? '' }}" placeholder="www.facebook.com/Invision">
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Twitter</label>
                        <input type="text" name="twitter" value="{{ $company->twitter ?? '' }}" placeholder="">
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Linkedin</label>
                        <input type="text" name="linkedin" value="{{ $company->linkedin ?? '' }}" placeholder="">
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Google Plus</label>
                        <input type="text" name="google_plus" value="{{ $company->google_plus ?? '' }}" placeholder="">
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <button type="submit" class="theme-btn btn-style-one">Save</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Ls widget -->
            <div class="ls-widget">
              <div class="tabs-box">
                <div class="widget-title">
                  <h4>Contact Information</h4>
                </div>

                <div class="widget-content">
                  <form class="default-form" method="POST" action="{{ route('admin.company-profile.update') }}">
                    @csrf
                    <div class="row">
                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Country</label>
                        <input type="text" name="country" value="{{ $company->country ?? '' }}" placeholder="Enter country">
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>City</label>
                        <input type="text" name="city" value="{{ $company->city ?? '' }}" placeholder="Enter city">
                      </div>

                      <!-- Input -->
                      <div class="form-group col-lg-12 col-md-12">
                        <label>Complete Address</label>
                        <input type="text" name="address" value="{{ $company->address ?? '' }}" placeholder="Enter complete address">
                      </div>


                      <!-- Input -->
                      <div class="form-group col-lg-12 col-md-12">
                        <button type="submit" class="theme-btn btn-style-one">Save</button>
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