@extends('auth.layouts.app')

@section('title','Register')

@push('css')
@endpush

@section('content')
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
                    <input id="name" type="text" placeholder="Name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">person</i>
                </span>
                <div class="form-line">
                    <input id="username" type="text" placeholder="Username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">email</i>
                </span>
                <div class="form-line">
                    <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
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
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">lock</i>
                </span>
                <div class="form-line">
                    <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required>
                </div>
            </div>
            <div class="form-group">
                <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                <label for="terms">I read and agree to the <a href="javascript:void(0);">terms of usage</a>.</label>
            </div>

            <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">SIGN UP</button>

            <div class="m-t-25 m-b--5 align-center">
                <a href="{{ route('login') }}">You already have a membership?</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('assets/auth/js/sign-up.js') }}"></script>
@endpush
