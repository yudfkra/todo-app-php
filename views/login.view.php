<?php view("partials/meta.php"); ?>

<body>
    <?php view("partials/header.php"); ?>

    <form action="/login.php" method="post">
        <input type="text" name="username" id="input-username" placeholder="Username">

        <input type="password" name="password" id="input-password" placeholder="Password">

        <button type="submit">Login</button>
    </form>
</body>

<?php view("partials/footer.php"); ?>