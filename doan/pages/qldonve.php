<?php
include '../user.php';
include '../connect.php';
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
  <div class="flex min-h-screen">
    
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg p-6 space-y-4">
      <h2 class="text-2xl font-bold text-blue-600 mb-4"><a href="quantri.php">Admin Panel</a></h2>
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
        <h3 class="text-xl font-semibold mb-2">Quản lý đơn vé</h3>
        <div class="bg-white p-4 rounded shadow">
          <table border="1" cellpadding="8" cellspacing="0" class="min-w-full">
            <thead>
              <tr class="bg-gray-200 text-gray-600 uppercase text-sm">
                <th class="py-3 px-4">ID Vé</th>
                <th class="py-3 px-4">ID Chuyến đi</th>
                <th class="py-3 px-4">ID User</th>
                <th class="py-3 px-4">Tuyến đường</th>
                <th class="py-3 px-4">Giờ khởi hành</th>
                <th class="py-3 px-4">Ngày đi</th>
                <th class="py-3 px-4">Ghế</th>
                <th class="py-3 px-4">Tổng giá</th>
              </tr>
            </thead>
            <tbody class="text-gray-700 text-sm text-center" >
              <?php
              $sql = "SELECT * FROM ve ORDER BY ngayDat ASC";
              $result = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_assoc($result)):
              ?>
              <tr class="hover:bg-gray-100">
                <td class="py-2 px-4"><?= htmlspecialchars($row['id_ve']) ?></td>
                <td class="py-2 px-4"><?= htmlspecialchars($row['id_cd']) ?></td>
                <td class="py-2 px-4"><?= htmlspecialchars($row['id']) ?></td>
                <td class="py-2 px-4"><?= htmlspecialchars($row['tuyenDuong']) ?></td>
                <td class="py-2 px-4"><?= htmlspecialchars($row['lichTrinh']) ?></td>
                <td class="py-2 px-4"><?= htmlspecialchars($row['ngayDat']) ?></td>
                <td class="py-2 px-4"><?= htmlspecialchars($row['ghe']) ?></td>
                <td class="py-2 px-4"><?= htmlspecialchars($row['tongGia']) ?></td>
                <td class="py-2 px-4">
                </td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </section>

    </main>
  </div>
</body>
</html>
