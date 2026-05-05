<?php
session_start();
require_once __DIR__ . '/../includes/header.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['remove'])) {
    $removeId = (int) $_GET['remove'];
    unset($_SESSION['cart'][$removeId]);
    header('Location: cart.php');
    exit;
}

$total = 0;
?>
<h2>Votre panier</h2>
<?php if (empty($_SESSION['cart'])): ?>
    <div class="alert alert-info">Votre panier est vide.</div>
<?php else: ?>
<table class="table table-bordered align-middle">
    <thead><tr><th>Produit</th><th>Prix</th><th>Qté</th><th>Sous-total</th><th></th></tr></thead>
    <tbody>
    <?php foreach ($_SESSION['cart'] as $item):
        $sub = $item['price'] * $item['quantity'];
        $total += $sub;
    ?>
    <tr>
        <td><?= htmlspecialchars($item['name']); ?></td>
        <td><?= formatGNF((float)$item['price']); ?></td>
        <td><?= (int)$item['quantity']; ?></td>
        <td><?= formatGNF((float)$sub); ?></td>
        <td><a href="?remove=<?= (int)$item['id']; ?>" class="btn btn-sm btn-danger">Retirer</a></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<h4>Total : <?= formatGNF((float)$total); ?></h4>
<a href="/orders/checkout.php" class="btn btn-success">Passer la commande</a>
<?php endif; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
