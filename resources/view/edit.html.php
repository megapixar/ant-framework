<div class="panel-body">
    <!-- New Task Form -->
    <form action="/post/<?= $post->id ?>/edit" method="POST" id="create" class="form-horizontal">
        <!-- Task Name -->
        <div class="form-group">
            <label for="post" class="col-sm-3 control-label">Post Name</label>

            <div class="col-sm-6">
                <input type="text" value="<?= htmlspecialchars($post->name) ?>" name="name" id="post"
                       class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="post" class="col-sm-3 control-label">Post:</label>
            <div class="col-sm-6">
                <textarea class="form-control" name="description" rows="5"
                          id="post"><?= htmlspecialchars($post->description) ?></textarea>
            </div>
        </div>

        <!-- Add Task Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" form="create" class="btn btn-default">
                    <i class="fa fa-plus"></i> Edit post
                </button>
            </div>
        </div>
    </form>
</div>
