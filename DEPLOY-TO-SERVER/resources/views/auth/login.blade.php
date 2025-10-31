{{-- Superio login page adapted for Laravel auth --}}
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Superio | Login</title>
  <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>

<body>
  <div class="page-wrapper">

    <header class="main-header">
      <div class="container-fluid">
        <div class="main-box">
          <div class="nav-outer">
            <div class="logo-box">
              <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo-2.svg') }}" alt="" title=""></a></div>
            </div>
          </div>
          <div class="outer-box">
            <div class="btn-box">
              <a href="{{ route('login') }}" class="theme-btn btn-style-three">Login / Register</a>
              <a href="#" class="theme-btn btn-style-one"><span class="btn-title">Job Post</span></a>
            </div>
          </div>
        </div>
      </div>
      <div class="mobile-header">
        <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.svg') }}" alt="" title=""></a></div>
      </div>
      <div id="nav-mobile"></div>
    </header>

    <div class="login-section">
      <div class="image-layer" style="background-image: url({{ asset('assets/images/background/12.jpg') }});"></div>
      <div class="outer-box">
        <div class="login-form default-form">
          <div class="form-inner">
            <h3>Login to Superio</h3>
            <form method="post" action="{{ route('login.attempt') }}">
              @csrf
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input id="password-field" type="password" name="password" placeholder="Password" required>
              </div>
              <div class="form-group">
                <div class="field-outer">
                  <div class="input-group checkboxes square">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="remember"><span class="custom-checkbox"></span> Remember me</label>
                  </div>
                </div>
              </div>
              @if ($errors->any())
              <div class="form-group">
                <div class="alert alert-danger">{{ $errors->first() }}</div>
              </div>
              @endif
              @if (session('error'))
              <div class="form-group">
                <div class="alert alert-danger">{{ session('error') }}</div>
              </div>
              @endif
              <div class="form-group">
                <button class="theme-btn btn-style-one" type="submit">Log In</button>
              </div>
            </form>
            <div class="bottom-box">
              <div class="text">Don't have an account? <a href="{{ route('register') }}">Signup</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <script src="{{ asset('assets/js/jquery.js') }}"></script>
  <script src="{{ asset('assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/chosen.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.fancybox.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.modal.min.js') }}"></script>
  <script src="{{ asset('assets/js/mmenu.polyfills.js') }}"></script>
  <script src="{{ asset('assets/js/mmenu.js') }}"></script>
  <script src="{{ asset('assets/js/appear.js') }}"></script>
  <script src="{{ asset('assets/js/ScrollMagic.min.js') }}"></script>
  <script src="{{ asset('assets/js/rellax.min.js') }}"></script>
  <script src="{{ asset('assets/js/owl.js') }}"></script>
  <script src="{{ asset('assets/js/wow.js') }}"></script>
  <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>


