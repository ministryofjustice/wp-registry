@extends('layouts.login')

@section('content')
<div class="container">
    <div class="login-box">
        <div class="panel panel-default">
            <div class="panel-heading">Login</div>
            <div class="panel-body{{ $errors->has('socialite') ? ' has-error' : '' }}">
                <p>Please sign in with your MOJ Digital account.</p>
                <a href="{{ route('login.google') }}" class="btn btn-lg btn-block btn-social btn-google">
                    <span class="fa fa-google"></span> Sign in with Google
                </a>
                @if ($errors->has('socialite'))
                    <p>
                        <span class="help-block">
                            <strong>{{ $errors->first('socialite') }}</strong>
                        </span>
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
