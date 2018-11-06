<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>@yield('title') | Laravel MP3 - Material Design</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('assets/auth/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('assets/auth/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('assets/auth/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Font Awesome Css -->
    <link href="{{ asset('assets/auth/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Custom Css -->
    <link href="{{ asset('assets/auth/css/style.css') }}" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stack('css')
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Laravel<b>MP3</b></a>
            <small>LaravelMP3 - Material Design</small>
        </div>
        @yield('content')
    </div>

    <!-- Jquery Core Js -->
    <script src="{{ asset('assets/auth/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('assets/auth/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('assets/auth/plugins/node-waves/waves.js') }}"></script>

    <!-- Validation Plugin Js -->
    <script src="{{ asset('assets/auth/plugins/jquery-validation/jquery.validate.js') }}"></script>
    
    @stack('js')
    <!-- Custom Js -->
    <script src="{{ asset('assets/auth/js/admin.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script>
    @if($errors->any())
        @foreach($errors->all() as $error)
            toastr.error('{{ $error }}','Error',{
                closeButton:true,
                progressBar:true,
            });
        @endforeach
    @endif
    </script>
</body>
</html>
