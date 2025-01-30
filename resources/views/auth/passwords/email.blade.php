<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  {{-- Icons --}}
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('image/logo.png') }}">

  <title>{{ config('app.name') }}</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
    integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
    crossorigin="anonymous" />

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body class="hold-transition dark-mode login-page">
  <div class="login-box" style="width: 500px;">
    <div class="login-logo">
      <!-- <img src="{{-- asset('image/logo.png') --}}" height=70 width=70 alt="logo"> -->
      Hi Admin
    </div>
    <!-- /.login-logo -->

    <!-- /.login-box-body -->
    <div class="card">
    <div class="card-header">{{ __('Reset Password') }}</div>

      <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
      <!-- /.login-card-body -->
    </div>

  </div>
  <!-- /.login-box -->

  <script src="{{ asset('js/app.js') }}" defer></script>

</body>

</html>