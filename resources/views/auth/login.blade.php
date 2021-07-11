<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login | Perpus SMK Muhammadiyah 7 Jakarta</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('favicon.ico')}}" />
</head>

<body>
  <form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
        <div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one" style="background-image: url({{ url('images/login_1.jpg') }}); background-size: cover;">

          <div class="row w-100">
            <div class="col-md-12" style="margin-bottom: 20px;">
              <h2 class="text-white" style="text-align: center;">Login | Perpus SMK Muhammadiyah 7 Jakarta</h2>
            </div>
            <div class="col-lg-4 mx-auto">
              <div class="auto-form-wrapper">

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"">
                  <label class=" label">Username</label>
                  <div class="input-group">
                    <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                  </div>
                  @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label class="label">Password</label>
                  <div class="input-group">
                    <input id="password" type="password" class="form-control" name="password" required>
                    @if ($errors->has('password'))
                    <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary submit-btn btn-block" type="submit">Login</button>
                </div>
              </div>
              <p class="footer-text text-center text-white" style="margin-top: 20px;color: #308ee0">Copyright © {{date('Y')}} SMK Muhammadiyah 7 Jakarta - All rights reserved.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</body>

</html>