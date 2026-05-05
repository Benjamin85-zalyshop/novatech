<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = (int) $_POST['product_id'];
    $stmt = $conn->prepare('SELECT id, name, price FROM products WHERE id = ?');
    $stmt->bind_param('i', $productId);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();

    if ($product) {
        if (!isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = ['id' => $product['id'], 'name' => $product['name'], 'price' => (float) $product['price'], 'quantity' => 1];
        } else {
            $_SESSION['cart'][$productId]['quantity']++;
        }
        echo '<div class="alert alert-success">Produit ajouté au panier.</div>';
    }
}

$result = $conn->query('SELECT * FROM products ORDER BY category, name');
?>
<h2 class="mb-4">Boutique Novatech</h2>
<div class="row g-4">
<?php while ($row = $result->fetch_assoc()): ?>
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <span class="badge bg-secondary mb-2"><?= htmlspecialchars($row['category']); ?></span>
                <h5><?= htmlspecialchars($row['name']); ?></h5>
                <p class="text-muted small"><?= htmlspecialchars($row['description']); ?></p>
                <p class="fw-bold text-primary"><?= formatGNF((float) $row['price']); ?></p>
                <form method="post">
                    <input type="hidden" name="product_id" value="<?= (int) $row['id']; ?>">
                    <button class="btn btn-dark w-100">Ajouter au panier</button>
                </form>
            </div>
        </div>
    </div>
<?php endwhile; ?>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
