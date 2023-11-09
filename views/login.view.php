<?php require base_path("views/partials/meta.php"); ?>

<body>
    <?php require base_path("views/partials/header.php"); ?>

    <form action="/login" method="post">
        <?php echo csrf_field(); ?>

        <div>
            <input type="text" name="username" id="input-username" placeholder="Username" value="<?php echo old('username'); ?>">
            <?php if ($errors['username'] ?? null) : ?>
                <span style="color: red;"><?php echo $errors['username']; ?></span>
            <?php endif; ?>
        </div>

        <div>
            <input type="password" name="password" id="input-password" placeholder="Password">
            <?php if ($errors['password'] ?? null) : ?>
                <span style="color: red;"><?php echo $errors['password']; ?></span>
            <?php endif; ?>
        </div>

        <button type="submit">Login</button>
    </form>
</body>

<?php require base_path("views/partials/footer.php"); ?>