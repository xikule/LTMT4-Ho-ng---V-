<?php
// Thông tin kết nối
$servername = "localhost";   // hoặc IP máy chủ
$username = "root";          // tài khoản đăng nhập MySQL
$password = "";              // mật khẩu (để trống nếu dùng XAMPP mặc định)
$database = "dataproject";      // thay bằng tên cơ sở dữ liệu thực tế
// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database);
?>
