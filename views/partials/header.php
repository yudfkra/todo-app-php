<ul>
    <li>
        <a href="/">Home</a>
    </li>
    <?php if ($_SESSION['user'] ?? false) : ?>
        <li>
            Hello, <?php echo $_SESSION['user']['username'] ?? null; ?>
            <br>
            <form action="/logout" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit">Logout</button>
            </form>
        </li>
    <?php else : ?>
        <li>
            <a href="/login">Login</a>
        </li>
    <?php endif; ?>
</ul>