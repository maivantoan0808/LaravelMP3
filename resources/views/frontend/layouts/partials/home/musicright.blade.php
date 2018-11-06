<div class="music-right">
    <!--/video-main-->
    <div class="video-main">
        <div class="video-record-list">
            <div id="jp_container_1" class="jp-video jp-video-270p" role="application" aria-label="media player">
                <div class="jp-type-playlist">
                    <div class="tittle-head" style="text-align: center;">
                        <h1>
                            <span class="new" style="font-size: 1.48em;">TOP 10 SONGS</span>
                        </h1>
                    </div>
                    <div id="jquery_jplayer_1" class="jp-jplayer" style="width: 480px; height: 270px;">
                        <img id="jp_poster_0" src="{{ asset('assets/frontend/video/default.jpg') }}" style="width: 100% !important; height: 270px; display: inline;">
                        <video id="jp_video_0" preload="metadata" src="{{ asset('assets/frontend/media/Con-Yeu-Dau-Ai-Roi-Di-Duc-Phuc.mp3') }}" title="1. Ellie-Goulding" style="width: 0px; height: 0px;">
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
        </div>
    </div>
    <!-- script for play-list -->
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
                poster:"{{ asset('assets/frontend/video/default.jpg') }}"
            },
            @endforeach
            ], 
            {
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

    <!--//video-main-->
    <!--/app_store-->
    <div class="apps">
        <h3 class="hd-tittle">LaravelMP3 now available in</h3>
        <div class="banner-button">
            <a href="#"><img src="{{ asset('assets/frontend/images/1.png') }}" alt=""></a>
        </div>
        <div class="banner-button green-button">
            <a href="#"><img src="{{ asset('assets/frontend/images/2.png') }}" alt=""></a>
        </div>
        <div class="clearfix"></div>
    </div>
    <!--//app_store-->
    <!--/start-paricing-tables-->
    <div class="price-section">
        <div class="pricing-inner">
            <h3 class="hd-tittle">Upgrade your Plan</h3>
            <div class="pricing">
                <div class="price-top">
                    <h3><span>$20</span></h3>
                    <h4>per year</h4>
                </div>
                <div class="price-bottom">
                    <ul>
                        <li>
                            <a class="icon" href="#">
                                <i class="glyphicon glyphicon-ok"></i>
                            </a>
                            <a class="text" href="#">Download unlimited songs</a>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <a class="icon" href="#">
                                <i class="glyphicon glyphicon-ok"></i>
                            </a>
                            <a class="text" href="#">Stream songs in High Definition</a>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <a class="icon" href="#">
                                <i class="glyphicon glyphicon-ok"></i>
                            </a>
                            <a class="text" href="#">No ads unlimited Devices</a>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <a class="icon" href="#">
                                <i class="glyphicon glyphicon-ok"></i>
                            </a>
                            <a class="text" href="#">Stream songs in High Definition</a>
                            <div class="clearfix"></div>
                        </li>
                    </ul>
                    <a href="#" class="price">Upgrade</a>
                </div>
            </div>
            <div class="pricing two">
                <div class="price-top">
                    <h3><span>$30</span></h3>
                    <h4>per year</h4>
                </div>
                <div class="price-bottom">
                    <ul>
                        <li>
                            <a class="icon" href="#">
                                <i class="glyphicon glyphicon-ok"></i>
                            </a>
                            <a class="text" href="#">Download unlimited songs</a>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <a class="icon" href="#">
                                <i class="glyphicon glyphicon-ok"></i>
                            </a>
                            <a class="text" href="#">Stream songs in High Definition</a>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <a class="icon" href="#">
                                <i class="glyphicon glyphicon-ok"></i>
                            </a>
                            <a class="text" href="#">No ads unlimited Devices</a>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <a class="icon" href="#">
                                <i class="glyphicon glyphicon-ok"></i>
                            </a>
                            <a class="text" href="#">Stream songs in High Definition</a>
                            <div class="clearfix"></div>
                        </li>
                    </ul>
                    <a href="#" class="price">Upgrade</a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    <!--//end-pricing-tables-->
    </div>
</div>
<!--//music-right-->