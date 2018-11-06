@extends('backend.layouts.app')

@section('title', 'Song')

@push('css')
<!-- Bootstrap Select Css -->
<link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="container-fluid">
    <form action="{{ route('singer.song.update', $song->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            UPDATE
                        </h2>
                    </div>
                    <div class="body">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="name" class="form-control" name="name" value="{{ $song->name }}">
                                <label class="form-label">Song Title</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <p><img width="200px" src="{{ Storage::disk('public')->url('song/image/' . $song->image) }}"></p>
                            <input type="file" name="image">
                        </div>

                        <div class="form-group">
                            <label for="normal_url">Normal Song</label>
                            <input type="file" name="normal_url">{{ $song->normal_url }}
                        </div>

                        <div class="form-group">
                            <label for="vip_url">Vip Song</label>
                            <input type="file" name="vip_url">{{ $song->vip_url }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            CATEGORIES AND SINGERS
                        </h2>
                    </div>
                    <div class="body">
                        <div class="form-group form-float">
                            <div class="form-line {{ $errors->has('categories') ? 'focused error' : ''}}">
                                <label for="category">Select Category</label>
                                <select name="category_id" id="category_id" class="form-control show-tick" data-live-search="true">
                                    @foreach($categories as $cate)
                                        <option {{ $song->category_id == $cate->id ? 'selected' : '' }} value="{{ $cate->id }}">{{ $cate->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group form-float">
                            <div class="form-line {{ $errors->has('singers') ? 'focused error' : ''}}">
                                <label for="singer">Select Singer</label>
                                <select name="singers[]" id="singer" class="form-control show-tick" data-live-search="true" multiple>
                                    @foreach($singers as $singer)
                                        <option 
                                            @foreach ($song->users as $songSinger)
                                                {{ $songSinger->id == $singer->id ? 'selected' : '' }}
                                            @endforeach
                                            value="{{ $singer->id }}">
                                            {{ $singer->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('singer.song.index') }}">BACK</a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            LYRICS
                        </h2>
                    </div>
                    <div class="body">
                        <textarea id="tinymce" name="lyrics">{{ $song->lyrics }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('js')
<!-- Select Plugin Js -->
<script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
<!-- TinyMCE -->
<script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script>
<script>
    $(function () {
        //TinyMCE
        tinymce.init({
            selector: "textarea#tinymce",
            theme: "modern",
            height: 300,
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools'
            ],
            toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons',
            image_advtab: true
        });
        tinymce.suffix = ".min";
        tinyMCE.baseURL = '{{ asset('assets/backend/plugins/tinymce') }}';
    });
</script>
@endpush