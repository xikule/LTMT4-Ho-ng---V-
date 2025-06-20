<?php
session_start();
include "connect.php";
include "user.php";

$user = $_SESSION['user'] ?? 'Khách'; // Lấy từ session, nếu chưa có thì để 'Khách'
$id_cd = $_POST['id_cd'] ?? $_GET['id_cd'] ?? null;

if (!$id_cd) {
    header('Location: trangchu.php');
    exit;
}
$model = new data_chuyendi();
$se_chuyenXeList = $model->select_id_cd($id_cd);

if (isset($_POST['thanhtoan'])) {
    if (!isset($_SESSION['user'])) {
        echo "<script>alert('Bạn cần đăng nhập để thanh toán!')</script>";
        exit;
    }
    // Lấy id người dùng từ session
    $id = $_SESSION['id'] ?? null;
    $id_cd = $_POST['id_cd'];
    $tuyenDuong = $_POST['tuyenDuong'];
    $lichTrinh = $_POST['lichTrinh'];
    $ngayDi = $_POST['ngayDi'];
    $ghe = $_POST['ghe'];
    $tongGia = $_POST['tongGia'];
    $trangthai = $_POST['trangthai'];

    // Kiểm tra id hợp lệ
    if (!$id) {
        echo "<script>alert('Không xác định được người dùng!');window.location='trangchu.php';</script>";
        exit;
    }

    $get_data = new data_ve();
    $insert = $get_data->register($id_cd, $id, $tuyenDuong, $lichTrinh, $ngayDi, $ghe, $tongGia, $trangthai);
    if ($insert) {
        echo "<script>alert('Thanh toán thành công!');window.location='trangchu.php';</script>";
        exit;
    } else {
        echo "<script>alert('Thanh toán không thành công!')</script>";
    }
}
// Xử lý đăng xuất
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location:trangchu.php");
    exit();
}
?>
<style>
#seat-selection {
    display: grid;
    grid-template-columns: repeat(2, 50px);
    gap: 10px;
    margin: 20px 0;
    justify-content: center;
}

.seat {
    width: 40px;
    height: 40px;
    background: #4CAF50;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.3s;
}

.seat.selected {
    background: #9C27B0;
}

.seat.unavailable {
    background: #9E9E9E;
    cursor: not-allowed;
}

.seat:hover {
    background: rgb(126, 111, 209);
}

#selected-seats,
#total-price,
#payment-status {
    margin-top: 10px;
    font-weight: bold;
    color: #555;
}
</style>
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
        <!--
        <a href="trangchu.php" class="text-gray-600 hover:text-blue-600">Trang chủ</a>
        <a href="#" class="text-gray-600 hover:text-blue-600">Tuyến xe</a>
        <a href="tkuser/datve.php" class="text-gray-600 hover:text-blue-600">Đặt vé</a>
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
        <?php if (isset($_SESSION['user'])): ?>
  <!-- Hiển thị avatar và tên -->
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
                        <a href="logout.php?redirect=<?= urlencode($_SERVER['REQUEST_URI']) ?>" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Đăng xuất</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="login.php?redirect=<?= urlencode($_SERVER['REQUEST_URI']) ?>" class="bg-blue-600 text-white px-4 py-1 rounded-xl hover:bg-blue-700 transition">Đăng nhập</a>
            <?php endif; ?>
      </div>
    </div>
  </nav>
</head>
<body>
<div class="max-w-4xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-2xl font-bold text-blue-600 mb-4">Chi tiết vé xe</h1>
    <?php foreach($se_chuyenXeList as $chuyenXeList): ?>
    <form method="POST" id="payment-form">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- BÊN TRÁI: Thông tin chuyến và chọn ghế -->
            <div class="flex-1">
                <div>
                    <span class="font-semibold">Nhà xe:</span> <?= $chuyenXeList['tenNX'] ?>
                </div>
                <div>
                    <span class="font-semibold">Tuyến đường:</span> <?= $chuyenXeList['diemKH'] ?> - <?= $chuyenXeList['diemKT'] ?>
                </div>
                <div>
                    <span class="font-semibold">Thời gian khởi hành:</span> <?= $chuyenXeList['lichTrinh'] ?>
                </div>
                <div>
                    <span class="font-semibold">Ngày đi:</span> <?= $chuyenXeList['ngayDi'] ?>
                </div>
                <div>
                    <span class="block font-semibold" id="ticket-price" data-gia="<?= $chuyenXeList['gia'] ?>">
                        Giá vé: <?= number_format($chuyenXeList['gia']) ?> đ/ghế
                    </span>
                </div>
                <div class="mt-4">
                    <span class="font-semibold">Chọn ghế</span>
                    <div class="grid gap-y-2" style="justify-content: center;">
    <?php
    $gheDaBan = [];
    $sql = "SELECT ghe FROM ve WHERE id_cd = '$id_cd'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $arr = explode(',', $row['ghe']);
        foreach ($arr as $ghe) {
            $ghe = trim($ghe);
            if ($ghe !== '') {
                $gheDaBan[] = (int)$ghe;
            }
        }
    }

    for ($i = 1; $i <= 32; $i += 4) {
        echo '<div class="flex justify-center gap-x-8 mb-2">';
        for ($j = 0; $j < 4; $j++) {
            $seatNumber = $i + $j;
            if ($seatNumber > 32) break;

            $class = 'seat';
            if (in_array($seatNumber, $gheDaBan)) {
                $class .= ' unavailable';
            }
            $style = ($j === 2) ? 'margin-left: 30px;' : '';
            echo '<div class="'.$class.'" style="'.$style.'" data-seat-number="'.$seatNumber.'">'.$seatNumber.'</div>';
        }
        echo '</div>';
    }
    ?>
</div>
                    <p class="block font-semibold">Ghế đã chọn: <span id="selected-seats">Chưa chọn ghế</span></p>
                </div>
            </div>
            <!-- BÊN PHẢI: Thanh toán -->
            <div class="w-full md:w-80 border-l md:pl-8 mt-8 md:mt-0">
                <div>
                    <label for="voucher" class="block font-semibold">Mã giảm giá:</label>
                    <select id="voucher" class="border rounded px-1 py-1 w-full">
                        <option value=""> --Chọn mã giảm giá--</option>
                        <?php
                        $result = mysqli_query($conn, "SELECT * FROM voucher");
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['discount_value'] . '">' . $row['code'] . ' - Giảm ' . ($row['discount_value']) . '%</option>';
                        }
                        ?>
                    </select>
                </div>
                <p class="block font-semibold mt-4">Tổng tiền: <span id="total-price">0 đ</span></p>
                <div class="mt-6 text-center space-y-4">
                    <h2 class="text-lg font-semibold">Chọn phương thức thanh toán</h2>
                    <div class="space-y-2">
                        <button type="button" onclick="showQRCode('bank')" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Chuyển khoản ngân hàng</button>
                        <button type="button" onclick="showQRCode('momo')" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded">Ví Momo</button>
                        <button type="button" onclick="showQRCode('zalo')" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded">Ví ZaloPay</button>
                    </div>
                    <div id="qr-container" class="mt-4 hidden">
                        <p class="font-medium mb-2">Quét mã QR để thanh toán:</p>
                        <img id="qr-image" src="" alt="QR Code" class="mx-auto w-48 h-48 border p-2 bg-white" />
                        <p class="text-sm text-gray-600 mt-2">Sau khi thanh toán, nhấn nút bên dưới để xác nhận.</p>
                    </div>
                </div>
                <!-- Hidden để gửi về server -->
                <input type="hidden" name="id_cd" value="<?= $chuyenXeList['id_cd'] ?>">
                <input type="hidden" name="tuyenDuong" value="<?= $chuyenXeList['diemKH'] ?> - <?= $chuyenXeList['diemKT'] ?>">
                <input type="hidden" name="lichTrinh" value="<?= $chuyenXeList['lichTrinh'] ?>">
                <input type="hidden" name="ngayDi" value="<?= $chuyenXeList['ngayDi'] ?>">
                <input type="hidden" name="ghe" id="selected_seats" value="">
                <input type="hidden" name="tongGia" id="total_price" value="">
                <input type="hidden" name="trangthai" value="Da thanh toan">
                <div class="flex justify-center mt-4">
                    <?php if (isset($_SESSION['user'])): ?>
        <button type="submit" name="thanhtoan" class="bg-blue-600 text-white px-6 py-2 rounded">Xác nhận thanh toán</button>
    <?php else: ?>
        <button type="button" class="bg-blue-600 text-white px-6 py-2 rounded">Đăng nhập để thanh toán</button>
    <?php endif; ?>
                </div>
            </div>
        </div>
    </form>
    <?php endforeach; ?>
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
        <?php if (isset($text_error)&&($text_error != "")) { ?>
          <p class="text-red-500 mt-2"><?php echo $text_error; ?></p>
        <?php } ?>
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
</div>
  <!-- Footer -->
  <footer class="bg-gray-800 text-white py-6 mt-10">
    <div class="max-w-6xl mx-auto px-4 text-center text-sm">
      © 2025 XeKhach365. All rights reserved.
    </div>
  </footer>
<script>
// Chọn ghế
let selectedSeats = [];
function selectSeats() {
    const seats = document.querySelectorAll('.seat');
    seats.forEach(seat => {
        seat.addEventListener('click', () => {
            if (seat.classList.contains('unavailable')) return;
            const seatNum = seat.dataset.seatNumber;
            if (!seat.classList.contains('selected')) {
                seat.classList.add('selected');
                selectedSeats.push(seatNum);
            } else {
                seat.classList.remove('selected');
                selectedSeats = selectedSeats.filter(s => s !== seatNum);
            }
            updateSelectedSeats();
        });
    });
}
function updateSelectedSeats() {
    document.getElementById('selected-seats').textContent =
        selectedSeats.length > 0 ? selectedSeats.join(', ') : 'Chưa chọn ghế';
    document.getElementById('selected_seats').value = selectedSeats.join(',');
    applyVoucher();
}

// Tính tổng tiền và áp dụng voucher
function applyVoucher() {
    const discount = parseFloat(document.getElementById("voucher").value) || 0;
    const basePrice = parseFloat(document.getElementById("ticket-price").dataset.gia);
    const total = basePrice * selectedSeats.length * (1 - discount / 100);
    document.getElementById("total-price").textContent = total.toLocaleString() + " đ";
    document.getElementById("total_price").value = total;
}
// Hiển thị mã QR
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

// Khi chọn voucher thì cập nhật lại tổng tiền
document.getElementById('voucher').addEventListener('change', applyVoucher);

// Đảm bảo cập nhật hidden trước khi submit
document.getElementById('payment-form').addEventListener('submit', function(e) {
    if (selectedSeats.length === 0) {
        alert('Vui lòng chọn ít nhất 1 ghế để thanh toán!');
        e.preventDefault();
        return false;
    }
    document.getElementById('selected_seats').value = selectedSeats.join(',');
    applyVoucher();
})

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
window.onload = function() {
    selectSeats();
};
</script>
</body>
</html>


