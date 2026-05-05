<?php
session_start();
require_once __DIR__ . '/../includes/helpers.php';
if (!isAdminLoggedIn()) {
    header('Location: /admin/login.php');
    exit;
}
?>
