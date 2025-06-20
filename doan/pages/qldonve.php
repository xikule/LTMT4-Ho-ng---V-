<?php
include '../user.php';
include '../connect.php';

session_start();
// Xử lý đăng xuất
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: ../trangchu.php");
    exit();
}
if (!isset($_SESSION['user']) || !isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    header('Location: ../trangchu.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang Quản Trị Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Navbar -->
  <nav class="bg-white shadow flex items-center justify-between px-8 py-3">
  <span class="text-2xl font-bold text-blue-600"><a href="quantri.php">Admin Panel</a></span>
  <div class="flex items-center space-x-4">
    <form method="post" action="">
      <button type="submit" name="logout" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded font-semibold">
        Đăng xuất
      </button>
    </form>
  </div>
</nav>
  <div class="flex min-h-screen">
    
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg p-6 space-y-4">
      <nav class="space-y-2">
        <a href="qlchuyendi.php" class="block py-2 px-3 rounded hover:bg-blue-100">Quản lý chuyến đi</a>
        <a href="qlnhaxe.php" class="block py-2 px-3 rounded hover:bg-blue-100">Quản lý nhà xe</a>
        <a href="qlkhuyenmai.php" class="block py-2 px-3 rounded hover:bg-blue-100">Quản lý khuyến mãi</a>
        <a href="qldonve.php" class="block py-2 px-3 rounded hover:bg-blue-100">Quản lý đơn vé</a>
      </nav>
    </aside>
    <!-- Content -->
<main class="flex-1 p-6 space-y-10">
  <!-- Quản lý đơn vé -->
  <section id="don-ve">
    <h3 class="text-xl font-semibold mb-4 text-blue-600 text-center">Quản lý đơn vé</h3>
    <div class="bg-white p-4 rounded-xl shadow">
      <div class="overflow-auto">
        <table class="min-w-full text-sm text-center border border-gray-200 rounded-xl shadow">
          <thead class="bg-gradient-to-r from-blue-200 to-blue-400 text-blue-900 uppercase">
            <tr>
              <th class="py-3 px-4 border">ID Vé</th>
              <th class="py-3 px-4 border">ID Chuyến đi</th>
              <th class="py-3 px-4 border">ID User</th>
              <th class="py-3 px-4 border">Tuyến đường</th>
              <th class="py-3 px-4 border">Giờ khởi hành</th>
              <th class="py-3 px-4 border">Ngày đi</th>
              <th class="py-3 px-4 border">Ghế</th>
              <th class="py-3 px-4 border">Tổng giá</th>
              <th class="py-3 px-4 border">Trạng thái</th>
              <th class="py-3 px-4 border">Thao tác</th>
            </tr>
          </thead>
          <tbody class="text-gray-800">
            <?php
            $sql = "SELECT * FROM ve ORDER BY ngayDi ASC";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)):
            ?>
            <tr class="hover:bg-blue-50 transition">
              <td class="py-2 px-4 border"><?= htmlspecialchars($row['id_ve']) ?></td>
              <td class="py-2 px-4 border"><?= htmlspecialchars($row['id_cd']) ?></td>
              <td class="py-2 px-4 border"><?= htmlspecialchars($row['id']) ?></td>
                <td class="py-2 px-4 border"><?= htmlspecialchars($row['tuyenDuong']) ?></td>
                <td class="py-2 px-4 border"><?= htmlspecialchars($row['lichTrinh']) ?></td>
              <td class="py-2 px-4 border"><?= htmlspecialchars($row['ngayDi']) ?></td>
              <td class="py-2 px-4 border break-words max-w-[180px] text-blue-600 font-medium">
                <?= htmlspecialchars($row['ghe']) ?>
              </td>
              <td class="py-2 px-4 border text-green-600 font-bold">
                <?= number_format($row['tongGia'], 0, ',', '.') ?>đ
              </td>
              <td class="py-2 px-4 border font-semibold">
                <?= htmlspecialchars($row['trangthai']) ?>
              </td>
              <td class="py-2 px-4 border">
                <?php if ($row['trangthai'] == 'Huy'): ?>
                  <form action="guihoantien.php" method="POST">
                    <input type="hidden" name="id_ve" value="<?= $row['id_ve'] ?>">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm shadow">
                      Gửi hoàn tiền
                    </button>
                  </form>
                <?php else: ?>
                  <span class="text-gray-400 italic text-sm">---</span>
                <?php endif; ?>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</main>
  </div>
</body>
</html>
