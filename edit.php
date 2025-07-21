<?php
include 'auth.php';
include 'db.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE posts SET title=?, content=? WHERE id=?");
    $stmt->bind_param("ssi", $title, $content, $id);
    $stmt->execute();
    header("Location: index.php");
}

$post = $conn->query("SELECT * FROM posts WHERE id=$id")->fetch_assoc();
?>

<form method="post">
    Title: <input name="title" value="<?= $post['title'] ?>"><br>
    Content:<br><textarea name="content"><?= $post['content'] ?></textarea><br>
    <button type="submit">Update</button>
</form>