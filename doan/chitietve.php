<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Chi tiết vé</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

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

  <div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-2xl font-bold text-blue-600 mb-4">Chi tiết vé xe</h1>
    <div class="space-y-4">
      <div>
        <span class="font-semibold">Mã vé:</span> #123456789
      </div>
      <div>
        <span class="font-semibold">Họ tên:</span> Nguyễn Văn A
      </div>
      <div>
        <span class="font-semibold">Tuyến đường:</span> Hà Nội - Đà Nẵng
      </div>
      <div>
        <span class="font-semibold">Thời gian khởi hành:</span> 08:00  -  01/06/2025
      </div>
      <div>
        <span class="font-semibold">Số ghế:</span> 12A
      </div>
      <div>
        <span class="font-semibold">Giá vé:</span> <span id="ticket-price">450000</span>đ
      </div>
      <div>
        <label for="voucher" class="block font-semibold">Mã giảm giá:</label>
        <div class="flex gap-2 mt-1">
          <input id="voucher" type="text" class="border rounded px-1 py-1 w-full" placeholder="Nhập mã giảm giá" />
          <button onclick="applyVoucher()" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Dùng</button>
        </div>
        <p id="voucher-message" class="text-sm mt-1 text-green-600 hidden">Mã giảm giá hợp lệ! Đã giảm 10%.</p>
      </div>
      <div id="payment-status">
        <span class="font-semibold">Trạng thái thanh toán:</span> <span class="text-red-500">Chưa thanh toán</span>
      </div>
    </div>

    <div class="mt-6 text-center space-y-4">
      <h2 class="text-lg font-semibold">Chọn phương thức thanh toán</h2>
      <div class="space-y-2">
        <button onclick="showQRCode('bank')" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Chuyển khoản ngân hàng</button>
        <button onclick="showQRCode('momo')" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded">Ví Momo</button>
        <button onclick="showQRCode('zalo')" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded">Ví ZaloPay</button>
      </div>

      <div id="qr-container" class="mt-4 hidden">
        <p class="font-medium mb-2">Quét mã QR để thanh toán:</p>
        <img id="qr-image" src="" alt="QR Code" class="mx-auto w-48 h-48 border p-2 bg-white" />
        <p class="text-sm text-gray-600 mt-2">Sau khi thanh toán, nhấn nút bên dưới để xác nhận.</p>
        <button onclick="confirmPayment()" class="bg-green-600 hover:bg-green-700 text-white mt-2 px-4 py-2 rounded">Xác nhận thanh toán</button>
      </div>
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

    function showQRCode(method) {
      const qrContainer = document.getElementById("qr-container");
      const qrImage = document.getElementById("qr-image");

      let qrSrc = "";
      switch (method) {
        case "bank":
          qrSrc = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=bank_transfer_demo";
          break;
        case "momo":
          qrSrc = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=momo_payment_demo";
          break;
        case "zalo":
          qrSrc = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=zalo_payment_demo";
          break;
      }
      qrImage.src = qrSrc;
      qrContainer.classList.remove("hidden");
    }

    function confirmPayment() {
      const status = document.getElementById("payment-status");
      status.innerHTML = '<span class="font-semibold">Trạng thái thanh toán:</span> <span class="text-green-600">Đã thanh toán</span>';
      document.getElementById("qr-container").innerHTML = '<p class="text-green-600 font-semibold">Cảm ơn bạn! Thanh toán đã được xác nhận.</p>';
    }

    function applyVoucher() {
      const code = document.getElementById("voucher").value.trim();
      const priceElement = document.getElementById("ticket-price");
      const message = document.getElementById("voucher-message");

      if (code === "GIAM10") {
        let price = parseInt(priceElement.innerText);
        const newPrice = Math.round(price * 0.9);
        priceElement.innerText = newPrice;
        message.classList.remove("hidden");
      } else {
        alert("Mã giảm giá không hợp lệ!");
      }
    }
  </script>

</body>
</html>
