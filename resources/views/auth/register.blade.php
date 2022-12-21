
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{ __('Register') }}</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="{{asset('contents/backend')}}/google-fonts/css.css" rel="stylesheet">
    <link href="{{asset('contents/backend')}}/google-fonts/icon.css" rel="stylesheet">
    <link href="{{asset('contents/backend')}}/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="{{asset('contents/backend')}}/plugins/node-waves/waves.css" rel="stylesheet" />
    <link href="{{asset('contents/backend')}}/plugins/animate-css/animate.css" rel="stylesheet" />
    <link href="{{asset('contents/backend')}}/css/style.css" rel="stylesheet">
</head>

<body class="signup-page">
    <div class="signup-box">
        <div class="card">
            <div class="body">
            <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                @csrf

                    <div class="msg">Register a new membership</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input id="name" placeholder="Type Your Name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                        </div>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input id="email" placeholder="Type Your Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
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
                            <input id="password" placeholder="Type Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        </div>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong class="col-pink">{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-lg bg-pink waves-effect">
                                    {{ __('Register') }}
                                </button>
                    <div class="m-t-25 m-b--5 align-center">
                        <a href="{{url('login')}}">You already have an account?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{asset('contents/backend')}}/plugins/jquery/jquery.min.js"></script>
    <script src="{{asset('contents/backend')}}/plugins/bootstrap/js/bootstrap.js"></script>
    <script src="{{asset('contents/backend')}}/plugins/node-waves/waves.js"></script>
    <script src="{{asset('contents/backend')}}/plugins/jquery-validation/jquery.validate.js"></script>
    <script src="{{asset('contents/backend')}}/js/admin.js"></script>
    <script src="{{asset('contents/backend')}}/js/pages/examples/sign-up.js"></script>
</body>

</html>
