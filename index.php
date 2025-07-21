<?php
session_start();
require 'db.php';

$stmt = $pdo->prepare("SELECT * FROM posts WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User's Posts</title>
</head>
<body>
    <h1>Your Blog Posts</h1>
    <a href="create.php">Create New Post</a>
    <ul>
        <?php foreach ($posts as $post): ?>
            <li>
                <h2><?= htmlspecialchars($post['title']) ?></h2>
                <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                <a href="edit.php?id=<?= $post['id'] ?>">Edit</a> |
                <a href="delete.php?id=<?= $post['id'] ?>">Delete</a>
                <br>
                <br>
                <a href="logout.php">Logout</a>

            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
