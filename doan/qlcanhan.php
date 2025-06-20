<?php
include "connect.php";
session_start();
$id = $_SESSION['id'];

// Xử lý đăng xuất
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location:trangchu.php");
    exit();
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
                        <a href="tkuser/guestuser.php" class="flex items-center gap-2 block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.755 6.879 2.047M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="font-semibold"><?= htmlspecialchars($_SESSION['user']); ?></span>
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
 <div class="flex justify-center mt-8">
    <div class="w-full max-w-6xl bg-white rounded-2xl shadow-xl p-6 border-2 border-blue-400">
    <?php
    include "connect.php";
    $id = $_SESSION['id'];
    // Lấy danh sách vé đã đặt của user
    $sql = "SELECT ve.*, chuyendi.*, nha_xe.tenNX
            FROM ve
            JOIN chuyendi ON ve.id_cd = chuyendi.id_cd
            JOIN nha_xe ON chuyendi.id_NX = nha_xe.id_NX
            WHERE ve.id = '$id'
            ORDER BY ve.ngayDi DESC";
    $result = mysqli_query($conn, $sql);
    ?>
    <h1 class="text-2xl font-bold text-blue-600 mb-4 text-center">Danh sách vé đã đặt</h1>

<?php if (mysqli_num_rows($result) == 0): ?>
    <div class="text-center text-gray-500 py-8">Bạn chưa đặt vé nào.</div>
<?php else: ?>
    <div class="overflow-x-auto">
        <table class="w-full table-fixed border border-gray-200 shadow-md rounded-xl overflow-hidden text-sm">
            <thead class="bg-gradient-to-r from-blue-200 to-blue-400 text-blue-900">
                <tr class="text-center">
                    <th class="w-1/6 px-4 py-2 border-b font-bold">Nhà xe</th>
                    <th class="w-1/6 px-4 py-2 border-b font-bold">Tuyến đường</th>
                    <th class="w-1/6 px-4 py-2 border-b font-bold">Lịch trình</th>
                    <th class="w-1/6 px-4 py-2 border-b font-bold">Ngày đi</th>
                    <th class="w-1/4 px-4 py-2 border-b font-bold">Ghế</th>
                    <th class="w-1/6 px-4 py-2 border-b font-bold">Tổng tiền</th>
                    <th class="w-1/6 px-4 py-2 border-b font-bold">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr class="hover:bg-blue-50 text-center align-middle">
                    <td class="px-4 py-2 text-gray-800"><?= htmlspecialchars($row['tenNX']) ?></td>
                    <td class="px-4 py-2 text-gray-800"><?= htmlspecialchars($row['tuyenDuong']) ?></td>
                    <td class="px-4 py-2 text-gray-800"><?= htmlspecialchars($row['lichTrinh']) ?></td>
                    <td class="px-4 py-2 text-gray-800"><?= htmlspecialchars($row['ngayDi']) ?></td>
                    <td class="px-4 py-2 text-blue-700 font-semibold break-words"><?= htmlspecialchars($row['ghe']) ?></td>
                    <td class="px-4 py-2 text-green-600 font-bold"><?= number_format($row['tongGia']) ?>đ</td>
                    <td class="px-4 py-2">
                        <?php if ($row['trangthai'] == 'Da thanh toan'): ?>
                            <form method="POST" action="huyve.php" onsubmit="return confirm('Bạn có chắc chắn muốn hủy vé này?');">
                                <input type="hidden" name="id_ve" value="<?= $row['id_ve'] ?>">
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow text-sm">
                                    Hủy vé
                                </button>
                            </form>
                        <?php elseif ($row['trangthai'] == 'Huy'): ?>
                            <span class="bg-yellow-400 text-white px-3 py-1 rounded shadow text-sm">
                                Chờ hoàn tiền
                            </span>
                        <?php elseif ($row['trangthai'] == 'Da hoan tien'): ?>
                            <span class="bg-green-500 text-white px-3 py-1 rounded shadow text-sm">
                                Đã hoàn tiền
                            </span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<div class="mt-8 flex justify-center">
    <a href="trangchu.php" class="bg-blue-600 text-white font-semibold px-6 py-2 rounded-xl shadow hover:bg-blue-700 transition">
        Quay lại trang chủ
    </a>
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