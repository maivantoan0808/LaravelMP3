<div class="review-slider">
    <div class="tittle-head">
        <h3 class="tittle">{{Lang::get('Lang.New Songs')}} <span class="new"> New</span></h3>
        <div class="clearfix"></div>
    </div>
    <ul id="flexiselDemo1">
        @foreach($newSongs as $song)
        <li>
            <a href="{{ route('song.details', $song->slug) }}">
                <img src="{{ Storage::disk('public')->url('song/image/' . $song->image) }}" alt="" style="height: 150px;" />
            </a>
            <div class="slide-title">
                <h4>{{ $song->name}}</h4>
            </div>
            <div class="date-city">
                <h5>{{ $song->created_at->toFormattedDateString() }}</h5>
                <div class="buy-tickets">
                    <a href="{{ route('song.details', $song->slug) }}">{{Lang::get('Lang.Listen')}}</a>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
    <script type="text/javascript">
    $(window).load(function() {

    $("#flexiselDemo1").flexisel({
        visibleItems: 10,
        animationSpeed: 1000,
        autoPlay: true,
        autoPlaySpeed: 3000,            
        pauseOnHover: false,
        enableResponsiveBreakpoints: true,
        responsiveBreakpoints: { 
            portrait: { 
                changePoint:480,
                visibleItems: 2
            }, 
            landscape: { 
                changePoint:640,
                visibleItems: 3
            },
            tablet: { 
                changePoint:800,
                visibleItems: 4
            }
        }
    });
    });
    </script>
    <script type="text/javascript" src="{{ asset('assets/frontend/js/jquery.flexisel.js') }}"></script>    
</div>