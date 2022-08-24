<h1 class="mb-4"><?= $title ?? SITE_NAME; ?></h1>

<?php if (!empty($posts)): ?>
    <?php foreach ($posts as $post): ?>
        <div class="card mb-3">
            <h5 class="card-header"># <?= $post['id']; ?></h5>
            <div class="card-body">
                <h2 class="card-title"><?= $post['title']; ?></h2>
                <p class="card-text mb-4"><?= $post['body']; ?></p>
                <a href="/post/<?= $post['id'] ?>" class="btn btn-primary">Go to the post</a>
                <a href="/post/update/<?= $post['id'] ?>" class="btn btn-primary">Update the post</a>
                <form action="/post/delete" method="post" class="form-check-inline">
                    <input type="hidden" name="id" value="<?= $post['id'] ?>">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="alert alert-danger" role="alert">
        NO POSTS
    </div>
<?php endif; ?>



