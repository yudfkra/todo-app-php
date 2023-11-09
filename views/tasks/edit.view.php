<?php require base_path("views/partials/meta.php"); ?>

<body>
    <?php require base_path("views/partials/header.php"); ?>

    <a href="/">Go Back</a>

    <h1><?php echo $task['title']; ?> - Edit Task</h1>

    <form action="/task/edit?id=<?php echo $task['id']; ?>" method="post">
        <?php echo csrf_field(); ?>

        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="id" value="<?php echo $task['id']; ?>">

        <label for="input-title">Title :</label>
        <div>
            <input id="input-title" type="text" name="title" placeholder="Title of the Task" value="<?php echo old('title', $task['title'] ?? ''); ?>" />
            <?php if ($errors['title'] ?? null) : ?>
                <span style="color: red;"><?php echo $errors['title']; ?></span>
            <?php endif; ?>
        </div>

        <label for="input-content">Content :</label>
        <div>
            <textarea name="content" id="input-content" cols="20" rows="4" placeholder="Content of the Task"><?php echo htmlspecialchars(old('content', $task['content'] ?? '')); ?></textarea>
            <?php if ($errors['content'] ?? null) : ?>
                <span style="color: red;"><?php echo $errors['content']; ?></span>
            <?php endif; ?>
        </div>

        <p>
            <button type="button"><a href="/tasks">Cancel</a></button>

            <button type="submit">Update</button>
        </p>
    </form>
</body>

<?php require base_path("views/partials/footer.php"); ?>