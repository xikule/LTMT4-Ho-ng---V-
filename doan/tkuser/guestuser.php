<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../trangchu.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin tài khoản</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen font-sans">
    <!-- Header -->
    <nav class="bg-white shadow-md py-4">
        <div class="max-w-4xl mx-auto px-4 flex justify-between items-center">
            <a href="../trangchu.php" class="text-xl font-bold text-blue-600">XeKhach365</a>
            <div class="space-x-4 hidden md:flex items-center">
                <!--
                <a href="#" class="text-gray-600 hover:text-blue-600">Tuyến xe</a>
                <a href="datve.php" class="text-gray-600 hover:text-blue-600">Đặt vé</a>
                -->
                <!-- Trong phần navbar -->
            <div class="relative group">
            <a href="#" class="text-gray-600 hover:text-blue-600">Liên hệ</a>
            <div class="absolute left-1/2 -translate-x-1/2 mt-2 w-72 bg-white rounded shadow-lg z-50 p-3 text-sm hidden group-hover:block">
                <div>
                <span class="text-blue-600 font-semibold">1900969681</span> - Để phản hồi về dịch vụ và xử lý sự cố
                </div>
                <div class="mt-1">
                <span class="text-blue-600 font-semibold">1900888684</span> - Để đặt vé qua điện thoại (24/7)
                </div>
            </div>
            </div>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <div class="max-w-2xl mx-auto mt-10 bg-white rounded-xl shadow-lg p-8">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-16 h-16 rounded-full bg-blue-500 flex items-center justify-center text-white text-3xl font-bold">
                <?php
                    if (isset($_SESSION['user'])) {
                        echo strtoupper(substr($_SESSION['user'], 0, 1));
                    } else {
                        echo '?';
                    }
                ?>
            </div>
            <div>
                <div class="text-lg font-semibold">
                    <?php
                    if (isset($_SESSION['user'])) {
                        echo htmlspecialchars($_SESSION['user']);
                    } else {
                        echo 'Tài khoản';
                    }
                    ?>
                </div>
                <div class="text-gray-500 text-sm">Tài khoản thành viên</div>
            </div>
        </div>
        <hr class="mb-6">

        <div class="space-y-4">
            <a href="datve.php" class="block bg-blue-600 text-white px-4 py-2 rounded-lg text-center font-semibold hover:bg-blue-700 transition">Đặt vé mới</a>
            <a href="#" class="block bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-center font-semibold cursor-not-allowed">Lịch sử đặt vé (coming soon)</a>
            <a href="#" class="block bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-center font-semibold cursor-not-allowed">Cập nhật thông tin (coming soon)</a>
        </div>

        <form method="post" class="mt-8 text-center">
            <button type="submit" name="logout" class="bg-red-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-600 transition">Đăng xuất</button>
        </form>
        <?php
        if (isset($_POST['logout'])) {
            session_destroy();
            header("Location: ../trangchu.php");
            exit();
        }
        ?>
    </div>

    <footer class="text-center text-gray-500 text-sm mt-10">
        © 2025 XeKhach365. All rights reserved.
    </footer>
</body>
</html>