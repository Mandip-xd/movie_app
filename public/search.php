<?php
require_once __DIR__ . '/../config/db.php';

header('Content-Type: application/json; charset=utf-8');

$q = trim($_GET['q'] ?? '');
$genre = trim($_GET['genre'] ?? '');
$year_min = isset($_GET['year_min']) ? (int) $_GET['year_min'] : null;
$year_max = isset($_GET['year_max']) ? (int) $_GET['year_max'] : null;
$rating_min = isset($_GET['rating_min']) ? (float) $_GET['rating_min'] : null;
$rating_max = isset($_GET['rating_max']) ? (float) $_GET['rating_max'] : null;

$conditions = [];
$params = [];

if ($q !== '') {
    $term = '%' . $q . '%';
    $conditions[] = '(title LIKE ? OR genre LIKE ? OR actors LIKE ?)';
    $params[] = $term;
    $params[] = $term;
    $params[] = $term;
}

if ($genre !== '') {
    $conditions[] = 'genre LIKE ?';
    $params[] = '%' . $genre . '%';
}

if ($year_min !== null && $year_min > 0) {
    $conditions[] = 'release_year >= ?';
    $params[] = $year_min;
}

if ($year_max !== null && $year_max > 0) {
    $conditions[] = 'release_year <= ?';
    $params[] = $year_max;
}

if ($rating_min !== null && $rating_min >= 0) {
    $conditions[] = 'rating >= ?';
    $params[] = $rating_min;
}

if ($rating_max !== null && $rating_max >= 0) {
    $conditions[] = 'rating <= ?';
    $params[] = $rating_max;
}

$sql = 'SELECT id, title, genre, release_year, rating, actors FROM movies';
if (count($conditions) > 0) {
    $sql .= ' WHERE ' . implode(' AND ', $conditions);
}
$sql .= ' ORDER BY title';

if (count($params) > 0) {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
} else {
    $stmt = $pdo->query($sql);
}

$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($movies);
