<?php
session_start();
include "connect.php"; // Nếu cần kết nối CSDL
include "user.php";    // Nếu cần các hàm kiểm tra user

// Xử lý đăng nhập
if (isset($_POST['login'])) {
    $user = $_POST['userdn'] ?? '';
    $pass = $_POST['passdn'] ?? '';
    $role = checkuser($user, $pass); // Hàm này bạn tự định nghĩa, trả về 1 (admin), 0 (user), hoặc -1 (sai)
    if ($role === 1) {
        $_SESSION['role'] = 1;
        echo "<script>alert('Đăng nhập thành công!'); window.location='pages/quantri.php';</script>";
        exit();
    } else if ($role === 0) {
        $_SESSION['role'] = 0;
        echo "<script>alert('Đăng nhập thành công!'); window.location='../doan/trangchu.php';</script>";
        exit();
    } else {
        $text_error = "Tên đăng nhập hoặc mật khẩu không đúng!";
    }
}

// Kiểm tra quyền admin khi vào trang quản trị
if (
    // Chưa đăng nhập
    !isset($_SESSION['role'])
    // Hoặc không phải admin
    || $_SESSION['role'] != 1
) {
    // Nếu không phải đang ở trang chủ thì chuyển về trang chủ
    if (basename($_SERVER['PHP_SELF']) != 'trangchu.php') {
        header("Location:../trangchu.php");
        exit();
    }
}

// Xử lý đăng xuất
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location:../doan/trangchu.php");
    exit();
}
?>
