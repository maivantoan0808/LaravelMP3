@extends('auth.layouts.app')

@section('title','Reset Password')

@push('css')
@endpush

@section('content')
<div class="card">
    <div class="body">
        <form id="forgot_password" method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
            @csrf

            <div class="msg">
                Enter your email address that you used to register. We'll send you an email with your username and a
                link to reset your password.
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">email</i>
                </span>
                <div class="form-line">
                    <input id="email" type="email" placeholder=" Enter Your Email To Reset Password" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                </div>
            </div>

            <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">RESET MY PASSWORD</button>
        </form>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('assets/auth/js/sign-in.js') }}"></script>
@endpush
