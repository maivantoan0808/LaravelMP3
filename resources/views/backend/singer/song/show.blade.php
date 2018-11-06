@extends('backend.layouts.app')

@section('title', 'Song')

@push('css')

@endpush

@section('content')
<div class="container-fluid">
    <!-- Vertical Layout | With Floating Label -->
    <a href="{{ route('singer.song.index') }}" class="btn btn-danger waves-effect">BACK</a>
    
    <br>
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                          {{ $song->name }}
                            <small>Created By 
                                <strong>
                                    @foreach($song->users as $singer)
                                    {{ $singer->name }}
                                    @endforeach
                                </strong> 
                                on {{ $song->updated_at->toFormattedDateString() }}
                            </small>
                        </h2>
                    </div>

                    <div class="audio-wrap">
                        <audio autoplay="" controls style="width: 100%">
                            <source src="{{ Storage::disk('public')->url('song/normal/' . $song->normal_url) }}" type="audio/ogg">
                        </audio>
                    </div>

                    <div class="body">
                        {!! $song->lyrics !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-cyan">
                        <h2>
                            Category
                        </h2>
                    </div>
                    <div class="body">
                        <span class="label bg-green">{{ $song->category->name }}</span>
                    </div>
                </div>
                <div class="card">
                    <div class="header bg-green">
                        <h2>
                            Singer
                        </h2>
                    </div>
                    <div class="body">
                        @foreach($song->users as $singer)
                            <span class="label bg-orange">{{ $singer->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="header bg-amber">
                        <h2>
                            Featured Image
                        </h2>
                    </div>
                    <div class="body">
                        <img class="img-responsive thumbnail" src="{{ Storage::disk('public')->url('song/image/'.$song->image) }}" alt="">
                    </div>
                </div>

            </div>
        </div>
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