@extends('frontend.layouts.app')

@section('title', 'HomePage')

@push('css')
<style>
    #jquery_jplayer_1>img{
        width: 100% !important;
        display: block !important;
    }
</style>
@endpush

@section('content')

<div id="page-wrapper">
    <div class="inner-content">
        @include('frontend.layouts.partials.home.musicleft')
        @include('frontend.layouts.partials.home.musicright')
        <div class="clearfix"></div>
        <!-- /w3l-agile-its -->
    </div>
    @include('frontend.layouts.partials.home.review')
</div>
<div class="clearfix"></div>

@endsection

@push('js')

@endpush