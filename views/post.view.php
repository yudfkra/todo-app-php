<?php require "partials/meta.php"; ?>

<body>
    <?php require "partials/header.php"; ?>

    <a href="/">Go Back</a>

    <h1><?php echo $post['title']; ?></h1>

    <h4>Created At: <?php echo $post['created_at']; ?> | Updated At: <?php echo $post['updated_at']; ?></h4>

    <p>
        <?php echo $post['content']; ?>
    </p>
</body>

<?php require "partials/footer.php"; ?>