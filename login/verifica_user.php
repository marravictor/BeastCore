<?php
require_once __DIR__ . '/../includes/config.php';
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header("Location: " . url('login/login.php'));
    exit();
}
?>
