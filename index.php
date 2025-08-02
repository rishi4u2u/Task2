<?php
session_start();
require 'db.php';

// Make sure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$limit = 5;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$page = max($page, 1);
$offset = ($page - 1) * $limit;

$search = $_GET['search'] ?? '';
$searchParam = '%' . $search . '%';

// Count user's own posts (with optional search)
if ($search) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM posts WHERE user_id = ? AND title LIKE ?");
    $stmt->execute([$user_id, $searchParam]);
} else {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM posts WHERE user_id = ?");
    $stmt->execute([$user_id]);
}
$total_posts = $stmt->fetchColumn();
$total_pages = ceil($total_posts / $limit);

// Fetch only that user's posts (with optional search)
if ($search) {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE user_id = ? AND title LIKE ? ORDER BY created_at DESC LIMIT ? OFFSET ?");
    $stmt->execute([$user_id, $searchParam, $limit, $offset]);
} else {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC LIMIT ? OFFSET ?");
    $stmt->execute([$user_id, $limit, $offset]);
}
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">

        <!-- Top Navigation -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">📝 My Blog</h1>
            <div>
                <a href="create.php" class="btn btn-success">+ New Post</a>
                <a href="logout.php" class="btn btn-outline-danger ms-2">Logout</a>
            </div>
        </div>

        <!-- Search -->
        <form class="d-flex mb-4" method="GET" action="index.php">
            <input class="form-control me-2" type="text" name="search" placeholder="Search posts..." value="<?= htmlspecialchars($search) ?>">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>

        <!-- Posts -->
        <?php if ($posts): ?>
            <?php foreach ($posts as $post): ?>
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <?php if (!empty($post['image'])): ?>
<img src="uploads/<?= htmlspecialchars($post['image']) ?>" class="img-fluid mb-2" style="max-height:300px; object-fit:cover;">
<?php endif; ?>
<h4 class="card-title"><?= htmlspecialchars($post['title']) ?></h4>
                        <p class="card-text"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                        <p class="text-muted small mb-2">Posted on: <?= $post['created_at'] ?></p>

                        <a href="edit.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                        <a href="delete.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-warning text-center">No posts found.</div>
        <?php endif; ?>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mt-4">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?search=<?= urlencode($search) ?>&page=<?= $page - 1 ?>">« Prev</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= ($i === $page) ? 'active' : '' ?>">
                        <a class="page-link" href="?search=<?= urlencode($search) ?>&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?search=<?= urlencode($search) ?>&page=<?= $page + 1 ?>">Next »</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</body>
</html>
