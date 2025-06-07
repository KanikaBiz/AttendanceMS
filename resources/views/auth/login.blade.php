<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Login</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/dist/css/adminlte.min.css">
  <style>
    body {
      font-family: 'Kantumruy Pro', sans-serif;
    }

    .login-page {
      background: url('{{ assetUrl() }}assets/backend/dist/img/login-bg.jpg') no-repeat center center fixed;
      background-size: cover;
    }

    .login-box {
      margin-top: 100px;
    }

    .login-box .card {
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="{{ route('login') }}" class="h1"><b>ចូលប្រើ​</b>ប្រព័ន្ធ</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">ចូលប្រើ​ដើម្បីចាប់ផ្តើមគ្រប់គ្រង</p>
        <form action="{{ route('login') }}" method="post" autocomplete="off">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-12">
              <div class="input-group mb-3">
                <input name="email" type="email" class="form-control  @error('email') is-invalid @enderror"
                  value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('Email Address') }}"
                  autofocus>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="input-group mb-3">
                <input name="password" id="password" type="password"
                  class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}"
                  required autocomplete="current-password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input name="remember" id="remember" type="checkbox">
                <label for="remember">
                  {{ __('Remember Me') }}
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center mt-2 mb-3">
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> ចូលប្រើជាមួយ Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> ចូលប្រើជាមួយ Google+
          </a>
        </div>
        <!-- /.social-auth-links -->
        <p class="mb-1">
          <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
        </p>
        <p class="mb-0">
          <a href="{{ route('register') }}" class="text-center">ចុះឈ្មោះសមាជិកថ្មី</a>
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="{{ assetUrl() }}assets/backend/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ assetUrl() }}assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{ assetUrl() }}assets/backend/dist/js/adminlte.min.js"></script>
</body>

</html>
