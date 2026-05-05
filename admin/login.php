<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/header.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare('SELECT id, password_hash FROM admins WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $admin = $stmt->get_result()->fetch_assoc();

    if ($admin && password_verify($password, $admin['password_hash'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $username;
        header('Location: /admin/dashboard.php');
        exit;
    }
    $error = 'Identifiants invalides.';
}
?>
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm p-4">
            <h3 class="mb-3">Admin Novatech</h3>
            <?php if ($error): ?><div class="alert alert-danger"><?= $error; ?></div><?php endif; ?>
            <form method="post">
                <div class="mb-3"><input name="username" class="form-control" placeholder="Nom d'utilisateur" required></div>
                <div class="mb-3"><input name="password" type="password" class="form-control" placeholder="Mot de passe" required></div>
                <button class="btn btn-dark w-100">Se connecter</button>
            </form>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
