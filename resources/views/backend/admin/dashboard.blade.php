@extends('backend.layouts.app')

@section('title', 'Dashboard')

@push('css')

@endpush

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>DASHBOARD</h2>
    </div>

    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">visibility</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL VIEWS</div>
                    <div class="number count-to" data-from="0" data-to="{{ $views }}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">music_note</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL SONGS</div>
                    <div class="number count-to" data-from="0" data-to="{{ $songs }}" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">mic</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL ARTISTS</div>
                    <div class="number count-to" data-from="0" data-to="{{ $singers }}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">headset</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL USERS </div>
                    <div class="number count-to" data-from="0" data-to="{{ $users }}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Widgets -->
    
    <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
            <div class="info-box bg-green hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">comment</i>
                </div>
                <div class="content">
                    <div class="text">CATEGORIES</div>
                    <div class="number count-to" data-from="0" data-to="{{ $categories }}" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
            <div class="info-box bg-pink hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">people_outline</i>
                </div>
                <div class="content">
                    <div class="text">NEW REQUESTS</div>
                    <div class="number count-to" data-from="0" data-to="{{ $usersRequest }}" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
            <div class="info-box bg-blue-grey hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">queue_music</i>
                </div>
                <div class="content">
                    <div class="text">NEW SONGS </div>
                    <div class="number count-to" data-from="0" data-to="{{ $newSongs }}" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
            <div class="info-box bg-purple hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">library_music</i>
                </div>
                <div class="content">
                    <div class="text">NEW ALBUMS</div>
                    <div class="number count-to" data-from="0" data-to="{{ $newAlbums }}" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
            <div class="info-box bg-deep-purple hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">fiber_new</i>
                </div>
                <div class="content">
                    <div class="text">NEW USERS</div>
                    <div class="number count-to" data-from="0" data-to="{{ $newUsers }}" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
            <div class="info-box bg-blue hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">comment</i>
                </div>
                <div class="content">
                    <div class="text">NEW COMMENTS</div>
                    <div class="number count-to" data-from="0" data-to="{{ $newComments }}" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
            <div class="card">
                <div class="header">
                    <h2>MOST POPULAR SONGS</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Title</th>
                                    <th>Views</th>
                                    <th>Favorite</th>
                                    <th>Comments</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hotSongs as $key=>$song)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ str_limit($song->name,'20') }}</td>
                                        <td>{{ $song->count_listen }}</td>
                                        <td>{{ $song->count_like }}</td>
                                        <td>{{ $song->comments_count }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary waves-effect" target="_blank" href="{{ route('song.details',$song->slug) }}">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
            <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>TOP 10 ACTIVITY USER</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Name</th>
                                <th>Playlists</th>
                                <th>Comments</th>
                                <th>Like</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($topUsers as $key=>$user)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->playlists_count }}</td>
                                        <td>{{ $user->comments_count }}</td>
                                        <td>{{ $user->likes_count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Task Info -->
    </div>
</div>
@endsection

@push('js')
    <!-- ChartJs -->
    <script src="{{ asset('assets/backend/plugins/chartjs/Chart.bundle.js') }}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/morrisjs/morris.js') }}"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <script src="{{ asset('assets/backend/js/pages/index.js') }}"></script>
@endpush