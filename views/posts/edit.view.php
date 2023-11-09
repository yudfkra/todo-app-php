<?php require base_path("views/partials/meta.php"); ?>

<body>
    <?php require base_path("views/partials/header.php"); ?>

    <a href="/">Go Back</a>

    <h1><?php echo $post['title']; ?> - Edit Post</h1>

    <form action="/post/edit?id=<?php echo $post['id']; ?>" method="post">
        <?php echo csrf_field(); ?>

        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">

        <label for="input-title">Title :</label>
        <div>
            <input id="input-title" type="text" name="title" placeholder="Title of the Post" value="<?php echo old('title', $post['title'] ?? ''); ?>" />
            <?php if ($errors['title'] ?? null) : ?>
                <span style="color: red;"><?php echo $errors['title']; ?></span>
            <?php endif; ?>
        </div>

        <label for="input-content">Content :</label>
        <div>
            <textarea name="content" id="input-content" cols="20" rows="4" placeholder="Content of the Post"><?php echo htmlspecialchars(old('content', $post['content'] ?? '')); ?></textarea>
            <?php if ($errors['content'] ?? null) : ?>
                <span style="color: red;"><?php echo $errors['content']; ?></span>
            <?php endif; ?>
        </div>

        <p>
            <button type="button"><a href="/posts">Cancel</a></button>

            <button type="submit">Update</button>
        </p>
    </form>
</body>

<?php require base_path("views/partials/footer.php"); ?>