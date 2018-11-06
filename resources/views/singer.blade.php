@extends('frontend.layouts.app')

@section('title', $singer->name)

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
@endpush

@section('content')

<div id="page-wrapper">
    <div class="inner-content">
        <!-- /blog -->
        <div class="tittle-head">
            <h3 class="tittle">{{ $singer->name }} </h3>
            <div class="clearfix"> </div>
        </div>
        <!-- /music-left -->
        <div class="music-left">
            <div class="post-media">
                <a href="{{ route('singer.details', $singer->username) }}">
                    <img src="{{ Storage::disk('public')->url('profile/singer/' . $singer->image) }}" style="width: 100%; height: 400px;" class="img-responsive" alt="" />
                </a>
                <div class="blog-text">
                    <div class="entry-meta">
                        <h6 class="blg"><i class="fa fa-user-md" aria-hidden="true"></i> {{ date('D, d M Y', strtotime($singer->birthday )) }}</h6>
                        <div class="icons">
                            @guest
                            <a href="javascript:void(0);" onclick="toastr.info('Please login to follow artist',
                                'Info',{
                                    closeButton: true,
                                    progressBar: true,
                                })">
                                <i class="fa fa-rss"></i> {{Lang::get('Lang.Follow')}} ({{ $singer->count_followers }})</a>
                            @else
                                @if(Auth::user()->isFollowing($singer->id))
                                <a href="javascript:void(0);" class="follow" onclick="document.getElementById('follow-form-{{ $singer->id }}').submit();">
                                    <i class="fa fa-rss"></i> Unfollow ({{ $singer->count_followers }})</a>
                                <form id="follow-form-{{ $singer->id }}" method="POST" action="{{ route('unfollow', $singer) }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @else
                                <a href="javascript:void(0);" class="" onclick="document.getElementById('unfollow-form-{{ $singer->id }}').submit();">
                                    <i class="fa fa-rss"></i> Follow ({{ $singer->count_followers }})</a>
                                <form id="unfollow-form-{{ $singer->id }}" method="POST" action="{{ route('follow', $singer) }}" style="display: none;">
                                    @csrf
                                </form>
                                @endif
                            @endguest
                        </div>
                        <div class="clearfix"></div>
                        <p>{!! $singer->about !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- //music-left-->
        <!-- /music-right-->
        <div class="music-right">
            <!-- //widget -->
            <div class="widget-side">
                <h4 class="widget-title">{{Lang::get('Lang.Similar Artists')}}</h4>
                <ul>
                    @foreach($singers as $sg)
                        @if($singer->username != $sg->username)
                        <li>
                            <div class="song-img">
                                <a href="{{ route('singer.details', $sg->username) }}">
                                    <img class="img_song_of_singer" src="{{ Storage::disk('public')->url('profile/singer/' . $sg->image) }}" class="img-responsive" alt="" />
                                </a>
                            </div>
                            <div class="song-text">
                                <a href="{{ route('singer.details', $sg->username) }}">{{ $sg->name }}</a>
                                <span class="post-date">{{Lang::get('Lang.Follow')}}: {{ $sg->count_followers }}</span>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="widget-side second">
                <h4 class="widget-title"><a class="singer_dump" href="{{ route('album.of.singer', $singer->username ) }}">{{Lang::get('Lang.Albums')}}</a></h4>
                <ul>
                    @foreach($albums as $album)
                    <li>
                        <div class="song-img">
                            <a href="{{ route('album.details', $album->slug) }}">
                                <img class="img_song_of_singer" src="{{ Storage::disk('public')->url('album/image/' . $album->image) }}" class="img-responsive" alt="" />
                            </a>
                        </div>
                        <div class="song-text">
                            <a href="{{ route('album.details', $album->slug) }}">{{ $album->name }}</a>
                            <span class="post-date">{{ $album->created_at->toFormattedDateString() }}</span>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="widget-side second">
                <h4 class="widget-title"><a class="singer_dump" href="{{ route('song.of.singer', $singer->username ) }}"> {{Lang::get('Lang.Songs')}}</a></h4>
                <ul>
                    @foreach($songs as $song)
                    <li>
                        <div class="song-img">
                            <a href="{{ route('song.details', $song->slug) }}">
                                <img class="img_song_of_singer" src="{{ Storage::disk('public')->url('song/image/' . $song->image) }}" class="img-responsive" alt="" />
                            </a>
                        </div>
                        <div class="song-text">
                            <a href="{{ route('song.details', $song->slug) }}">{{ $song->name }}</a>
                            <span class="post-date">{{ $song->created_at->toFormattedDateString() }}</span>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-- //widget -->
        </div>
        <div class="clearfix"></div>
        <!-- //blog -->
    </div>
    <div class="clearfix"></div>
    <!--body wrapper end-->
    <!-- /w3l-agile -->
</div>

@endsection

@push('js')

@endpush