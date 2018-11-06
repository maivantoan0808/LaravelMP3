<div class="modal fade" id="addToPlaylist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog facebook" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <h4 id="createCategoryLabel">Choose Your Playlist</h4>
                <form action="{{ route('myplaylist.song.store', ['username' => Auth::user()->username,'id' => $song->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Playlist Title</label>
                            <select name="playlist" id="playlist" class="form-control show-tick" data-live-search="true">
                                @foreach(Auth::user()->playlists as $playlist)
                                    <option value="{{ $playlist->id }}">{{ $playlist->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success m-t-15 waves-effect">SUBMIT</button>
                    <button type="button" class="btn btn-danger m-t-15 waves-effect" data-dismiss="modal">CLOSE</button
                </form>
            </div>
        </div>
    </div>
</div>