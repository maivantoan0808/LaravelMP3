@extends('backend.layouts.app')

@section('title', 'Singer')

@push('css')

@endpush

@section('content')
<div class="container-fluid">
    <!-- Vertical Layout | With Floating Label -->
    <a href="{{ route('admin.singer.index') }}" class="btn btn-danger waves-effect">BACK</a>
    
    <br>
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                          {{ $singer->name }}
                            <small>Created By <strong> AdminLaravelMP3</strong> on {{ $singer->updated_at->toFormattedDateString() }}</small>
                        </h2>
                    </div>
                    <div class="body">
                        {!! $singer->about !!}
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
                        @foreach($singer->categories as $cate)
                            <span class="label bg-green">{{ $cate->name }}</span>
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
                        <img class="img-responsive thumbnail" src="{{ Storage::disk('public')->url('profile/singer/'.$singer->image) }}" alt="">
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