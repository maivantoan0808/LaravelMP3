@extends('frontend.layouts.app')

@section('title', 'All Songs')

@push('css')
<!-- pop-up-box -->
<link href="{{ asset('assets/frontend/css/popuo-box.css') }}" rel="stylesheet" type="text/css" media="all">
@endpush

@section('content')
<div id="page-wrapper">
    <div class="inner-content single">
        <div class="music-browse">
            <!--albums-->
            <!--//pop-up-box -->
            <div class="browse">
                <div class="tittle-head two">
                    <h3 class="tittle">All Songs <span class="new">New</span></h3>
                    <div class="clearfix"> </div>
                </div>
                <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs" role="tablist">
                        <li role="presentation">
                            <a href="{{ route('song.list.all') }}" aria-controls="all" aria-expanded="true">All</a>
                        </li>
                        @foreach($categories as $cate)
                        <li role="presentation" class="{{ Request::is('song/list/'. $cate->slug) ? 'active' : '' }}">
                            <a href="{{ route('song.list.by.category', $cate->slug) }}" aria-controls="profile" aria-expanded="false">{{ $cate->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" aria-labelledby="all-tab">
                            <div class="browse-inner">
                                @foreach($songs as $song)
                                <div class="col-md-3 artist-grid">
                                    <a  href="{{ route('song.details', $song->slug) }}">
                                        <img src="{{ Storage::disk('public')->url('song/image/' . $song->image) }}" title="{{ $song->slug }}" style="height: 120px;">
                                    </a>
                                    <a class="art" href="{{ route('song.details', $song->slug) }}">{{ str_limit($song->name, '15') }}
                                    </a>
                                </div>
                                @endforeach
                                <div class="clearfix"> </div>
                                <div style="text-align: center;">
                                    {{ $songs->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /agileinfo -->
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
@endsection

@push('js')
<script src="{{ asset('assets/frontend/js/jquery.magnific-popup.js') }}" type="text/javascript"></script>
<script>
$(document).ready(function() {
    $('.popup-with-zoom-anim').magnificPopup({
        type: 'inline',
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in'
    });
});

</script>
@endpush
