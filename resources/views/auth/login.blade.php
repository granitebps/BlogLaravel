@extends('layouts.login_register')

@section('content')

<div class="login-panel panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Please Sign In</h3>
    </div>
    <div class="panel-body">
        <form role="form" action="{{ route('login') }}" method="POST">
            @csrf
            <fieldset>
                <div class="form-group">
                    <input placeholder="Email" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input placeholder="Password" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="checkbox">
                    <label>
                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                    </label>
                </div>
                <!-- Change this to a button or input when using this as a form -->
                <button class="btn btn-lg btn-success btn-block">Login</button><br>
                <a class="text-center" href="{{route('home.welcome')}}">Go To Web</a>
            </fieldset>
        </form>
    </div>
</div>

@endsection