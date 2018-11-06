@extends('backend.layouts.app')

@section('title', 'Album')

@push('css')

@endpush

@section('content')
<div class="container-fluid">
    <!-- Vertical Layout | With Floating Label -->
    <a href="{{ route('singer.album.index') }}" class="btn btn-danger waves-effect">BACK</a>
    
    <br>
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                          {{ $album->name }}
                            <small>Created By 
                                <strong>
                                    {{ $album->user->name }}
                                </strong> 
                                on {{ $album->updated_at->toFormattedDateString() }}
                            </small>
                        </h2>
                    </div>
                    
                    @foreach($album->songs as $song)
                        <div class="body">
                            <span class="label bg-purple">{{ $song->name }}</span>
                        </div>
                        <div class="audio-wrap">
                            <audio controls style="width: 100%">
                                <source src="{{ Storage::disk('public')->url('song/normal/' . $song->normal_url) }}" type="audio/ogg">
                            </audio>
                        </div>
                    @endforeach
                    <hr>
                    <div class="body">
                        <h4>About</h4>
                        {!! $album->description !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                {{-- <div class="card">
                    <div class="header bg-green">
                        <h2>
                            Songs
                        </h2>
                    </div>
                    <div class="body">
                        @foreach($album->songs as $song)
                            <span class="label bg-orange">{{ $song->name }}</span>
                        @endforeach
                    </div>
                </div> --}}
                <div class="card">
                    <div class="header bg-amber">
                        <h2>
                            Album Image
                        </h2>
                    </div>
                    <div class="body">
                        <img class="img-responsive thumbnail" src="{{ Storage::disk('public')->url('album/image/'.$album->image) }}" alt="">
                    </div>
                </div>

            </div>
        </div>
</div>
@endsection

@push('js')
<!-- Select Plugin Js -->
<script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
@endpush