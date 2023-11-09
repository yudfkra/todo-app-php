<?php require base_path("views/partials/meta.php"); ?>

<body>
    <?php require base_path("views/partials/header.php"); ?>

    <a href="/">Go Back</a>

    <h1><?php echo $task['title']; ?></h1>

    <h4>Created At: <?php echo $task['created_at']; ?> | Updated At: <?php echo $task['updated_at']; ?></h4>

    <p>
        <?php echo htmlspecialchars($task['content']); ?>
    </p>

    <?php if (\Core\Session::has('user') && authorizeUser($task['user_id'])) : ?>
        <div>
            <button><a href="/task/edit?id=<?php echo $task['id']; ?>">Edit</a></button>
        </div>
        <br>

        <form action="/task?id=<?php echo $task['id']; ?>" method="post">
            <input type="hidden" name="_token" value="<?php echo \Core\Session::get('_token'); ?>">

            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
            <button type="submit" name="delete" value="1">Delete</button>
        </form>
    <?php endif; ?>
</body>

<?php require base_path("views/partials/footer.php"); ?>