<?php require base_path("views/partials/meta.php"); ?>

<body>
    <?php require base_path("views/partials/header.php"); ?>

    <h1>List Posts</h1>

    <a href="/posts/create">Add New Post</a>

    <table border="1">
        <thead>
            <tr>
                <th style="width: 20px;">No.</th>
                <th style="width: 200px;">Title</th>
                <th style="width: 150px;">Created At</th>
                <th style="width: 145px;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($posts)) : ?>
                <?php foreach ($posts as $index => $post) : ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo $post['title']; ?></td>
                        <td><?php echo $post['created_at']; ?></td>
                        <td>
                            <div>
                                <button><a href="/post?id=<?php echo $post['id']; ?>">Detail</a></button>

                                <button><a href="/post/edit?id=<?php echo $post['id']; ?>">Edit</a></button>

                                <form action="/post?id=<?php echo $post['id']; ?>" method="post" style="display: inline;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                                    <button type="submit" name="delete" value="1">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4" style="text-align: center;">Tidak ada data posts.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

<?php require base_path("views/partials/footer.php"); ?>