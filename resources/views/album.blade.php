@extends('frontend.layouts.app')

@section('title', $album->name)

@push('css')
<style>
    #jquery_jplayer_1>img{
        width: 100% !important;
        height: 270px; 
        display: block !important;
    }
</style>
@endpush

@section('content')

<div id="page-wrapper">
    <div class="inner-content single">

        <div class="col-md-8">
            <!--/music-right-->
            <div class="tittle-head">
                <h3 class="">{{ $album->name }} - 
                    <a class="singer_album" href="{{ route('singer.details', $album->user->username) }}">{{ $album->user->name }}</a>
                </h3>
                <div class="clearfix"> </div>
            </div>
            <div id="jp_container_1" class="jp-video" role="application" aria-label="media player">
                <div class="jp-type-playlist">
                    <div id="jquery_jplayer_1" class="jp-jplayer" style="width: 480px; height: 270px;">
                        <img id="jp_poster_0" src="{{ asset('assets/frontend/images/load.jpg') }}">
                        <video id="jp_video_0" preload="metadata" allow="autoplay" src="" title="1. Ellie-Goulding" style="width: 0px; height: 0px;">
                        </video>
                    </div>
                    <div class="jp-gui">
                        <div class="jp-video-play" style="display: block;">
                            <button class="jp-video-play-icon" role="button" tabindex="0">play</button>
                        </div>
                        <div class="jp-interface">
                            <div class="jp-progress">
                                <div class="jp-seek-bar" style="width: 100%;">
                                    <div class="jp-play-bar" style="width: 0%;"></div>
                                </div>
                            </div>
                            <div class="jp-current-time" role="timer" aria-label="time"></div>
                            <div class="jp-duration" role="timer" aria-label="duration"></div>
                            <div class="jp-controls-holder">
                                <div class="jp-controls">
                                    <button class="jp-previous" role="button" tabindex="0">previous</button>
                                    <button class="jp-play" role="button" tabindex="0">play</button>
                                </div>
                                <div class="jp-volume-controls">
                                    <button class="jp-mute" role="button" tabindex="0">mute</button>
                                    <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                                    <div class="jp-volume-bar">
                                        <div class="jp-volume-bar-value" style="width: 100%;"></div>
                                    </div>
                                </div>
                                <div class="jp-toggles">
                                    <button class="jp-full-screen" role="button" tabindex="0">full screen</button>
                                </div>
                            </div>
                            <div class="jp-details" style="display: none;">
                                <div class="jp-title" aria-label="title"></div>
                            </div>
                        </div>
                    </div>
                    <div class="jp-playlist">
                        <ul style="display: block;">
                            <li class="jp-playlist-current">
                                <div>
                                    <a href="javascript:;" class="jp-playlist-item-remove" style="display: none;">×</a>
                                    <a href="javascript:;" class="jp-playlist-item jp-playlist-current" tabindex="0">
                                        <span class="jp-artist"></span>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <a href="javascript:;" class="jp-playlist-item-remove" style="display: none;">×</a>
                                    <a href="javascript:;" class="jp-playlist-item" tabindex="0">
                                        <span class="jp-artist"></span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="jp-no-solution" style="display: none;">
                        <span>Update Required</span>
                        To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                    </div>
                </div>
            </div>
            <!-- script for player -->
            <link href="{{ asset('assets/frontend/css/jplayer.blue.monday.min.css') }}" rel="stylesheet" type="text/css">
            <script type="text/javascript" src="{{ asset('assets/frontend/js/jquery.jplayer.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('assets/frontend/js/jplayer.playlist.min.js') }}"></script>
            <script type="text/javascript">
                //<![CDATA[
                $(document).ready(function(){
                    new jPlayerPlaylist({
                        jPlayer: "#jquery_jplayer_1",
                        cssSelectorAncestor: "#jp_container_1"
                    }, [
                    @foreach($songs as $song)
                    {
                        title:"{{ $song->name }}",
                        artist:"",
                        mp4: "{{ Storage::disk('public')->url('song/normal/' . $song->normal_url) }}",
                        ogv: "{{ Storage::disk('public')->url('song/normal/' . $song->normal_url) }}",
                        webmv: "{{ Storage::disk('public')->url('song/normal/' . $song->normal_url) }}",
                        poster:"{{ asset('assets/frontend/images/load.jpg') }}"
                    },
                    @endforeach
                    ], 
                    {
                        playlistOptions: {
                            "autoPlay":  true
                        },
                        swfPath: "../../dist/jplayer",
                        supplied: "webmv,ogv,mp4",
                        useStateClassSkin: true,
                        autoBlur: false,
                        smoothPlayBar: true,
                        keyEnabled: true
                    });
                });
            //]]>
            </script>
            <!-- //script for play-list -->
            <br>
            <br>
            <div class="body">
                <div class="col-md-10">
                    @guest
                    <button class="btn btn-dark">
                        <a class="buttonn" href="javascript:void(0);" onclick="toastr.info('Must login to like',
                            'Info',{
                                closeButton: true,
                                progressBar: true,
                            })">
                            <i class="fa fa-heart-o"></i> Like ({{ $album->count_like }})
                        </a>
                    </button>
                    @else
                        @if($album->isLike(Auth::id()))
                        <button class="btn btn-danger">
                            <a class="buttonn" href="javascript:void(0);" onclick="document.getElementById('unlike-album-form-{{ $album->id }}').submit();">
                                <i class="fa fa-heart"></i> Unlike ({{ $album->count_like }})
                            </a>
                            <form id="unlike-album-form-{{ $album->id }}" method="POST" action="{{ route('unlike.album', $album->id) }}" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </button>
                        @else
                        <button class="btn btn-dark">
                            <a class="buttonn" href="javascript:void(0);" onclick="document.getElementById('like-album-form-{{ $album->id }}').submit();">
                                <i class="fa fa-heart-o"></i> Like ({{ $album->count_like }})
                            </a>
                            <form id="like-album-form-{{ $album->id }}" method="POST" action="{{ route('like.album', $album->id) }}" style="display: none;">
                                @csrf
                            </form>
                        </button>
                        @endif
                    @endguest

                    <button class="btn btn-info"><a class="buttonn" href=""><i class="fa fa-download"></i> Download</a></button>
                    <button class="btn btn-info"><a class="buttonn" href="https://www.facebook.com/sharer/sharer.php?u=laravelmp3.com/album/{{ $album->slug }}.html"><i class="fa fa-share"></i> Share</a></button>
                </div>
                <div class="col-md-2">
                    <a class="trend"><i class="fa fa-headphones">&nbsp; {{ $album->count_listen }}</i></a>
                </div>
            </div>
            <br>
            <br>
            <br>
            <hr>
            <div class="body">
                <h3 class="title">{{ Lang::get('Lang.Send') }}</h3>
                {!! $album->description !!}
            </div>
            <hr>
            <div class="body">
                <h3 class="title">{{ Lang::get('Lang.Comment') }}</h3>
                <form action="" method="POST" id="comment_album">
                    @csrf
                    @if(Auth::check())
                    <textarea rows="3" id="cmt_album" class="form-control" name="comment"></textarea>
                    <div align="right" style="margin-top: 5px">
                        <button id="submit" class="btn btn-danger">{{ Lang::get('Lang.Send') }}</button>
                    </div>
                    @else
                    <h4 class="">(You Need Login To Comment)</h4>
                    @endif
                </form>
                <hr>
                <div id="result"></div>
                <div id="comment">
                    @include('frontend.layouts.partials.comment.comments')
                </div>
            </div>
        </div>
        <!--//video-main-->
        
        <div class="col-md-4">
            <div class="widget-side">
                <h3 class="widget-title">
                    <span class="new" style="text-align: center; font-size: 16px;">Hot Album</span>
                    <ul>
                        <br>
                        @foreach($albums as $albumm)
                        <li>
                            <div class="song-img">
                                <a href="{{ route('album.details', $albumm->slug) }}">
                                    <img class="img_song_of_singer" src="{{ Storage::disk('public')->url('album/image/' . $albumm->image) }}" class="img-responsive" alt="" />
                                </a>
                            </div>
                            <div class="song-text">
                                <a href="{{ route('album.details', $albumm->slug) }}" class="name_singer" style="font-size: 16px;">{{ $albumm->name }}</a>
                                <a class="name_singer" style="font-size: 11px;" href="{{ route('singer.details', $albumm->user->username) }}">{{ $albumm->user->name }}</a>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        @endforeach
                    </ul>
                </h3>
                <div class="clearfix"> </div>
            </div>
        </div>

        <!-- /agileits -->
        <div class="clearfix"> </div>
    </div>
</div>
<div class="clearfix"></div>

@endsection

@push('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('#submit').click(function(event){
            console.log($('#comment_album').serialize());
            event.preventDefault();
            $.ajax({
                url: '/store-comment-album/{{$album->id}}',
                type: 'POST',
                data: $('form').serialize(),
                dataType: 'JSON',
            })
            .done(function(data){
                $('#comment').prepend(data.html);
                console.log("success");
                $('#cmt_album').val('');
            })
            .fail(function(){
                console.log("error");
            })
            .always(function(){
                console.log("complete");
            })
        });
    });
</script>
@endpush