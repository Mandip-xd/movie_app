<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/auth.php';
if (is_logged_in()) {
    require_once __DIR__ . '/csrf.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if (is_logged_in()): ?>
    <meta name="csrf-token" content="<?= htmlspecialchars(csrf_token()) ?>">
    <?php endif; ?>
    <title><?= isset($page_title) ? htmlspecialchars($page_title) : 'Movie Database' ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body data-admin="<?= is_logged_in() ? '1' : '0' ?>">
<header class="site-header">
    <h1 class="site-title">Movie Database</h1>
    <nav class="site-nav">
        <a href="index.php">Home</a>
        <?php if (is_logged_in()): ?>
            <a href="add.php">Add</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php" class="btn-login">Login</a>
        <?php endif; ?>
    </nav>
</header>
<main class="main-content">
