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
      <style>
        body {
            margin: 0;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #f4edff, #f9f5ff);
            color: #2e003e;
        }

        h1 {
            text-align: center;
            color: #5e00a0;
        }

        a {
            color: #6b00cc;
            text-decoration: none;
            font-weight: 500;
        }

        a:hover {
            text-decoration: underline;
        }

        .new-post {
            display: block;
            width: max-content;
            margin: 10px auto 30px;
            padding: 10px 20px;
            background-color: #8e44ff;
            color: white;
            border-radius: 10px;
            text-align: center;
            transition: 0.3s;
        }

        .new-post:hover {
            background-color: #7200cc;
        }

        ul {
            list-style: none;
            padding: 0;
            max-width: 800px;
            margin: auto;
        }

        li {
            background-color: #ffffff;
            border: 1px solid #e3d6ff;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(128, 0, 128, 0.08);
        }

        h2 {
            color: #4c0070;
            margin-top: 0;
        }

        p {
            margin-bottom: 15px;
        }

        .actions {
            margin-top: 10px;
        }

        .actions a {
            margin-right: 15px;
            font-size: 14px;
        }

        .logout {
            display: block;
            margin: 40px auto 0;
            width: max-content;
            color: #9900cc;
        }
    </style>

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
