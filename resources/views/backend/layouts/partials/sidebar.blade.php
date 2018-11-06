<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            @if(Request::is('singer*'))
            <img src="{{ Storage::disk('public')->url('profile/singer/' . Auth::user()->image) }}" width="48" height="48" alt="User" />
            @endif
            @if(Request::is('admin*'))
            <img src="{{ Storage::disk('public')->url('profile/' . Auth::user()->image) }}" width="48" height="48" alt="User" />
            @endif
            @if(Request::is('listener*'))
            <img src="{{ Storage::disk('public')->url('profile/listener/' . Auth::user()->image) }}" width="48" height="48" alt="User" />
            @endif
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
            <div class="email">{{ Auth::user()->email }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i>Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ Request::is('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                    <i class="material-icons">home</i>
                    <span>HomePage</span>
                </a>
            </li>
            @if(Request::is('admin*'))
                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/category*') ? 'active' : '' }}">
                    <a href="{{ route('admin.category.index') }}">
                        <i class="material-icons">queue_music</i>
                        <span>Categories</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/singer*') ? 'active' : '' }}">
                    <a href="{{ route('admin.singer.index') }}">
                        <i class="material-icons">keyboard_voice</i>
                        <span>Singers</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/listener*') ? 'active' : '' }}">
                    <a href="{{ route('admin.listener.index') }}">
                        <i class="material-icons">headset</i>
                        <span>Listeners</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/song*') ? 'active' : '' }}">
                    <a href="{{ route('admin.song.index') }}">
                        <i class="material-icons">library_music</i>
                        <span>Songs</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/account*') ? 'active' : '' }}">
                    <a href="{{ route('admin.account.index') }}">
                        <i class="material-icons">sync</i>
                        <span>Request Singer Account</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/logs') ? 'active' : '' }}">
                    <a href="{{ route('admin.logs') }}">
                        <i class="material-icons">event_note</i>
                        <span>Logs</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i>
                        <span>Logout</span>
                    </a>

                    <form id="logout-form" 
                        action="{{ route('logout') }}" 
                        method="POST" 
                        style="display: none;">
                        @csrf
                    </form>
                </li>
            @endif

            @if(Request::is('listener*'))
                @if(Auth::user()->role_id == 2)
                <li class="{{ Request::is('listener/account') ? 'active' : '' }}">
                    <a href="{{ route('listener.account') }}">
                        <i class="material-icons">call_made</i>
                        <span>Upgrade Your Account to Singer</span>
                    </a>
                </li>
                @endif
                <li class="{{ Request::is('listener/playlist*') ? 'active' : '' }}">
                    <a href="{{ route('listener.playlist.manage') }}">
                        <i class="material-icons">library_music</i>
                        <span>Playlist</span>
                    </a>
                </li>
                <li class="{{ Request::is('listener/settings') ? 'active' : '' }}">
                    <a href="{{ route('listener.settings') }}">
                        <i class="material-icons">settings</i>
                        <span>Update Profile</span>
                    </a>
                </li>
                
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i>
                        <span>Logout</span>
                    </a>

                    <form id="logout-form" 
                        action="{{ route('logout') }}" 
                        method="POST" 
                        style="display: none;">
                        @csrf
                    </form>
                </li>
            @endif

            @if(Request::is('singer*'))
                <li class="{{ Request::is('singer/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('singer.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('singer/song*') ? 'active' : '' }}">
                    <a href="{{ route('singer.song.index') }}">
                        <i class="material-icons">library_music</i>
                        <span>Songs</span>
                    </a>
                </li>
                <li class="{{ Request::is('singer/album*') ? 'active' : '' }}">
                    <a href="{{ route('singer.album.index') }}">
                        <i class="material-icons">album</i>
                        <span>Albums</span>
                    </a>
                </li>
                <li class="{{ Request::is('singer/settings') ? 'active' : '' }}">
                    <a href="{{ route('singer.settings') }}">
                        <i class="material-icons">settings</i>
                        <span>Update Profile</span>
                    </a>
                </li>
                
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i>
                        <span>Logout</span>
                    </a>

                    <form id="logout-form" 
                        action="{{ route('logout') }}" 
                        method="POST" 
                        style="display: none;">
                        @csrf
                    </form>
                </li>
            @endif
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2018 - 2019 <a href="javascript:void(0);">AdminLaravelMP3 - Material Design</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>