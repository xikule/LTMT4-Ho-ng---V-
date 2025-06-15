<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Đặt Vé Xe Khách</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

<!-- Navbar -->
<nav class="bg-white shadow-md py-4">
    <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-blue-600">
            <a href="trangchu.php">XeKhach365</a>
        </h1>
        <div class="space-x-4 hidden md:flex items-center">
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
            <?php if (isset($_SESSION['user'])): ?>
                <!-- Avatar + Dropdown -->
                <div class="relative">
                    <button id="avatarBtn" onclick="toggleDropdown()" type="button" class="w-9 h-9 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold focus:outline-none">
                        <span><?= strtoupper(substr($_SESSION['user'], 0, 1)); ?></span>
                    </button>
                    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-40 bg-white rounded shadow-lg z-50">
                        <a href="tkuser/guestuser.php" class="flex items-center gap-2 block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.755 6.879 2.047M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="font-semibold"><?= htmlspecialchars($_SESSION['user']); ?></span>
                        </a>
                        <a href="qlcanhan.php" class="flex items-center gap-2 block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h3m-7 0a4 4 0 014-4V7a4 4 0 00-4-4H7a4 4 0 00-4 4v10a4 4 0 004 4h10a4 4 0 004-4v-4a4 4 0 00-4-4h-3" />
                            </svg>
                            <span>Xem vé đã đặt</span>
                        </a>
                        <form method="post" action="">
                            <button type="submit" name="logout" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Đăng xuất</button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <button onclick="openModal()" class="bg-blue-600 text-white px-4 py-1 rounded-xl hover:bg-blue-700 transition">Đăng nhập</button>
            <?php endif; ?>
        </div>
    </div>
</nav>
<!-- Danh sách vé đã đặt mua -->
<div class="max-w-3xl mx-auto mt-6 bg-white rounded-xl shadow-lg p-6 border-2 border-blue-400">
    <?php
    include "connect.php";

    $id = $_SESSION['id'];

    // Lấy danh sách vé đã đặt của user, có tên nhà xe
    $sql = "SELECT ve.*, chuyendi.*, nha_xe.tenNX
            FROM ve
            JOIN chuyendi ON ve.id_cd = chuyendi.id_cd
            JOIN nha_xe ON chuyendi.id_NX = nha_xe.id_NX
            WHERE ve.id = '$id'
            ORDER BY ve.ngayDat DESC";
    $result = mysqli_query($conn, $sql);
    ?>
    <h1 class="text-2xl font-bold text-blue-600 mb-4 text-center">Danh sách vé đã đặt</h1>
    <?php if (mysqli_num_rows($result) == 0): ?>
        <div class="text-center text-gray-500 py-8">Bạn chưa đặt vé nào.</div>
    <?php else: ?>
        <table class="w-full table-auto border border-gray-200 text-center">
            <thead class="bg-blue-200 text-blue-900 text-sm">
                <tr>
                    <th class="px-4 py-2 border">Mã chuyến</th>
                    <th class="px-4 py-2 border">Nhà xe</th>
                    <th class="px-4 py-2 border">Tuyến đường</th>
                    <th class="px-4 py-2 border">Lịch trình</th>
                    <th class="px-4 py-2 border">Ngày đặt</th>
                    <th class="px-4 py-2 border">Ghế</th>
                    <th class="px-4 py-2 border">Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr class="hover:bg-blue-50 transition">
                    <td class="border px-2 py-1"><?= htmlspecialchars($row['id_cd']) ?></td>
                    <td class="border px-2 py-1"><?= htmlspecialchars($row['tenNX']) ?></td>
                    <td class="border px-2 py-1"><?= htmlspecialchars($row['tuyenDuong']) ?></td>
                    <td class="border px-2 py-1"><?= htmlspecialchars($row['lichTrinh']) ?></td>
                    <td class="border px-2 py-1"><?= htmlspecialchars($row['ngayDat']) ?></td>
                    <td class="border px-2 py-1"><?= htmlspecialchars($row['ghe']) ?></td>
                    <td class="border px-2 py-1 text-right"><?= number_format($row['tongGia']) ?> đ</td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <div class="mt-6 text-center">
        <a href="trangchu.php" class="inline-block bg-blue-600 text-white font-semibold px-6 py-2 rounded-xl shadow hover:bg-blue-700 transition">
            Quay lại trang chủ
        </a>
    </div>
</div>
</body>
</html>