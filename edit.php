<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'db.php';

if (!isset($_GET['id'])) {
    die("No post ID specified.");
}

$post_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Ownership check
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ? AND user_id = ?");
$stmt->execute([$post_id, $user_id]);
$post = $stmt->fetch();

if (!$post) {
    die("Access denied or post not found.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ? AND user_id = ?");
    $stmt->execute([$title, $content, $post_id, $user_id]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form method="POST">
        <label>Title:</label><br>
        <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required><br><br>
        <label>Content:</label><br>
        <textarea name="content" rows="5" cols="30" required><?= htmlspecialchars($post['content']) ?></textarea><br><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
