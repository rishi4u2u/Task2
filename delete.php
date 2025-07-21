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

// Check ownership
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ? AND user_id = ?");
$stmt->execute([$post_id, $user_id]);
$post = $stmt->fetch();

if (!$post) {
    die("Access denied or post not found.");
}

// Proceed to delete
$stmt = $pdo->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?");
$stmt->execute([$post_id, $user_id]);

header("Location: index.php");
exit();
?>
