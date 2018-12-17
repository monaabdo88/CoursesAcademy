<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Courses Academy</title>

    <!-- Styles -->
    <link href="{{asset('assets/css/core.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/thesaas.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

</head>

<body class="mh-fullscreen bg-img center-vh p-20" style="background-image: url(assets/img/bg-girl.jpg);">




<div class="card card-shadowed p-50 w-400 mb-0" style="max-width: 100%">
    <h5 class="text-uppercase text-center">Register</h5>
    <br><br>

    <form class="form-type-material" method="POST" action="{{ route('register') }}">
        {{csrf_field()}}
        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <input type="text" name="name" class="form-control" placeholder="Username">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group  {{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="email" class="form-control" name="email" placeholder="Email address">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group   {{ $errors->has('password') ? ' has-error' : '' }}">
            <input type="password" name="password" class="form-control" placeholder="Password">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <input type="password" class="form-control" name="password_confirmation" placeholder="Password (confirm)">
        </div>

        <div class="form-group">
            <label class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="check" required>
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">I agree to all <a class="text-primary" href="#">terms</a></span>
            </label>
        </div>

        <br>
        <button class="btn btn-bold btn-block btn-primary" type="submit">Register</button>
    </form>

    <hr class="w-30">

    <p class="text-center text-muted fs-13 mt-20">Already have an account? <a href="page-login.html">Sign in</a></p>
</div>




<!-- Scripts -->
<script src="{{asset('assets/js/core.min.js')}}"></script>
<script src="{{asset('assets/js/thesaas.min.js')}}"></script>
<script src="{{asset('assets/js/script.js')}}"></script>

</body>
</html>
