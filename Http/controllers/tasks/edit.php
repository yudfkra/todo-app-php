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
    Router::abort(404, "Invalid Task ID");
}

/** @var \Core\Database $db */
$db = App::resolve(Database::class);

$task = $db->query("select * from tasks where id = :id", [':id' => $id])->findOrFail();

authorize($task['user_id'] === $currentUserID);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_method'] ?? null) === 'PUT') {
    $hasUploadFile = !empty($_FILES) && isset($_FILES['image']);
    if (!$hasUploadFile) {
        PostForm::skipImageValidation();
    }

    $form = PostForm::validate([
        'title' => $_POST['title'] ?? '',
        'content' => $_POST['content'] ?? '',
        'status' => $_POST['status'] ?? '',
    ]);

    $imageFile = $task['file'];
    if ($hasUploadFile) {
        $form->uploadFile();

        if ($imageFile && file_exists($oldImagePath = public_path($imageFile))) {
            unlink($oldImagePath);
        }

        $imageFile = $form->attribute('image');
    }

    if ($form->valid()) {
        $db->query('UPDATE TASKS SET title = :title, content = :content, status = :status, file = :file, updated_at = :updated_at WHERE id = :id', [
            ':id' => $id,
            ':title' => $form->attribute('title', $task['title'] ?? ''),
            ':content' => $form->attribute('content', $task['content'] ?? ''),
            ':status' => $form->attribute('status', $task['status'] ?? ''),
            ':file' => $imageFile,
            ':updated_at' => (new \DateTime())->format('Y-m-d H:i:s'),
        ]);

        return redirect('/task?id=' . $task['id']);
    }
}

$heading = "{$task['title']} - Edit Task";
$errors = Session::get('errors', []);

view("tasks/edit.view.php", compact("heading", "task", "errors"));