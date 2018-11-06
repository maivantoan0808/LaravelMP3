<div class="modal fade" id="createNewPlaylist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog facebook" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                @if(Auth::user()->playlists()->count() == 0)
                <h4 id="createCategoryLabel">(Your Playlist Empty, Create Your New Playlist)</h4>
                @endif
                <form action="{{ route('myplaylist.store', ['username' => Auth::user()->username,'id' => $song->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Playlist Title</label>
                            <input type="text" id="name" class="form-control" name="name">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success m-t-15 waves-effect">SUBMIT</button>
                    <button type="button" class="btn btn-danger m-t-15 waves-effect" data-dismiss="modal">CLOSE</button
                </form>
            </div>
        </div>
    </div>
</div>