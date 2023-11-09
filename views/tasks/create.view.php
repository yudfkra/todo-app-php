<?php require base_path("views/partials/meta.php"); ?>

<body>
    <?php require base_path("views/partials/header.php"); ?>

    <a href="/">Go Back</a>

    <h1>Create Task</h1>

    <form action="/tasks/create" method="post">
        <?php echo csrf_field(); ?>

        <label for="input-title">Title :</label>
        <div>
            <input id="input-title" type="text" name="title" placeholder="Title of the Task" value="<?php echo old('title'); ?>" />
            <?php if ($errors['title'] ?? null) : ?>
                <span style="color: red;"><?php echo $errors['title']; ?></span>
            <?php endif; ?>
        </div>

        <label for="input-content">Content :</label>
        <div>
            <textarea name="content" id="input-content" cols="20" rows="4" placeholder="Content of the Task"><?php echo old('content'); ?></textarea>
            <?php if ($errors['content'] ?? null) : ?>
                <span style="color: red;"><?php echo $errors['content']; ?></span>
            <?php endif; ?>
        </div>

        <label for="input-status">Status :</label>
        <div>
            <select name="status" id="input-status">
                <option value="">-- Pilih Status --</option>
                <option <?php echo old('status') == '2' ? 'selected' : ''; ?> value="2"><?php echo mapStatusDisplay(2); ?></option>
                <option <?php echo old('status') == '1' ? 'selected' : ''; ?> value="1"><?php echo mapStatusDisplay(1); ?></option>
                <option <?php echo old('status') == '-1' ? 'selected' : ''; ?> value="-1"><?php echo mapStatusDisplay(-1); ?></option>
            </select>
            <?php if ($errors['status'] ?? null) : ?>
                <span style="color: red;"><?php echo $errors['status']; ?></span>
            <?php endif; ?>
        </div>

        <p>
            <button type="submit">Save</button>
        </p>
    </form>
</body>

<?php require base_path("views/partials/footer.php"); ?>