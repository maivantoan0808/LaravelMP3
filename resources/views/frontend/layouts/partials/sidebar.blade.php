<div class="left-side-inner">
<!--sidebar nav start-->
    <ul class="nav nav-pills nav-stacked custom-nav">
        <li class="active">
            <a href="{{ route('home') }}">
                <i class="lnr lnr-home"></i>
                <span>{{ Lang::get('Lang.Home') }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('song.list.all') }}">
                <i class="lnr lnr-music-note"></i>
                <span>{{ Lang::get('Lang.Songs') }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('album.list.all') }}">
                <i class="lnr lnr-indent-increase"></i>
                <span>{{ Lang::get('Lang.Albums') }}</span>
            </a>
        </li>
        <li>
            @guest
            <a href="javscript:void(0)" onclick="toastr.info('Please login to view your playlist',
                'Info',{
                    closeButton: true,
                    progressBar: true,
                })">
                <i class="camera"></i>
                <span>Playlists</span>
            </a>
            @else
            <a href="{{ route('myplaylist', Auth::user()->username) }}">
                <i class="camera"></i>
                <span>Playlists</span>
            </a>
            @endguest
        </li>
        <li>
            <a href="{{ route('singer.list.all') }}">
                <i class="lnr lnr-users"></i>
                <span>{{ Lang::get('Lang.Artists') }}</span>
            </a>
        </li>
        <li><a href="#" data-toggle="modal" data-target="#myModal1"><i class="fa fa-th"></i><span>Apps</span></a></li>
        <li class="menu-list"><a href="#"><i class="lnr lnr-heart"></i>  <span>{{ Lang::get('Lang.My Favourities') }}</span></a> 
            <ul class="sub-menu-list">
                <li><a href="radio.html">{{ Lang::get('Lang.All Songs') }}</a></li>
            </ul>
        </li>
        <li class="menu-list"><a href="contact.html"><i class="fa fa-thumb-tack"></i><span>{{ Lang::get('Lang.Contact') }}</span></a>
            <ul class="sub-menu-list">
                <li><a href="contact.html">Location</a> </li>
            </ul>
        </li>     
    </ul>
<!--sidebar nav end-->
</div>