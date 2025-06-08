<?php
session_start();

// If this is a login attempt, process it
if (isset($_POST['login']) && $_POST['login']) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $role = checkuser($user, $pass);
    $_SESSION['role'] = $role;
    if ($role == 1) {
        header("Location:pages/quantri.php");
        echo "<script>alert('Đăng nhập thành công!');</script>";
        exit();
    } else if ($role == 0) {
        header("Location:../doan/trangchu.php");
        echo "<script>alert('Đăng nhập thành công!');</script>";
        exit();
    } else {
        $text_error = "Tên đăng nhập hoặc mật khẩu không đúng!";
    }
}

// If this is an admin page, check for admin role
// Only allow access if role == 1
if (
    // Not logged in
    !isset($_SESSION['role'])
    // Or not admin
    || $_SESSION['role'] != 1
) {
    // If not already on the homepage, redirect
    if (basename($_SERVER['PHP_SELF']) != 'trangchu.php') {
        header("Location:../trangchu.php");
        exit();
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location:../doan/trangchu.php");
    exit();
}
?>
