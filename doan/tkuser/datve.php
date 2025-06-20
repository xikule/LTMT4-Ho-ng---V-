<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đặt Vé Xe Khách</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <!-- Navbar -->
    <nav class="bg-white shadow-md py-4">
      <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-blue-600">
        <a href="../trangchu.php">XeKhach365</a>
        </h1>
        <div class="space-x-4 hidden md:flex items-center">
          
          <a href="#" class="text-gray-600 hover:text-blue-600">Tuyến xe</a>
          <a href="datve.php" class="text-gray-600 hover:text-blue-600">Đặt vé</a>
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
          <button onclick="openModal()" class="bg-blue-600 text-white px-4 py-1 rounded-xl hover:bg-blue-700 transition">Đăng nhập</button>
        </div>
      </div>
    </nav>

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
      <form id="loginForm">
        <div class="mb-4">
          <label class="block mb-1 font-medium">Email</label>
          <input type="email" class="w-full p-2 border border-gray-300 rounded-xl" placeholder="hovaten@gmail.com" required />
        </div>
        <div class="mb-4">
          <label class="block mb-1 font-medium">Mật khẩu</label>
          <input type="password" class="w-full p-2 border border-gray-300 rounded-xl" placeholder="********" required />
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-xl hover:bg-blue-700">Đăng nhập</button>
      </form>

      <!-- Nội dung Đăng ký -->
      <form id="registerForm" class="hidden">
        <div class="mb-4">
          <label class="block mb-1 font-medium">Họ và tên</label>
          <input type="text" class="w-full p-2 border border-gray-300 rounded-xl" placeholder="" required />
        </div>
        <div class="mb-4">
          <label class="block mb-1 font-medium">Email</label>
          <input type="email" class="w-full p-2 border border-gray-300 rounded-xl" placeholder="hovaten@gmail.com" required />
        </div>
        <div class="mb-4">
          <label class="block mb-1 font-medium">Mật khẩu</label>
          <input type="password" class="w-full p-2 border border-gray-300 rounded-xl" placeholder="********" required />
        </div>
        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-xl hover:bg-green-700">Đăng ký</button>
      </form>
    </div>
  </div>

  <div class="max-w-3xl mx-auto p-6 bg-white rounded-2xl shadow-lg mt-10">
    <h1 class="text-2xl font-bold text-center mb-6">Đặt Vé Xe Khách</h1>

    <form class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block font-medium mb-1">Điểm đi</label>
        <input type="text" placeholder="VD: Hà Nội" class="w-full p-2 border border-gray-300 rounded-xl" />
      </div>

      <div>
        <label class="block font-medium mb-1">Điểm đến</label>
        <input type="text" placeholder="VD: Sài Gòn" class="w-full p-2 border border-gray-300 rounded-xl" />
      </div>

      <div class="md:col-span-2">
        <label class="block font-medium mb-1">Ngày đi</label>
        <input type="date" class="w-full p-2 border border-gray-300 rounded-xl" />
      </div>

      <div class="md:col-span-2 text-center mt-4">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition">
          Tìm chuyến xe
        </button>
      </div>
    </form>

    <!-- Kết quả giả lập -->
    <div class="mt-8">
      <h2 class="text-lg font-semibold mb-4">Kết quả tìm kiếm</h2>
      <div class="space-y-4">
        <div class="p-4 border rounded-xl shadow-sm bg-gray-50">
          <p><strong>Hãng:</strong> Xe ABC</p>
          <p><strong>Thời gian:</strong> 08:00 - 20:00</p>
          <p><strong>Giá vé:</strong> 500.000đ</p>
          <button class="mt-2 bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700"><a href="chitietve.html">Đặt vé</a></button>
        </div>
        <!-- Bạn có thể thêm nhiều kết quả tương tự -->
      </div>
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
