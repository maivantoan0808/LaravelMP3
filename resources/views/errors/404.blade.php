@extends('frontend.layouts.app')

@section('title', 'Page not found')

@push('css')
@endpush

@section('content')

<div id="page-wrapper">
    <div class="inner-content">
            <!-- /error_page -->
        <div class="error-top">
            <img src="assets/frontend//images/pic_error.png" alt="" />
            <h3>Page Not Found...<h3>
            <div class="clearfix"></div>
                
            <div class="error">
                <a class="not" href="{{ route('home') }}">Back To Home</a>
            </div>

            <!-- //error_page -->
        </div>
        
    <div class="clearfix"></div>
<!--body wrapper end-->
</div>  

@endsection

@push('js')

@endpush