<?php
include 'auth.php';
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);
    $stmt->execute();
    header("Location: index.php");
}
?>

<form method="post">
    Title: <input name="title"><br>
    Content:<br><textarea name="content"></textarea><br>
    <button type="submit">Create</button>
</form>