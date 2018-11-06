@extends('frontend.layouts.app')

@section('title', 'All Artists')

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
                    <h3 class="tittle">{{Lang::get('Lang.All Artists')}} <span class="new">Hot</span></h3>
                    <div class="clearfix"> </div>
                </div>
                <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="all" aria-labelledby="all-tab">
                            <div class="browse-inner">
                                @foreach($singers as $singer)
                                <div class="col-md-6 artist-grid">
                                    <a  href="{{ route('singer.details', $singer->username) }}">
                                        <img src="{{ Storage::disk('public')->url('profile/singer/' . $singer->image) }}" title="{{ $singer->username }}" style="width: 99%; height: 150px;">
                                    </a>
                                    <a class="art" href="{{ route('singer.details', $singer->username) }}">{{ $singer->name }}
                                    </a>
                                </div>
                                @endforeach
                                <div class="clearfix"> </div>
                                <div style="text-align: center;">
                                    {{ $singers->links() }}
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
