<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/header.php';

$orders = $conn->query('SELECT * FROM orders ORDER BY created_at DESC');
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Tableau de bord admin</h2>
    <a href="logout.php" class="btn btn-outline-danger">Déconnexion</a>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <h5>Commandes reçues</h5>
        <table class="table table-striped">
            <thead><tr><th>#</th><th>Client</th><th>Téléphone</th><th>Montant</th><th>Date</th></tr></thead>
            <tbody>
            <?php while ($o = $orders->fetch_assoc()): ?>
                <tr>
                    <td>#<?= (int)$o['id']; ?></td>
                    <td><?= htmlspecialchars($o['customer_name']); ?></td>
                    <td><?= htmlspecialchars($o['phone']); ?></td>
                    <td><?= formatGNF((float)$o['total_amount']); ?></td>
                    <td><?= htmlspecialchars($o['created_at']); ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
