<?php
session_start();
ob_start(); // Bắt đầu bộ đệm đầu ra
  include "user.php";
  include "connectdtb.php";
if(isset($_POST['login'])&&($_POST['login'])){
  $user=$_POST['user'];
  $pass=$_POST['pass'];
  $role=checkuser($user, $pass);
  $_SESSION['role'] = $role;
  if($role==1)header("Location: quantri.php");

  else if($role==0)
  {
    header("Location: trangchu.php"); 
    echo "<script>alert('Đăng nhập thành công!');</script>";
  }
  else echo "<script>alert('Đăng nhập thất bại!');</script>";
  ob_end_flush(); // Kết thúc bộ đệm đầu ra và gửi nội dung đến trình duyệt
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
        <a href="trangchu.html">XeKhach365</a>
      </h1>
      <div class="space-x-4 hidden md:flex items-center">
        <!--
        <a href="trangchu.html" class="text-gray-600 hover:text-blue-600">Trang chủ</a>
        -->
        <a href="#" class="text-gray-600 hover:text-blue-600">Tuyến xe</a>
        <a href="datve.html" class="text-gray-600 hover:text-blue-600">Đặt vé</a>
        <a href="#" class="text-gray-600 hover:text-blue-600">Liên hệ</a>
        <button onclick="openModal()" class="bg-blue-600 text-white px-4 py-1 rounded-xl hover:bg-blue-700 transition">Đăng nhập</button>
      </div>
    </div>
  </nav>

  <!-- Hero section (rút gọn) -->
  <section class="bg-blue-600 text-white py-20 text-center">
    <h2 class="text-4xl font-bold mb-4">Đặt vé xe khách dễ dàng và nhanh chóng</h2>
    <p class="mb-6">Tìm chuyến xe phù hợp, so sánh giá và đặt vé chỉ trong vài phút.</p>
    <!-- Tìm kiếm -->
    <form class="bg-white rounded-xl p-4 shadow-md max-w-2xl mx-auto text-gray-700 grid grid-cols-1 md:grid-cols-3 gap-4">
        <input type="text" placeholder="Điểm đi" class="p-2 rounded-lg border border-gray-300" />
        <input type="text" placeholder="Điểm đến" class="p-2 rounded-lg border border-gray-300" />
        <input type="date" class="p-2 rounded-lg border border-gray-300" />
        <div class="md:col-span-3 text-center">
          <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700">Tìm chuyến xe</button>
        </div>
      </form>
    </div>
  </section>
  <div class="bg-gradient-to-r from-[#4a6074] to-[#5d6d89] text-white py-3 px-6 mt-[-40px] relative z-0">
  <div class="flex justify-center items-center gap-10 text-sm font-semibold">
    <div class="flex items-center gap-2"><span class="text-yellow-400 text-xl">✔️</span> Chắc chắn có chỗ</div>
    <div class="flex items-center gap-2"><span class="text-yellow-400 text-xl">%</span> Nhiều ưu đãi</div>
    <div class="flex items-center gap-2"><span class="text-yellow-400 text-xl">🪙</span> Thanh toán đa dạng</div>
  </div>
</div>

  <!-- Modal -->
  <div id="authModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-md relative">
      <!-- Nút đóng -->
      <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-red-600 text-xl">&times;</button>

      <!-- Tabs -->
      <div class="flex justify-center mb-6">
        <button id="loginTab" onclick="showTab('login')" class="px-4 py-2 font-semibold text-blue-600 border-b-2 border-blue-600">Đăng nhập</button>
        <button id="registerTab" onclick="showTab('register')" class="px-4 py-2 font-semibold text-gray-500 border-b-2 border-transparent hover:text-blue-600">Đăng ký</button>
      </div>

      <!-- Nội dung Đăng nhập -->
      <form id="loginForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="mb-4">
          <label class="block mb-1 font-medium">Username</label>
          <input type="text" class="w-full p-2 border border-gray-300 rounded-xl" name="user" placeholder="Tên đăng nhập" required />
        </div>
        <div class="mb-4">
          <label class="block mb-1 font-medium">Mật khẩu</label>
          <input type="password" class="w-full p-2 border border-gray-300 rounded-xl" name="pass" placeholder="********" required />
        </div>
        <input type="submit" class="w-full bg-blue-600 text-white py-2 rounded-xl hover:bg-blue-700" name="login" value="Đăng nhập"/>
      </form>

      <!-- Nội dung Đăng ký -->
      <form id="registerForm" class="hidden" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="mb-4">
          <label class="block mb-1 font-medium">Họ và tên</label>
          <input type="text" class="w-full p-2 border border-gray-300 rounded-xl" name="fullname" placeholder="" required />
        </div>
        <div class="mb-4">
          <label class="block mb-1 font-medium">Email</label>
          <input type="email" class="w-full p-2 border border-gray-300 rounded-xl" name="email" placeholder="hovaten@gmail.com" required />
        </div>
        <div class="mb-4">
          <label class="block mb-1 font-medium">Mật khẩu</label>
          <input type="password" class="w-full p-2 border border-gray-300 rounded-xl" name="pass" placeholder="********" required />
        </div>
        <input type="submit" class="w-full bg-green-600 text-white py-2 rounded-xl hover:bg-green-700" name="register" value="Đăng ký" />
      </form>
      <?php
        if (isset($_POST['register'])) {
          $fullname = $_POST['fullname'];
          $email = $_POST['email'];
          $pass = $_POST['pass'];
          $get_data = new data_user();
          $insert = $get_data->register($fullname, $email, $pass);
        }
      ?>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white py-6 mt-10">
    <div class="max-w-6xl mx-auto px-4 text-center text-sm">
      © 2025 XeKhach365. All rights reserved.
    </div>
  </footer>

  <!-- JavaScript: Open/Close Modal -->
  <script>
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
  </script>

</body>
</html>
