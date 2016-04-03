<div class="panel-body">
    <!-- New Task Form -->
    <form action="/post/add" method="POST" id="create" class="form-horizontal">
        <!-- Task Name -->
        <div class="form-group">
            <label for="post" class="col-sm-3 control-label">Post Name</label>

            <div class="col-sm-6">
                <input type="text" name="name" id="post" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="post" class="col-sm-3 control-label">Post:</label>
            <div class="col-sm-6">
                <textarea class="form-control" name="description" rows="5" id="post"></textarea>
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

<?php if (count($posts) > 0): ?>
    <div class="row">
        <div class="col-md-12">
            <ul class="list-group">
                <?php foreach ($posts as $post): ?>
                    <li class="list-group-item">
                        <form id="delete_<?= $post->id ?>" class="form-inline" action="/post/<?= $post->id ?>/delete"
                              method="POST">
                            <div class="form-group">
                                <p><a href="/todo/<?= $post->id ?>"><?= $post->name ?></a></p>
                            </div>
                            <button form="delete_<?= $post->id ?>" type="submit" value="Submit"
                                    class="btn btn-sm btn-danger pull-right">Delete
                            </button>
                        </form>
                        <p><?= $post->description ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>