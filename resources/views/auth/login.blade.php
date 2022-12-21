<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Log In Here</title>
    <!-- Favicon-->
    <link rel="icon" href="{{asset('contents/backend')}}/favicon.ico" type="image/x-icon">
    <link href="{{asset('contents/backend')}}/google-fonts/css.css" rel="stylesheet">
    <link href="{{asset('contents/backend')}}/google-fonts/icon.css" rel="stylesheet">
    <link href="{{asset('contents/backend')}}/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="{{asset('contents/backend')}}/plugins/node-waves/waves.css" rel="stylesheet" />
    <link href="{{asset('contents/backend')}}/plugins/animate-css/animate.css" rel="stylesheet" />
    <link href="{{asset('contents/backend')}}/css/style.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="card">
            <div class="body">
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input id="email" type="email" placeholder="Email Address" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                        </div>
                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong class="col-pink">{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        </div>
                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="remember" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-block bg-pink waves-effect">
                                {{ __('SIGN IN') }}
                            </button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="{{url('register')}}">Register Now!</a>

                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="{{asset('contents/backend')}}/plugins/jquery/jquery.min.js"></script>
    <script src="{{asset('contents/backend')}}/plugins/bootstrap/js/bootstrap.js"></script>
    <script src="{{asset('contents/backend')}}/plugins/node-waves/waves.js"></script>
    <script src="{{asset('contents/backend')}}/plugins/jquery-validation/jquery.validate.js"></script>
    <script src="{{asset('contents/backend')}}/js/admin.js"></script>
    <script src="{{asset('contents/backend')}}/js/pages/examples/sign-in.js"></script>
</body>

</html>