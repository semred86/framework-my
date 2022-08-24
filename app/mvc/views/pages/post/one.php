<?php if (!empty($post)): ?>
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold"><?= $post['title']; ?> #<?= $post['id']; ?></h1>
            <p class="col-md-8 fs-4"><?= $post['body']; ?></p>
            <a href="/post/update/<?= $post['id'] ?>" class="btn btn-primary btn-lg">Update the post</a>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-danger" role="alert">
        NO POST
    </div>
<?php endif; ?>



