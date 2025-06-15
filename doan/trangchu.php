<?php
session_start();
ob_start();
include "user.php";
include "connect.php";

// Xử lý đăng nhập
$text_error = '';
if (isset($_POST['login'])) {
    $user = $_POST['userdn'] ?? '';
    $pass = $_POST['passdn'] ?? '';
    $sql = "SELECT * FROM testing WHERE user = '$user' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        if ($row['pass'] == $pass) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['user'] = $row['user'];
            $_SESSION['role'] = $row['role'] ?? 0;
            echo "<script>alert('Đăng nhập thành công!'); window.location='trangchu.php';</script>";
            exit;
        } else {
            $text_error = "Sai mật khẩu!";
        }
    } else {
        $text_error = "Tên đăng nhập không tồn tại!";
    }
}

// Xử lý đăng ký
if (isset($_POST['register'])) {
    $user = $_POST['user'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $get_data = new data_user();
    $insert = $get_data->register($user, $email, $pass);
    if ($insert) {
        echo "<script>alert('Đăng ký thành công!');window.location='trangchu.php';</script>";
        exit;
    } else {
        echo "<script>alert('Đăng ký không thành công!')</script>";
    }
}

// Xử lý đăng xuất
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location:trangchu.php");
    exit();
}

// Xử lý tìm kiếm chuyến xe
$diemKH = $_GET['diemKH'] ?? '';
$diemKT = $_GET['diemKT'] ?? '';
$lichTrinh = $_GET['lichTrinh'] ?? '';
$get_data = new data_chuyendi();
$result = $get_data->search_chuyendi($diemKH, $diemKT, $lichTrinh);
$chuyenXeList = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $chuyenXeList[] = [
            'id_cd' => $row['id_cd'],
            'tenNX' => $row['tenNX'],
            'diemKH' => $row['diemKH'],
            'diemKT' => $row['diemKT'],
            'lichTrinh' => $row['lichTrinh'],
            'gia' => $row['gia']
        ];
    }
}
ob_end_flush();
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

<!-- Hero section -->
<section class="bg-blue-600 text-white py-20 text-center">
    <h2 class="text-4xl font-bold mb-4">Đặt vé xe khách dễ dàng và nhanh chóng</h2>
    <p class="mb-6">Tìm chuyến xe phù hợp, so sánh giá và đặt vé chỉ trong vài phút.</p>
    <!-- Form tìm kiếm chuyến xe -->
    <form class="bg-white rounded-xl p-4 shadow-md max-w-2xl mx-auto text-gray-700 grid grid-cols-1 md:grid-cols-3 gap-4" method="get" action="">
        <input type="text" name="diemKH" placeholder="Điểm đi" class="p-2 rounded-lg border border-gray-300" value="<?= htmlspecialchars($diemKH) ?>" />
        <input type="text" name="diemKT" placeholder="Điểm đến" class="p-2 rounded-lg border border-gray-300" value="<?= htmlspecialchars($diemKT) ?>" />
        <input type="date" name="lichTrinh" class="p-2 rounded-lg border border-gray-300" value="<?= htmlspecialchars($lichTrinh) ?>" />
        <div class="md:col-span-3 text-center">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700">Tìm chuyến xe</button>
        </div>
    </form>
</section>

<!-- Kết quả tìm kiếm chuyến xe -->
<div class="max-w-4xl mx-auto mt-8 bg-white rounded-2xl shadow-xl p-6 border-2 border-blue-400">
    <?php if (empty($chuyenXeList)): ?>
        <div class="bg-yellow-100 border border-yellow-400 rounded p-4 text-blue-800 text-center">
            Không tìm thấy kết quả chuyến xe phù hợp.
        </div>
    <?php else: ?>
        <h3 class="text-2xl font-bold mb-6 text-blue-700 text-center">Kết quả tìm kiếm chuyến xe (<?= count($chuyenXeList) ?> chuyến)</h3>
        <div class="overflow-x-auto rounded-lg">
            <table class="w-full table-auto border border-gray-200 shadow-sm">
                <thead class="bg-gradient-to-r from-blue-200 to-blue-400 text-blue-900 text-base">
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-blue-300">Nhà xe</th>
                        <th class="px-6 py-3 border-b-2 border-blue-300">Điểm đi</th>
                        <th class="px-6 py-3 border-b-2 border-blue-300">Điểm đến</th>
                        <th class="px-6 py-3 border-b-2 border-blue-300">Lịch trình</th>
                        <th class="px-6 py-3 border-b-2 border-blue-300">Giá vé</th>
                        <th class="px-6 py-3 border-b-2 border-blue-300"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($chuyenXeList as $se_chuyenXeList): ?>
                        <tr class="hover:bg-blue-50 transition border-b border-blue-100 text-center">
                            <td class="p-3 font-semibold text-blue-700"><?= htmlspecialchars($se_chuyenXeList['tenNX']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($se_chuyenXeList['diemKH']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($se_chuyenXeList['diemKT']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($se_chuyenXeList['lichTrinh']) ?></td>
                            <td class="p-3 text-right font-bold text-green-600"><?= number_format($se_chuyenXeList['gia']) ?> đ</td>
                            <td class="p-3 text-center">
                                <form action="chitietve.php" method="POST">
                                    <input type="hidden" name="id_cd" value="<?= $se_chuyenXeList['id_cd'] ?>">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition font-semibold">Chọn</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- Thanh tính năng -->
        <div class="w-full flex flex-col md:flex-row justify-between items-center gap-4 text-sm px-4 py-4 mt-6 rounded-xl bg-gray-100 border border-gray-200">
            <div class="flex items-center gap-2">
                <span class="text-green-600 text-xl">✔</span>
                <span class="text-gray-700 font-medium">Chắc chắn có chỗ</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-yellow-600 text-xl">★</span>
                <span class="text-gray-700 font-medium">Nhiều ưu đãi</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-blue-600 text-xl">💳</span>
                <span class="text-gray-700 font-medium">Thanh toán đa dạng</span>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Modal Đăng nhập/Đăng ký -->
<div id="authModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-md relative">
        <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-red-600 text-xl">&times;</button>
        <div class="flex justify-center mb-6">
            <button id="loginTab" onclick="showTab('login')" class="px-4 py-2 font-semibold text-blue-600 border-b-2 border-blue-600">Đăng nhập</button>
            <button id="registerTab" onclick="showTab('register')" class="px-4 py-2 font-semibold text-gray-500 border-b-2 border-transparent hover:text-blue-600">Đăng ký</button>
        </div>
        <!-- Đăng nhập -->
        <form id="loginForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="mb-4">
                <label class="block mb-1 font-medium">Username</label>
                <input type="text" class="text-black w-full p-2 border border-gray-300 rounded-xl" name="userdn" placeholder="Tên đăng nhập" required />
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">Mật khẩu</label>
                <input type="password" class="text-black w-full p-2 border border-gray-300 rounded-xl" name="passdn" placeholder="********" required />
            </div>
            <input type="submit" class="w-full bg-blue-600 text-white py-2 rounded-xl hover:bg-blue-700" name="login" value="Đăng nhập"/>
            <?php if (!empty($text_error)) { ?>
                <p class="text-red-500 mt-2"><?php echo $text_error; ?></p>
            <?php } ?>
        </form>
        <!-- Đăng ký -->
        <form id="registerForm" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="mb-4">
                <label class="block mb-1 font-medium">Họ và tên</label>
                <input type="text" class="text-black w-full p-2 border border-gray-300 rounded-xl" name="user" placeholder="Nhập họ tên" required />
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">Email</label>
                <input type="email" class="text-black w-full p-2 border border-gray-300 rounded-xl" name="email" placeholder="hovaten@gmail.com" required />
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">Mật khẩu</label>
                <input type="password" class="text-black w-full p-2 border border-gray-300 rounded-xl" name="pass" placeholder="********" required />
            </div>
            <input type="submit" class="w-full bg-green-600 text-white py-2 rounded-xl hover:bg-green-700" name="register" value="Đăng ký" />
        </form>
    </div>
</div>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-6 mt-10">
    <div class="max-w-6xl mx-auto px-4 text-center text-sm">
        © 2025 XeKhach365. All rights reserved.
    </div>
</footer>

<!-- JavaScript: Open/Close Modal & Dropdown -->
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
function openModal() {
    document.getElementById('authModal').classList.remove('hidden');
    showTab('login');
}
function closeModal() {
    document.getElementById('authModal').classList.add('hidden');
}
function showTab(tab) {
    const loginTab = document.getElementById('loginTab');
    const registerTab = document.getElementById('registerTab');
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    if (tab === 'login') {
        loginForm.classList.remove('hidden');
        registerForm.classList.add('hidden');
        loginTab.classList.add('text-blue-600', 'border-blue-600');
        registerTab.classList.remove('text-blue-600', 'border-blue-600');
        registerTab.classList.add('text-gray-500');
    } else {
        loginForm.classList.add('hidden');
        registerForm.classList.remove('hidden');
        loginTab.classList.remove('text-blue-600', 'border-blue-600');
        loginTab.classList.add('text-gray-500');
        registerTab.classList.add('text-blue-600', 'border-blue-600');
    }
}
// Hiện lại modal đăng nhập nếu đăng nhập sai
window.onload = function() {
    <?php if (!empty($text_error)): ?>
        openModal();
    <?php endif; ?>
};
</script>
</body>
</html>
