@extends('auth.layouts.app')

@section('title','Reset Password')

@push('css')
@endpush

@section('content')
<div class="card">
    <div class="body">
        <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">person</i>
                </span>
                <div class="form-line">
                    <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>
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

            <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Reset Password</button>
        </form>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('assets/auth/js/sign-in.js') }}"></script>
@endpush
