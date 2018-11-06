@extends('auth.layouts.app')

@section('title','Login')

@push('css')
@endpush

@section('content')
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
                    <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">lock</i>
                </span>
                <div class="form-line">
                    <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-8 p-t-5">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="rememberme">Remember Me</label>
                </div>
                <div class="col-xs-4">
                    <button class="btn btn-block bg-pink waves-effect" type="submit">{{ __('Login') }}</button>
                </div>
            </div>
            <div>
                <a href="{{ url('/auth/github') }}" class="btn bg-green waves-effect"><i class="fa fa-github" aria-hidden="true"></i> Github</a>
                <a href="{{ url('/auth/facebook') }}" class="btn bg-blue waves-effect"><i class="fa fa-facebook-official"></i> Facebook</a>
                <a href="{{ url('/auth/google') }}" class="btn bg-red waves-effect"><i class="fa fa-google"></i> Google</a>
            </div>
            <div class="row m-t-15 m-b--20">
                <div class="col-xs-6">
                    <a href="{{ route('register') }}">Register Now!</a>
                </div>
                <div class="col-xs-6 align-right">
                    <a href="{{ route('password.request') }}">Forgot Password?</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('assets/auth/js/sign-in.js') }}"></script>
@endpush
