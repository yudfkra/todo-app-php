<?php require base_path("views/partials/meta.php"); ?>

<body>
    <?php require base_path("views/partials/header.php"); ?>

    <a href="/">Go Back</a>

    <h1><?php echo $post['title']; ?></h1>

    <h4>Created At: <?php echo $post['created_at']; ?> | Updated At: <?php echo $post['updated_at']; ?></h4>

    <p>
        <?php echo $post['content']; ?>
    </p>

    <form action="/post?id=<?php echo $post['id']; ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
        <button type="submit" name="delete" value="1">Delete</button>
    </form>
</body>

<?php require base_path("views/partials/footer.php"); ?>