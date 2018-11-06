<div class="header-section">
    <!--toggle button start-->
    <a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
    <!--toggle button end-->
    <!--notification menu start -->
    <div class="menu-right">
        <div class="profile_details">
            <div class="col-md-6 serch-part">
            <form method="GET" action="{{ action('SearchController@search')}} ">     
                <div id="search" class="input-group pull-left" style="margin: 13px auto;">
                    <input type="text" name="search" class="form-control" placeholder="{{ Lang::get('Lang.Search') }}" id="txtSearch" style="margin-left: -4px; padding: 20px;" />
                    <div class="input-group-btn pull-right">
                        <button class="btn btn-primary" type="submit">
                        <span class="glyphicon glyphicon-search" style="padding: 7px;"></span>
                        </button>
                    </div>
                </div>
            </form>
            </div>
            
            <div class="col-md-6 login-pop pull-right">
                <div id="loginpop"> 
                    @guest
                    <a href="{{ route('login') }}" style="margin-left: -10px;" class="pull-left">
                        <span>{{ Lang::get('Lang.Login') }} <i class="arrow glyphicon glyphicon-chevron-right"></i></span>
                    </a>
                    @else
                        @if(Auth::user()->role_id == 1)
                        <a href="{{ route('admin.dashboard') }}" style="margin-left: -10px;" class="pull-left">
                            <span>{{ Auth::user()->name }} <i class="arrow glyphicon glyphicon-chevron-right"></i></span>
                        </a>
                        @endif
                        @if(Auth::user()->role_id == 2 || Auth::user()->role_id == 4)
                        <a href="{{ route('listener.dashboard') }}" style="margin-left: -10px;" class="pull-left">
                            <span>{{ Auth::user()->name }} <i class="arrow glyphicon glyphicon-chevron-right"></i></span>
                        </a>
                        @endif
                        @if(Auth::user()->role_id == 3)
                        <a href="{{ route('singer.dashboard') }}" style="margin-left: -10px;" class="pull-left">
                            <span>{{ Auth::user()->name }} <i class="arrow glyphicon glyphicon-chevron-right"></i></span>
                        </a>
                        @endif
                    @endguest
                    <div class="top-sign pull-right" style="margin-left: 10px;">
                        <div class="form-group">
                            <form action="{{ route('switchLang') }}" class="form-lang" method="POST">
                                <select class="form-control" name="locale" id="sel1" onchange='this.form.submit();'>
                                    <option value="en">English</option>
                                    <option value="vi"{{ Lang::locale() === 'vi' ? 'selected' : '' }}>Việt Nam</option>
                                </select>
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
        <!-------->
    </div>
    <div class="clearfix"></div>
</div>
<!--notification menu end -->
<!-- //header-ends -->
