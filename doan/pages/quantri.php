<?php
session_start();
// Xử lý đăng xuất
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: ../trangchu.php");
    exit();
}
if (!isset($_SESSION['user']) || !isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    header('Location: trangchu.php');
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
  <span class="text-2xl font-bold text-blue-600">Admin Panel</span>
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
      <!-- Nội dung quản trị ở đây -->
    </main>
  </div>
</body>
</html>
