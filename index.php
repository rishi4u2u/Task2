<?php
include 'auth.php';
include 'db.php';

$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");

echo "<h2>Welcome, " . $_SESSION['user'] . "</h2>";
echo "<a href='create.php'>Create Post</a> | <a href='logout.php'>Logout</a><hr>";

while ($row = $result->fetch_assoc()) {
    echo "<h3>{$row['title']}</h3>";
    echo "<p>{$row['content']}</p>";
    echo "<small>{$row['created_at']}</small><br>";
    echo "<a href='edit.php?id={$row['id']}'>Edit</a> | ";
    echo "<a href='delete.php?id={$row['id']}'>Delete</a><hr>";
}
?>