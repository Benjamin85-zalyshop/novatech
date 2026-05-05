<?php
function formatGNF(float $amount): string
{
    return number_format($amount, 0, ',', ' ') . ' GNF';
}

function isAdminLoggedIn(): bool
{
    return isset($_SESSION['admin_id']);
}
?>
