<div class="music-left">
    <!--banner-section-->
    <div class="banner-section">
        <div class="banner">
            <div class="callbacks_container">
                <ul class="rslides callbacks callbacks1" id="slider4">
                    @foreach($slideTopSongs as $song)
                    <li>
                        <div class="banner-img">
                            <a href="{{ route('song.details', $song->slug) }}" title="{{ $song->name }}">
                            <img src="{{ Storage::disk('public')->url('song/image/' . $song->image) }}" class="img-responsive" alt="">
                            </a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!--banner-->
            <script src="{{ asset('assets/frontend/js/responsiveslides.min.js') }}"></script>
            <script>
                // You can also use "$(window).load(function() {"
                $(function () {
                    // Slideshow 4
                    $("#slider4").responsiveSlides({
                        auto: true,
                        pager:true,
                        nav:true,
                        speed: 500,
                        namespace: "callbacks",
                        before: function () {
                          $('.events').append("<li>before event fired.</li>");
                        },
                        after: function () {
                          $('.events').append("<li>after event fired.</li>");
                        }
                    });
                });
            </script>
            <div class="clearfix"></div>
        </div>
    </div>  
    <!--//End-banner-->
    <!--albums-->
    <!-- pop-up-box --> 
    <link href="{{ asset('assets/frontend/css/popuo-box.css') }}" rel="stylesheet" type="text/css" media="all">
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
    <!--//pop-up-box -->
    <div class="albums">
        <div class="tittle-head">
            <h3 class="tittle">Album <span class="new">Hot</span></h3>
            <a href="{{ route('album.list.all') }}"><h4 class="tittle">{{ Lang::get('Lang.See all') }}</h4></a>
            <div class="clearfix"> </div>
        </div>
        @foreach($albumsHot as $key => $album)
            @if($key++%4 == 0)
                <div class="col-md-3 content-grid last-grid">
                    <a class="play-icon popup-with-zoom-anim" href="{{ route('album.details', $album->slug) }}">
                        <img src="{{ Storage::disk('public')->url('album/image/' . $album->image) }}" title="{{ $album->name }}" style="height: 120px;">
                    </a>
                    <a class="name_album" href="{{ route('album.details', $album->slug) }}">{{ $album->name }}</a>
                    <br>
                    <a class="name_singer" href="{{ route('album.details', $album->slug) }}">({{ $album->user->name }})</a>
                </div>
            @else
                <div class="col-md-3 content-grid">
                    <a class="play-icon popup-with-zoom-anim" href="{{ route('album.details', $album->slug) }}">
                        <img src="{{ Storage::disk('public')->url('album/image/' . $album->image) }}" title="{{ $album->name }}" style="height: 120px;">
                    </a>
                    <a class="name_album" href="{{ route('album.details', $album->slug) }}">{{ $album->name }}</a>
                    <br>
                    <a class="name_singer" href="{{ route('singer.details', $album->user->username) }}">({{ $album->user->name }})</a>
                </div>
            @endif
        {{-- <div id="small-dialog" class="mfp-hide">
            <iframe src="{{ asset('https://laravelmp3.com/album/$album->slug.html') }}"></iframe>
        </div> --}}
        @endforeach
        
        <div class="clearfix"> </div>
    </div>
    <!--//End-albums-->
    <!--//discover-view-->

    <div class="albums second">
        <div class="tittle-head">
            <h3 class="tittle">{{ Lang::get('Lang.Artists') }} <span class="new">Hot</span></h3>
            <a href="{{ route('singer.list.all') }}"><h4 class="tittle two">{{ Lang::get('Lang.See all') }}</h4></a>
            <div class="clearfix"></div>
        </div>
        @foreach($singers as $count => $singer)
            @if($count++%4 == 0)
                <div class="col-md-3 content-grid">
                    <a href="{{ route('singer.details', $singer->username) }}">
                        <img src="{{ Storage::disk('public')->url('profile/singer/' . $singer->image) }}" title="{{ $singer->name }}" style="width: 105%; height: 150px;">
                    </a>
                    <div class="inner-info">
                        <a href="{{ route('singer.details', $singer->username) }}">
                            <h5>{{ $singer->name }}</h5>
                        </a>
                    </div>
                </div>
            @else
                <div class="col-md-3 content-grid last-grid">
                    <a href="{{ route('singer.details', $singer->username) }}">
                        <img src="{{ Storage::disk('public')->url('profile/singer/' . $singer->image) }}" title="{{ $singer->name }}" style="width: 105%; height: 150px;">
                    </a>
                    <div class="inner-info">
                        <a href="{{ route('singer.details', $singer->username) }}">
                            <h5>{{ $singer->name }}</h5>
                        </a>
                    </div>
                </div>
            @endif
        @endforeach
        <div class="clearfix"> </div>
    </div>
        <!--//discover-view-->
</div>
<!--//music-left-->