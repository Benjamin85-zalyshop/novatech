<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/header.php';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo '<div class="alert alert-warning">Panier vide. Ajoutez des produits avant de commander.</div>';
    require_once __DIR__ . '/../includes/footer.php';
    exit;
}

$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerName = trim($_POST['customer_name']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    $stmt = $conn->prepare('INSERT INTO orders (customer_name, phone, address, total_amount, currency, country) VALUES (?, ?, ?, ?, "GNF", "Guinée")');
    $stmt->bind_param('sssd', $customerName, $phone, $address, $total);
    $stmt->execute();
    $orderId = $stmt->insert_id;

    $itemStmt = $conn->prepare('INSERT INTO order_items (order_id, product_id, quantity, unit_price) VALUES (?, ?, ?, ?)');
    foreach ($_SESSION['cart'] as $item) {
        $itemStmt->bind_param('iiid', $orderId, $item['id'], $item['quantity'], $item['price']);
        $itemStmt->execute();
    }

    $_SESSION['cart'] = [];
    echo '<div class="alert alert-success">Commande enregistrée avec succès. Référence : #' . $orderId . '</div>';
}
?>
<h2>Validation de commande</h2>
<form method="post" class="card p-4 shadow-sm">
    <div class="mb-3"><label class="form-label">Nom complet</label><input name="customer_name" class="form-control" required></div>
    <div class="mb-3"><label class="form-label">Téléphone</label><input name="phone" class="form-control" required></div>
    <div class="mb-3"><label class="form-label">Adresse de livraison (Guinée)</label><textarea name="address" class="form-control" required></textarea></div>
    <p class="fw-bold">Montant total à payer : <?= formatGNF((float)$total); ?></p>
    <button class="btn btn-primary">Confirmer la commande</button>
</form>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
