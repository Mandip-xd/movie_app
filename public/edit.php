<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/csrf.php';

require_admin();

$id = (int) ($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT id, title, genre, release_year, rating, actors FROM movies WHERE id = ?");
$stmt->execute([$id]);
$movie = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$movie) {
    header('Location: index.php');
    exit;
}

$error = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify()) {
        $error = 'Invalid request. Please try again.';
    } else {
        $title = trim($_POST['title'] ?? '');
        $genre = trim($_POST['genre'] ?? '');
        $release_year = (int) ($_POST['release_year'] ?? 0);
        $rating = trim($_POST['rating'] ?? '');
        $actors = trim($_POST['actors'] ?? '');

        $rating_num = $rating !== '' ? (float) $rating : -1;
        $valid = $title !== '' && $genre !== '' && $release_year >= 1900 && $release_year <= 2100
            && $rating !== '' && $actors !== ''
            && strlen($title) <= 200 && strlen($genre) <= 100 && strlen($actors) <= 500
            && $rating_num >= 0 && $rating_num <= 10;
        if (!$valid) {
            $error = 'All fields required. Year 1900–2100, rating 0–10, check lengths.';
        } else {
            $stmt = $pdo->prepare("UPDATE movies SET title = ?, genre = ?, release_year = ?, rating = ?, actors = ? WHERE id = ?");
            $stmt->execute([$title, $genre, $release_year, $rating, $actors, $id]);
            $success = true;
            $movie = ['title' => $title, 'genre' => $genre, 'release_year' => $release_year, 'rating' => $rating, 'actors' => $actors];
        }
    }
}

$page_title = 'Edit Movie';
require_once __DIR__ . '/../includes/header.php';
?>

<?php if ($success): ?>
<p class="success-msg">Movie updated. <a href="index.php">Back to list</a></p>
<?php else: ?>
<div class="form-card">
    <h2>Edit Movie</h2>
    <form method="post" action="edit.php?id=<?= $id ?>">
        <?= csrf_field() ?>
        <label for="title">Title</label>
        <input type="text" id="title" name="title" required maxlength="200" value="<?= htmlspecialchars($movie['title']) ?>">
        <label for="genre">Genre</label>
        <input type="text" id="genre" name="genre" required maxlength="100" value="<?= htmlspecialchars($movie['genre']) ?>">
        <label for="release_year">Release Year</label>
        <input type="number" id="release_year" name="release_year" required min="1900" max="2100" value="<?= htmlspecialchars($movie['release_year']) ?>" title="Year between 1900 and 2100">
        <label for="rating">Rating</label>
        <input type="number" id="rating" name="rating" required min="0" max="10" step="0.1" value="<?= htmlspecialchars($movie['rating']) ?>" title="Rating 0–10 (one decimal)">
        <label for="actors">Actors</label>
        <input type="text" id="actors" name="actors" required maxlength="500" value="<?= htmlspecialchars($movie['actors']) ?>">
        <button type="submit" class="btn-primary">Update Movie</button>
        <a href="index.php" class="btn-link">Cancel</a>
    </form>
    <?php if ($error): ?>
    <p class="error-msg"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
</div>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
