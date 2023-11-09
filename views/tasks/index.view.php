<?php require base_path("views/partials/meta.php"); ?>

<body>
    <?php require base_path("views/partials/header.php"); ?>

    <h1>List Posts</h1>

    <?php if (\Core\Session::has('user')) : ?>
        <a href="/tasks/create">Add New Task</a>
    <?php endif; ?>

    <table border="1">
        <thead>
            <tr>
                <th style="width: 20px;">No.</th>
                <th style="width: 200px;">Title</th>
                <th style="width: 100px;">Status</th>
                <th style="width: 150px;">Created At</th>
                <th style="width: 145px;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($tasks)) : ?>
                <?php foreach ($tasks as $index => $task) : ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo $task['title']; ?></td>
                        <td style="text-align: center;"><?php echo mapStatusDisplay($task['status']); ?></td>
                        <td><?php echo $task['created_at']; ?></td>
                        <td>
                            <div>
                                <button><a href="/task?id=<?php echo $task['id']; ?>">Detail</a></button>

                                <?php if (\Core\Session::has('user') && authorizeUser($task['user_id'])) : ?>
                                    <button><a href="/task/edit?id=<?php echo $task['id']; ?>">Edit</a></button>

                                    <form action="/task?id=<?php echo $task['id']; ?>" method="post" style="display: inline;">
                                        <?php echo csrf_field(); ?>

                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                                        <button type="submit" name="delete" value="1">Delete</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4" style="text-align: center;">Tidak ada data tasks.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

<?php require base_path("views/partials/footer.php"); ?>