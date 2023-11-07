<?php require "partials/meta.php"; ?>

<body>
    <?php require "partials/header.php"; ?>

    <form action="/login.php" method="post">
        <input type="text" name="username" id="input-username" placeholder="Username">

        <input type="password" name="password" id="input-password" placeholder="Password">

        <button type="submit">Login</button>
    </form>
</body>

<?php require "partials/footer.php"; ?>