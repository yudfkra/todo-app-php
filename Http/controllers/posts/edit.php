<?php

use Core\{
    App,
    Database,
    Router,
    Session,
    Validator
};
use Http\Forms\PostForm;

$currentUserID = Session::get('user')['id'] ?? null;

$id = $_GET['id'] ?? null;
if (!Validator::integer($id)) {
    Router::abort(404, "Invalid Post ID");
}

/** @var \Core\Database $db */
$db = App::resolve(Database::class);

$post = $db->query("select * from posts where id = :id", [':id' => $id])->findOrFail();

authorize($post['user_id'] === $currentUserID);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_method'] ?? null) === 'PATCH') {
    $form = PostForm::validate([
        'title' => $_POST['title'] ?? '',
        'content' => $_POST['content'] ?? '',
    ]);

    if ($form->valid()) {
        $db->query('UPDATE POSTS SET title = :title, content = :content, updated_at = :updated_at WHERE id = :id', [
            ':id' => $id,
            ':title' => $form->attribute('title', $post['title'] ?? ''),
            ':content' => $form->attribute('content', $post['content'] ?? ''),
            ':updated_at' => (new \DateTime())->format('Y-m-d H:i:s'),
        ]);

        redirect('/post?id=' . $post['id']);
    }
}

$heading = "{$post['title']} - Edit Post";
$errors = Session::get('errors', []);

view("posts/edit.view.php", compact("heading", "post", "errors"));