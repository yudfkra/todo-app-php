<ul>
    <li>
        <a href="/">Home</a>
    </li>
    <?php if (\Core\Session::has('user')) : ?>
        <li>
            Hello, <?php echo \Core\Session::get('user')['username'] ?? null; ?>
            <br>
            <form action="/logout" method="post">
                <?php echo csrf_field(); ?>

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