<?php
require_once __DIR__ . '/../includes/config.php';
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
session_destroy();
header("Location: " . url('index.php'));
exit();
?>
