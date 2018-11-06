<div class='row'>
    <div class='col-sm-1'>
        @if($comment->user->image == "default.png")
            <img src="{{ asset('storage/profile/default.png') }}" alt='' width='100%'>
        @else
            @if ($comment->user->role_id == 3)
                <img src="{{ Storage::disk('public')->url('profile/singer/' . $comment->user->image) }}" alt='' width='100%'>
            @else
                <img src="{{ Storage::disk('public')->url('profile/listener/' . $comment->user->image) }}" alt='' width='100%'>
            @endif
        @endif
    </div>
    <div class='col-sm-11'>
        <div class='row'>
            <div class='col-md-6'>
                <p style='font-weight: bold'>{{$comment->user->name}}</p>
            </div>
            <div class='col-md-6' align='right'>
                <p>{{$comment->created_at->diffForHumans()}}</p>
            </div>
        </div>
        {{$comment->comment}}
    </div>
</div>
<br>