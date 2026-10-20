<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: /login/login.php");
    exit();
}
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != "admin") {
    header("Location: /index.php");
    exit();
}
?>
