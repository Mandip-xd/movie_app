<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/csrf.php';

$page_title = 'Movie Database';
require_once __DIR__ . '/../includes/header.php';

$stmt = $pdo->query("SELECT id, title, genre, release_year, rating, actors FROM movies ORDER BY title");
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="page-header">
    <h2>Movies</h2>

    <div class="search-section">
        <label for="search-input" class="search-label">Simple Search (title or keyword)</label>
        <input type="text" id="search-input" class="search-input" placeholder="Search by title or keyword… results update as you type (autocomplete)" autocomplete="off" maxlength="200" aria-label="Search by title or keyword">

        <details class="search-advanced-wrap">
            <summary class="search-advanced-summary">Advanced Search</summary>
            <div class="search-advanced">
                <label for="search-genre">Genre (category)</label>
                <input type="text" id="search-genre" class="search-advanced-input" placeholder="e.g. Drama" maxlength="100" aria-label="Filter by genre">
                <label for="search-year-min">Year from</label>
                <input type="number" id="search-year-min" class="search-advanced-input" placeholder="e.g. 1990" min="1900" max="2100" aria-label="Year from" title="1900–2100">
                <label for="search-year-max">Year to</label>
                <input type="number" id="search-year-max" class="search-advanced-input" placeholder="e.g. 2010" min="1900" max="2100" aria-label="Year to" title="1900–2100">
                <label for="search-rating-min">Rating from</label>
                <input type="number" id="search-rating-min" class="search-advanced-input" placeholder="e.g. 7" min="0" max="10" step="0.1" aria-label="Rating from" title="0–10">
                <label for="search-rating-max">Rating to</label>
                <input type="number" id="search-rating-max" class="search-advanced-input" placeholder="e.g. 10" min="0" max="10" step="0.1" aria-label="Rating to" title="0–10">
                <div class="search-advanced-actions">
                    <button type="button" id="search-advanced-btn" class="btn-primary btn-sm">Search</button>
                    <button type="button" id="search-clear-btn" class="btn-secondary btn-sm">Clear</button>
                </div>
            </div>
        </details>
    </div>
</div>

<div id="movie-list">
    <table class="movie-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Genre</th>
                <th>Year</th>
                <th>Rating</th>
                <th>Actors</th>
                <?php if (is_logged_in()): ?>
                <th>Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($movies as $m): ?>
            <tr>
                <td><?= htmlspecialchars($m['title']) ?></td>
                <td><?= htmlspecialchars($m['genre']) ?></td>
                <td><?= (int) $m['release_year'] ?></td>
                <td><?= htmlspecialchars($m['rating']) ?></td>
                <td><?= htmlspecialchars($m['actors']) ?></td>
                <?php if (is_logged_in()): ?>
                <td class="actions">
                    <a href="edit.php?id=<?= (int) $m['id'] ?>">Edit</a>
                    <form method="post" action="delete.php" class="form-delete-inline" onsubmit="return confirm('Delete this movie?');">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token()) ?>">
                        <input type="hidden" name="id" value="<?= (int) $m['id'] ?>">
                        <button type="submit" class="link-delete-btn">Delete</button>
                    </form>
                </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="../assets/js/search.js"></script>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
