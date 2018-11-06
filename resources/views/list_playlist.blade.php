@extends('frontend.layouts.app')

@section('title', 'My Playlists')

@push('css')
<!-- pop-up-box -->
<link href="{{ asset('assets/frontend/css/popuo-box.css') }}" rel="stylesheet" type="text/css" media="all">
@endpush

@section('content')
<div id="page-wrapper">
    <div class="inner-content single">
        <div class="music-browse">
            <div>
                <button class="btn btn-info">
                    <a class="buttonn" href="#" data-toggle="modal" data-target="#createNewEmptyPlaylist"><i class="fa fa-plus"></i> Create New Playlist </a>
                </button>
                <div class="modal fade" id="createNewEmptyPlaylist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog facebook" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('myplaylist.store.new', Auth::user()->username) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label class="form-label">Playlist Title</label>
                                            <input type="text" id="name" class="form-control" name="name">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success m-t-15 waves-effect">SUBMIT</button>
                                    <button type="button" class="btn btn-danger m-t-15 waves-effect" data-dismiss="modal">CLOSE</button
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--albums-->
            <!--//pop-up-box -->
            <div class="browse">
                <div class="tittle-head two">
                    <h3 class="tittle">All Playlists </h3>
                    <div class="clearfix"> </div>
                </div>
                <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="all" aria-labelledby="all-tab">
                            <div class="browse-inner">
                                @foreach($playlists as $playlist)
                                <div class="col-md-6 artist-grid">
                                    <a  href="{{ route('myplaylist.show', ['username'=>Auth::user()->username,'slug'=>$playlist->slug]) }}">
                                        <img src="{{ Storage::disk('public')->url('playlist/image/' . $playlist->image) }}" title="{{ $playlist->slug }}" style="height: 120px;">
                                    </a>
                                    <a class="art" href="{{ route('myplaylist.show', ['username'=>Auth::user()->username,'slug'=>$playlist->slug]) }}">{{ str_limit($playlist->name, '15') }}
                                    </a>
                                </div>
                                @endforeach
                                <div class="clearfix"> </div>
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
