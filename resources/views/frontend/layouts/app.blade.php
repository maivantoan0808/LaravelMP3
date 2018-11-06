<!DOCTYPE HTML>
<html>
<head>
<title>@yield('title') - LaravelMP3</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="LaravelMP3" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="{{ asset('assets/frontend/css/bootstrap.css') }}" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="{{ asset('assets/frontend/css/style.css') }}" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="{{ asset('assets/frontend/css/font-awesome.css') }}" rel="stylesheet"> 
<!-- jQuery -->
<!-- lined-icons -->
<link rel="stylesheet" href="{{ asset('assets/frontend/css/icon-font.css') }}" type='text/css' />
<!-- //lined-icons -->
 <!-- Meters graphs -->
<script src="{{ asset('assets/frontend/js/jquery-2.1.4.js') }}"></script>
<!--audio-->
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/frontend/css/audio.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/custom.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@stack('css')
</head> 
<!-- /w3layouts-agile -->
<body class="sticky-header left-side-collapsed">
    <section>
        <!-- left side start-->
        <div class="left-side sticky-left-side">
            <!--logo and iconic logo start-->
            <div class="logo">
                <h1><a href="/">LaravelMP3</a></h1>
            </div>
            <div class="logo-icon text-center">
                <a href="/">M</a>
            </div>
            <!--logo and iconic logo end-->
            @include('frontend.layouts.partials.sidebar')
        </div>

        <div class="main-content">
            @include('frontend.layouts.partials.header')
            
            @yield('content')

            @include('frontend.layouts.partials.footer')
        </div>


    
    <footer>
       <p>&copy 2018 LaravelMP3. All Rights Reserved | Design by ToanMV & ThanhBG</p>
    </footer>
    </section>
    <script type="text/javascript" src="{{ asset('assets/frontend/js/jquery.form.js') }}" ></script>
    <script src="{{ asset('assets/frontend/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/scripts.js') }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('assets/frontend/js/bootstrap.js') }}"></script>
    <!---->
    <script type="text/javascript">
        $(function(){
            $('#audio-player').mediaelementplayer({
                alwaysShowControls: true,
                features: ['playpause','progress','volume'],
                audioVolume: 'horizontal',
                iPadUseNativeControls: true,
                iPhoneUseNativeControls: true,
                AndroidUseNativeControls: true
            });
        });
    </script>
    <script type="text/javascript" src="{{ asset('assets/frontend/js/mediaelement-and-player.min.js') }}">
    </script>
    
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
    @stack('js')
    <!---->
</body>
</html>