<?php
session_start();
include "user.php";
include "connect.php";

// Lấy dữ liệu tìm kiếm từ form
$diemKH = $_GET['diemKH'] ?? '';
$diemKT = $_GET['diemKT'] ?? '';
$lichTrinh = $_GET['lichTrinh'] ?? '';
$ngayDi = $_GET['ngayDi'] ?? '';

// Phân trang
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$limit = 8;
$offset = ($page - 1) * $limit;

// Đếm tổng số chuyến phù hợp
$sql_count = "SELECT COUNT(*) as total FROM chuyendi WHERE 1";
if ($diemKH) $sql_count .= " AND diemKH LIKE '%$diemKH%'";
if ($diemKT) $sql_count .= " AND diemKT LIKE '%$diemKT%'";
if ($lichTrinh) $sql_count .= " AND lichTrinh = '$lichTrinh'";
if ($ngayDi) $sql_count .= " AND ngayDi = '$ngayDi'";
$count_result = mysqli_query($conn, $sql_count);
$total = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total / $limit);

// Lấy danh sách chuyến xe
$sql = "SELECT chuyendi.id_cd, nha_xe.tenNX, chuyendi.diemKH, chuyendi.diemKT, chuyendi.lichTrinh, chuyendi.gia, chuyendi.ngayDi
        FROM chuyendi
        JOIN nha_xe ON chuyendi.id_NX = nha_xe.id_NX
        WHERE 1";
if ($diemKH) $sql .= " AND chuyendi.diemKH LIKE '%$diemKH%'";
if ($diemKT) $sql .= " AND chuyendi.diemKT LIKE '%$diemKT%'";
if ($lichTrinh) $sql .= " AND chuyendi.lichTrinh = '$lichTrinh'";
if ($ngayDi) $sql .= " AND chuyendi.ngayDi = '$ngayDi'";
$sql .= " LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);

$chuyenXeList = [];

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $chuyenXeList[] = [
            'id_cd' => $row['id_cd'],
            'tenNX' => $row['tenNX'],
            'diemKH' => $row['diemKH'],
            'diemKT' => $row['diemKT'],
            'lichTrinh' => $row['lichTrinh'],
            'gia' => $row['gia'],
            'ngayDi' => $row['ngayDi']
        ];
    }
}

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
                        <a href="" class="flex items-center gap-2 block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
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
                        <a href="logout.php?redirect=<?= urlencode($_SERVER['REQUEST_URI']) ?>" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Đăng xuất</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="login.php?redirect=<?= urlencode($_SERVER['REQUEST_URI']) ?>" class="bg-blue-600 text-white px-4 py-1 rounded-xl hover:bg-blue-700 transition">Đăng nhập</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<!-- Hero section -->
<section class="bg-blue-600 text-white py-20 text-center">
    <h2 class="text-4xl font-bold mb-4">Đặt vé xe khách dễ dàng và nhanh chóng</h2>
    <p class="mb-6">Tìm chuyến xe phù hợp, so sánh giá và đặt vé chỉ trong vài phút.</p>
    <!-- Form tìm kiếm chuyến xe -->
    <form class="bg-white rounded-xl p-4 shadow-md max-w-2xl mx-auto text-gray-700 grid grid-cols-1 md:grid-cols-4 gap-4" method="get" action="">
        <input type="text" name="diemKH" placeholder="Điểm đi" class="p-2 rounded-lg border border-gray-300" value="<?= htmlspecialchars($diemKH) ?>" />
        <input type="text" name="diemKT" placeholder="Điểm đến" class="p-2 rounded-lg border border-gray-300" value="<?= htmlspecialchars($diemKT) ?>" />
        <input type="time" name="lichTrinh" placeholder="Lịch trình" class="p-2 rounded-lg border border-gray-300" value="<?= htmlspecialchars($lichTrinh) ?>" />
        <input type="text" name="ngayDi" placeholder="yy/dd/mm" class="p-2 rounded-lg border border-gray-300" value="<?= htmlspecialchars($ngayDi) ?>" />
        <div class="md:col-span-4 text-center">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700">Tìm chuyến xe</button>
        </div>
    </form>
</section>
<!-- Kết quả tìm kiếm chuyến xe -->
<div class="flex justify-center mt-8">
    <div class="w-full max-w-6xl bg-white rounded-2xl shadow-xl p-6 border-2 border-blue-400">
        <!-- Thông tin tìm kiếm -->
        <?php if ($diemKH || $diemKT || $lichTrinh || $ngayDi): ?>
        <div class="mb-6 flex justify-center">
            <div class="bg-blue-100 border border-blue-300 rounded-xl px-6 py-3 text-blue-800 text-lg font-semibold flex items-center gap-2 shadow">
                Đã tìm thấy <span class="font-bold text-blue-700 text-xl"><?= $total ?></span> chuyến xe phù hợp
            </div>
        </div>
        <?php endif; ?>
        <table class="w-full table-auto border border-gray-200 shadow-sm">
            <thead class="bg-gradient-to-r from-blue-200 to-blue-400 text-blue-900 text-base">
                <tr class="text-center">
                    <th class="px-6 py-3 border-b-2 border-blue-300 font-bold text-lg">Nhà xe</th>
                    <th class="px-6 py-3 border-b-2 border-blue-300 font-bold text-lg">Điểm đi</th>
                    <th class="px-6 py-3 border-b-2 border-blue-300 font-bold text-lg">Điểm đến</th>
                    <th class="px-6 py-3 border-b-2 border-blue-300 font-bold text-lg">Lịch trình</th>
                    <th class="px-6 py-3 border-b-2 border-blue-300 font-bold text-lg">Ngày đi</th>
                    <th class="px-6 py-3 border-b-2 border-blue-300 font-bold text-lg">Giá vé</th>
                    <th class="px-6 py-3 border-b-2 border-blue-300 font-bold text-lg">Số ghế còn</th>
                    <th class="px-6 py-3 border-b-2 border-blue-300"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($chuyenXeList as $se_chuyenXeList): ?>
                    <?php
                        $id_cd = $se_chuyenXeList['id_cd'];
                        $ngayDi = $se_chuyenXeList['ngayDi'];
                        $sql_ghe = "SELECT ghe FROM ve WHERE id_cd = '$id_cd' AND ngayDi = '$ngayDi'";
                        $result_ghe = mysqli_query($conn, $sql_ghe);
                        $sold_seats = 0;
                        while ($row_ghe = mysqli_fetch_assoc($result_ghe)) {
                            $arr = explode(',', $row_ghe['ghe']);
                            foreach ($arr as $ghe) {
                                if (trim($ghe) !== '') $sold_seats++;
                            }
                        }
                        $total_seats = 32;
                        $available_seats = $total_seats - $sold_seats;
                    ?>
                    <tr class="hover:bg-blue-50 transition border-b border-blue-100 text-center align-middle">
                        <td class="p-4 font-semibold text-blue-700 text-lg align-middle"><?= htmlspecialchars($se_chuyenXeList['tenNX']) ?></td>
                        <td class="p-4 text-gray-800 align-middle"><?= htmlspecialchars($se_chuyenXeList['diemKH']) ?></td>
                        <td class="p-4 text-gray-800 align-middle"><?= htmlspecialchars($se_chuyenXeList['diemKT']) ?></td>
                        <td class="p-4 text-gray-800 align-middle"><?= htmlspecialchars($se_chuyenXeList['lichTrinh']) ?></td>
                        <td class="p-4 text-gray-800 align-middle"><?= htmlspecialchars($se_chuyenXeList['ngayDi']) ?></td>
                        <td class="p-4 text-right font-bold text-green-600 text-lg align-middle"><?= number_format($se_chuyenXeList['gia']) ?>đ</td>
                        <td class="p-4 text-blue-700 font-bold text-lg align-middle"><?= $available_seats ?> ghế</td>
                        <td class="p-4 text-center align-middle">
                            <?php if ($available_seats > 0): ?>
                                <form action="chitietve.php" method="GET">
                                    <input type="hidden" name="id_cd" value="<?= $se_chuyenXeList['id_cd'] ?>">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition font-semibold whitespace-nowrap">
                                        Đặt vé
                                    </button>
                                </form>
                            <?php else: ?>
                                <button class="bg-gray-400 text-white px-4 py-2 rounded-lg shadow font-semibold cursor-not-allowed opacity-70" disabled>
                                    Hết vé
                                </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- PHÂN TRANG -->
        <div class="flex justify-center mt-4 space-x-2">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>"
                class="px-3 py-1 rounded <?= $i == $page ? 'bg-blue-600 text-white' : 'bg-gray-200 text-blue-700' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>
    </div>
</div>
<!-- Footer -->
<footer class="bg-gray-800 text-white py-6 mt-10">
    <div class="max-w-6xl mx-auto px-4 text-center text-sm">
        © 2025 XeKhach365. All rights reserved.
    </div>
</footer>
<script>
function toggleDropdown() {
    const menu = document.getElementById('dropdownMenu');
    menu.classList.toggle('hidden');
}
document.addEventListener('click', function(event) {
    const avatarBtn = document.getElementById('avatarBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');
    if (avatarBtn && dropdownMenu && !avatarBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
        dropdownMenu.classList.add('hidden');
    }
});
</script>
</body>
</html>
