<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/auth.php';

if (is_logged_in()) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Please enter username and password.';
    } else {
        $stmt = $pdo->prepare("SELECT id, username, password FROM admin WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $admin['id'];
            header('Location: index.php');
            exit;
        }
        $error = 'Invalid username or password.';
    }
}

$page_title = 'Admin Login';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="form-card">
    <h2>Admin Login</h2>
    <?php if (isset($_GET['setup'])): ?>
    <p class="success-msg">Admin password has been reset. Use username <strong>@dmin123</strong> and password <strong>@dmin123</strong>.</p>
    <?php endif; ?>
    <form method="post" action="login.php">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        <button type="submit" class="btn-primary">Login</button>
    </form>
    <?php if ($error): ?>
    <p class="error-msg"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
