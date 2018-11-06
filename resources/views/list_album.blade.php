@extends('frontend.layouts.app')

@section('title', 'All Albums')

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
                    <h3 class="tittle">{{Lang::get('Lang.All Albums')}} <span class="new">Hot</span></h3>
                    <div class="clearfix"> </div>
                </div>
                <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="all" aria-labelledby="all-tab">
                            <div class="browse-inner">
                                @foreach($albums as $album)
                                <div class="col-md-6 artist-grid">
                                    <a  href="{{ route('album.details', $album->slug) }}">
                                        <img src="{{ Storage::disk('public')->url('album/image/' . $album->image) }}" title="{{ $album->slug }}" style="height: 120px;">
                                    </a>
                                    <a class="art" href="{{ route('album.details', $album->slug) }}">{{ $album->name }}
                                    </a>
                                    <a class="name_album" href="{{ route('singer.details', $album->user->username) }}">{{ str_limit($album->user->name, '15') }}</a>
                                </div>
                                @endforeach
                                <div class="clearfix"> </div>
                                <div style="text-align: center;">
                                    {{ $albums->links() }}
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
