<div class="panel-body">
    <!-- New Task Form -->
    <form action="/blog" method="POST" id="create" class="form-horizontal">
        <!-- Task Name -->
        <div class="form-group">
            <label for="post" class="col-sm-3 control-label">Post Name</label>

            <div class="col-sm-6">
                <input type="text" name="title" id="post" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="post" class="col-sm-3 control-label">Post:</label>
            <div class="col-sm-6">
                <textarea class="form-control" rows="5" id="post"></textarea>
            </div>
        </div>

        <!-- Add Task Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" form="create" class="btn btn-default">
                    <i class="fa fa-plus"></i> Add post
                </button>
            </div>
        </div>
    </form>
</div>