<?php

use Core\{
    App,
    Database,
    Session,
};
use Http\Forms\PostForm;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentUserID = Session::get('user')['id'] ?? null;
    
    $form = PostForm::validate([
        'title' => $_POST['title'] ?? '',
        'content' => $_POST['content'] ?? '',
    ]);

    if ($form->valid()) {
        /**  @var \Core\Database $db */
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO TASKS (user_id, title, content, created_at, updated_at) VALUES (:user_id, :title, :content, :created_at, :updated_at)', [
            ':user_id' => $currentUserID,
            ':title' => $form->attribute('title'),
            ':content' => $form->attribute('content'),
            ':created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
            ':updated_at' => null,
        ]);

        $postID = $db->lastInsertID();

        redirect('/task?id=' . $postID);
    }
}

$heading = "Create Task";
$errors = Session::get('errors', []);

return view("tasks/create.view.php", compact("heading", "errors"));