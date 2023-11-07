<?php require "partials/meta.php"; ?>

<body>
    <?php require "partials/header.php"; ?>

    <h1>List Posts</h1>

    <a href="/add">Add New Post</a>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $index => $post) : ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo $post['title']; ?></td>
                        <td><?php echo $post['created_at']; ?></td>
                        <td>
                            <a href="/post?id=<?php echo $post['id']; ?>">Edit</a> | <a href="/delete?id=<?php echo $post['id']; ?>">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Tidak ada data posts.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

<?php require "partials/footer.php"; ?>