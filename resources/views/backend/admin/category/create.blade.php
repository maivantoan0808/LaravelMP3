<div class="modal fade" id="createCategory" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="createCategoryLabel">Create New Category</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" id="name" class="form-control" name="name">
                            <label class="form-label">Category Name</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                    <button type="button" class="btn btn-danger m-t-15 waves-effect" data-dismiss="modal">CLOSE</button
                </form>
            </div>
        </div>
    </div>
</div>