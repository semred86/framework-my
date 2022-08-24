<h1><?= $title ?? "-" ?></h1>

<?php
$uri = "add";
if (isset($id)) {
    $uri = "update/$id";
}
?>
<?php if (isset($row)): ?>
    <div class="alert alert-success" role="alert">
        Post was added! ;)
    </div>
<?php endif; ?>

<form action="/post/<?= $uri; ?>" method="post">

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="<?= $posts['title'] ?? ''; ?>">
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        <textarea name="body" class="form-control" rows="3"><?= $posts['body'] ?? ''; ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>

</form>