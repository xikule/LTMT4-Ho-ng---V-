
<?php include '../check_login.php'; ?>

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
          <ul class="divide-y">
            <li class="py-2 flex justify-between items-center">
              <span>Đơn #001 | Mã khách hàng #001 | 2 vé | 500.000 VND </span>
              <div class="space-x-2">
                <button class="bg-yellow-400 px-2 py-1 rounded text-white">Sửa</button>
                <button class="bg-red-500 px-2 py-1 rounded text-white">Xóa</button>
              </div>
            </li>
          </ul>
        </div>
      </section>

    </main>
  </div>
</body>
</html>
