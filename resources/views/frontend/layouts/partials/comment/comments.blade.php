@foreach($comments as $comment)
    @include('frontend.layouts.partials.comment.comment', ['comment'])
@endforeach