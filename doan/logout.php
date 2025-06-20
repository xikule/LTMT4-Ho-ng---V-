<?php
session_start();
$redirect = $_GET['redirect'] ?? 'trangchu.php';
session_destroy();
header("Location: $redirect");
exit;
?>