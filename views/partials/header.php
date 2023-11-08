<ul>
    <li>
        <a href="/">Home</a>
    </li>
    <?php if ($_SESSION['user'] ?? false) : ?>
        <li>
            Hello, <?php echo $_SESSION['user']['username'] ?? null; ?> - <a href="/logout">Logout</a>
        </li>
    <?php else : ?>
        <li>
            <a href="/login">Login</a>
        </li>
    <?php endif; ?>
</ul>