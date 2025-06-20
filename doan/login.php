<?php
session_start();
include "connect.php";
include "user.php";

$redirect = $_GET['redirect'] ?? $_POST['redirect'] ?? 'trangchu.php';
$text_error = '';
$text_success = '';

// Xử lý đăng nhập
if (isset($_POST['login'])) {
    $user = $_POST['user'] ?? '';
    $pass = $_POST['pass'] ?? '';
    $sql = "SELECT * FROM user WHERE user = '$user' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        if ($row['pass'] == $pass) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['user'] = $row['user'];
            $_SESSION['role'] = $row['role'] ?? 0;
            if ($_SESSION['role'] == 1) {
                header("Location: pages/quantri.php");
                exit;
            } else {
                header("Location: $redirect");
                exit;
            }
        } else {
            $text_error = "Sai mật khẩu!";
        }
    } else {
        $text_error = "Tên đăng nhập không tồn tại!";
    }
}

// Xử lý đăng ký
if (isset($_POST['register'])) {
    $user = $_POST['user'] ?? '';
    $email = $_POST['email'] ?? '';
    $pass = $_POST['pass'] ?? '';
    // Kiểm tra trùng tài khoản
    $sql_check = "SELECT * FROM user WHERE user = '$user' OR email = '$email'";
    $result_check = mysqli_query($conn, $sql_check);
    if (mysqli_num_rows($result_check) > 0) {
        $text_error = "Tên đăng nhập hoặc email đã tồn tại!";
    } else {
        $get_data = new data_user();
        $insert = $get_data->register($user, $email, $pass);
        if ($insert) {
            // Đăng nhập luôn sau khi đăng ký thành công
            $sql = "SELECT * FROM user WHERE user = '$user' LIMIT 1";
            $result = mysqli_query($conn, $sql);
            if ($row = mysqli_fetch_assoc($result)) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['user'] = $row['user'];
                $_SESSION['role'] = $row['role'] ?? 0;
            }
            header("Location: $redirect");
            exit;
        } else {
            $text_error = "Đăng ký không thành công!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập & Đăng ký - XeKhach365</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-blue-50 min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-white shadow-md py-4">
        <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-blue-600">
                <a href="trangchu.php">XeKhach365</a>
            </h1>
        </div>
    </nav>
    <!-- Login/Register Form -->
    <div class="flex flex-1 items-center justify-center">
        <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-md mt-10">
            <div class="flex justify-center mb-6">
                <button id="loginTab" onclick="showTab('login')" class="px-4 py-2 font-semibold border-b-2">Đăng nhập</button>
                <button id="registerTab" onclick="showTab('register')" class="px-4 py-2 font-semibold border-b-2">Đăng ký</button>
            </div>
            <?php if ($text_error): ?>
                <div class="mb-4 text-red-600 text-center"><?= $text_error ?></div>
            <?php endif; ?>
            <!-- Đăng nhập -->
            <form id="loginForm" method="POST" action="login.php?redirect=<?= urlencode($redirect) ?>">
                <input type="hidden" name="redirect" value="<?= htmlspecialchars($redirect) ?>">
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Tên đăng nhập</label>
                    <input type="text" name="user" class="w-full p-2 border border-gray-300 rounded-xl" placeholder="Tên đăng nhập" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Mật khẩu</label>
                    <input type="password" name="pass" class="w-full p-2 border border-gray-300 rounded-xl" placeholder="********" required>
                </div>
                <div class="mb-4 h-14"></div>
                <button type="submit" name="login" class="w-full bg-blue-600 text-white py-2 rounded-xl hover:bg-blue-700 font-semibold">Đăng nhập</button>
            </form>
            <!-- Đăng ký -->
            <form id="registerForm" class="hidden" method="POST" action="login.php?redirect=<?= urlencode($redirect) ?>">
                <input type="hidden" name="redirect" value="<?= htmlspecialchars($redirect) ?>">
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Họ và tên</label>
                    <input type="text" name="fullname" class="w-full p-2 border border-gray-300 rounded-xl" placeholder="Họ và tên" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Email</label>
                    <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded-xl" placeholder="email@example.com" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Tên đăng nhập</label>
                    <input type="text" name="user" class="w-full p-2 border border-gray-300 rounded-xl" placeholder="Tên đăng nhập" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Mật khẩu</label>
                    <input type="password" name="pass" class="w-full p-2 border border-gray-300 rounded-xl" placeholder="********" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Nhập lại mật khẩu</label>
                    <input type="password" name="repass" id="repass" class="w-full p-2 border border-gray-300 rounded-xl" placeholder="********" required>
                </div>
                <button type="submit" name="register" class="w-full bg-green-600 text-white py-2 rounded-xl hover:bg-green-700 font-semibold">Đăng ký</button>
            </form>
            <div class="mt-6 text-center">
                <a href="<?= htmlspecialchars($redirect) ?>" class="text-gray-500 hover:text-blue-600 text-xs">Quay lại</a>
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
    window.onload = function() {
        <?php if (isset($_POST['register'])): ?>
            showTab('register');
        <?php else: ?>
            showTab('login');
        <?php endif; ?>
    }
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        var pass = document.querySelector('#registerForm input[name="pass"]').value;
        var repass = document.querySelector('#registerForm input[name="repass"]').value;
        if (pass !== repass) {
            alert('Mật khẩu nhập lại không khớp!');
            e.preventDefault();
            return false;
        }
    });
    </script>
</body>
</html>