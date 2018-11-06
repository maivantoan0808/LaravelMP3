@extends('frontend.layouts.app')

@section('title', $song->name)

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

        <div class="music-left">
            <!--/music-right-->
            <div class="tittle-head">
                <h4 class="">{{ $song->name }} - 
                    @foreach($song->users as $key => $user)
                        @if($key == 0)
                            <a class="singer" href="{{ route('singer.details', $user->username) }}">{{ $user->name }}</a>
                        @else
                            <a class="singer" href="{{ route('singer.details', $user->username) }}">, {{ $user->name }}</a>
                        @endif
                    @endforeach
                </h4>
                <div class="clearfix"> </div>
            </div>
            <div id="jp_container_1" class="jp-video " role="application" aria-label="media player">
                <div class="jp-type-single">
                    <div id="jquery_jplayer_1" class="jp-jplayer">
                        <video controls autoplay></video>
                    </div>
                    <div class="jp-gui">
                        <div class="jp-video-play">
                            <button class="jp-video-play-icon" role="button" tabindex="0">play</button>
                        </div>
                        <div class="jp-interface">
                            <div class="jp-progress">
                                <div class="jp-seek-bar">
                                    <div class="jp-play-bar"></div>
                                </div>
                            </div>
                            <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
                            <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
                            <div class="jp-controls-holder">
                                <div class="jp-controls">
                                    <button class="jp-play" role="button" tabindex="0">play</button>
                                    <button class="jp-stop" role="button" tabindex="0">stop</button>
                                </div>
                                <div class="jp-volume-controls">
                                    <button class="jp-mute" role="button" tabindex="0">mute</button>
                                    <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                                    <div class="jp-volume-bar">
                                        <div class="jp-volume-bar-value"></div>
                                    </div>
                                </div>
                                <div class="jp-toggles">
                                    <button class="jp-repeat" role="button" tabindex="0">repeat</button>
                                    <button class="jp-full-screen" role="button" tabindex="0">full screen</button>
                                </div>
                            </div>
                            <div class="jp-details">
                                <div class="jp-title" aria-label="title">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                    <div class="jp-no-solution">
                        <span>Update Required</span>
                        To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                    </div>
                </div>
            </div>
            <!-- script for player -->
            <link href="{{ asset('assets/frontend/css/jplayer.blue.monday.min.css') }}" rel="stylesheet" type="text/css">
            <script type="text/javascript" src="{{ asset('assets/frontend/js/jquery.jplayer.min.js') }}"></script>
            <script type="text/javascript">
            $(document).ready(function() {
                $("#jquery_jplayer_1").jPlayer({
                    ready: function() {
                        $(this).jPlayer("setMedia", {
                            title: "{{ $song->name }}",
                            ogv: "{{ Storage::disk('public')->url('song/normal/' . $song->normal_url) }}",
                            poster: "{{ asset('assets/frontend/images/load.jpg') }}"
                        }).jPlayer("play");
                    },

                    repeat: function(event) {
                        if(event.jPlayer.options.loop) {
                            $(this).unbind(".jPlayerRepeat").bind($.jPlayer.event.ended + ".jPlayer.jPlayerRepeat", function() {
                                $(this).jPlayer("play");
                                });
                        } else {
                            $(this).unbind(".jPlayerRepeat");
                        }
                    },
                    cssSelectorAncestor: "#jp_container_1",
                    swfPath: "/js",
                    supplied: "ogv",
                    useStateClassSkin: true,
                    autoBlur: false,
                    smoothPlayBar: true,
                    keyEnabled: true,
                    remainingDuration: true,
                    toggleDuration: true,
                    loop: true,
                });
            });
            </script>
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
                            <i class="fa fa-heart-o"></i> Like ({{ $song->count_like }})
                        </a>
                    </button>
                    @else
                        @if($song->isLike(Auth::id()))
                        <button class="btn btn-danger">
                            <a class="buttonn" href="javascript:void(0);" onclick="document.getElementById('unlike-song-form-{{ $song->id }}').submit();">
                                <i class="fa fa-heart"></i> Unlike ({{ $song->count_like }})
                            </a>
                            <form id="unlike-song-form-{{ $song->id }}" method="POST" action="{{ route('unlike.song', $song->id) }}" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </button>
                        @else
                        <button class="btn btn-dark">
                            <a class="buttonn" href="javascript:void(0);" onclick="document.getElementById('like-song-form-{{ $song->id }}').submit();">
                                <i class="fa fa-heart-o"></i> Like ({{ $song->count_like }})
                            </a>
                            <form id="like-song-form-{{ $song->id }}" method="POST" action="{{ route('like.song', $song->id) }}" style="display: none;">
                                @csrf
                            </form>
                        </button>
                        @endif
                    @endguest

                    @guest
                    <button class="btn btn-info">
                        <a class="buttonn" href="javascript:void(0);" onclick="toastr.info('Must login to add to playlist',
                            'Info',{
                                    closeButton: true,
                                    progressBar: true,
                                })">
                        <i class="fa fa-plus"></i> Add to playlist</a>
                    </button>
                    @else
                        @if(Auth::user()->playlists()->count() == 0)
                        <button class="btn btn-info">
                            <a class="buttonn" href="#" data-toggle="modal" data-target="#createNewPlaylist">
                                <i class="fa fa-plus"></i> Add to playlist
                            </a>
                        </button>
                        @include('frontend.layouts.partials.playlist.new_playlist')
                        @else
                        <button class="btn btn-info">
                            <a class="buttonn" href="#" data-toggle="modal" data-target="#addToPlaylist">
                                <i class="fa fa-plus"></i> Add to playlist
                            </a>
                        </button>
                        @include('frontend.layouts.partials.playlist.choose_playlist')
                        @endif
                    @endguest
                    <button class="btn btn-info">
                        <a class="buttonn" href="{{ route('download.normal', ['id'=>$song->id, 'file'=>$song->normal_url]) }}">
                            <i class="fa fa-download"></i> Download
                        </a>
                    </button>
                    <button class="btn btn-info"><a class="buttonn" href="https://www.facebook.com/sharer/sharer.php?u=laravelmp3.com/song/{{ $song->slug }}.html"><i class="fa fa-share"></i> Share</a></button>
                </div>
                <div class="col-md-2">
                    <a class="trend"><i class="fa fa-headphones">&nbsp; {{ $song->count_listen }}</i></a>
                </div>
            </div>
            <br>
            <br>
            <br>
            <hr>
            <div class="body">
                <h3 class="title">{{Lang::get('Lang.Lyrics')}}</h3>
                {!! $song->lyrics !!}
            </div>
            <hr>
            <div class="body">
                <h3 class="title">{{Lang::get('Lang.Comment')}}</h3>
                <form action="" method="POST" id="form_submit">
                    @csrf
                    @if(Auth::check())
                    <textarea rows="3" id="text_input" class="form-control" name="comment"></textarea>
                    <div align="right" style="margin-top: 5px">
                        <button id="submit" class="btn btn-danger">{{Lang::get('Lang.Send')}}</button>
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
        
        <div class="music-right">
            <div class="widget-side">
                <h3 class="widget-title">
                    <span class="new" style="text-align: center; font-size: 16px;">Hot Song</span>
                    <ul>
                        <br>
                        @foreach($songs as $songg)
                        @if($song->id != $songg->id)
                        <li>
                            <div class="song-img">
                                <a href="{{ route('song.details', $songg->slug) }}">
                                    <img class="img_song_of_singer" src="{{ Storage::disk('public')->url('song/image/' . $songg->image) }}" class="img-responsive" alt="" />
                                </a>
                            </div>
                            <div class="song-text">
                                <a href="{{ route('song.details', $songg->slug) }}" class="name_singer" style="font-size: 16px;">{{ $songg->name }}</a>
                                <div style="display: inline-flex;">
                                @foreach($songg->users as $key => $user)
                                    <a class="name_singer" style="font-size: 11px;" href="{{ route('singer.details', $user->username) }}">
                                        @if($key == 0)
                                        {{ $user->name }}
                                        @else
                                        , {{ $user->name }}
                                        @endif
                                    </a>
                                @endforeach
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        @endif
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
            console.log($('#form_submit').serialize());
            event.preventDefault();
            $.ajax({
                url: '/store-comment-song/{{$song->id}}',
                type: 'POST',
                data: $('form').serialize(),
                dataType: 'JSON',
            })
            .done(function(data){
                $('#comment').prepend(data.html);
                console.log("success");
                $('#text_input').val('');
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