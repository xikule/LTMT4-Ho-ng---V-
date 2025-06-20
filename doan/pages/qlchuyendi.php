<?php
session_start();
include '../connect.php';
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

      <?php
        $sql = "SELECT id_NX, tenNX FROM nha_xe";
        $result = $conn->query($sql);
      ?>
      <!-- Quản lý chuyến đi -->
      <section id="chuyen-di">
        <h3 class="text-xl font-semibold mb-2">Quản lý chuyến đi</h3>
        <div class="bg-white p-4 rounded shadow">
          <form class="space-y-2 mb-4" method="POST">
            <select class="w-full border rounded p-2" name="id_NX" id="id_NX">
              <option value="" disabled selected>-- Chọn nhà xe --</option>
              <?php
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<option value='" . $row['id_NX'] . "'>" . $row['tenNX'] . "</option>";
                }
              } else {
                echo "<option disabled>Không có nhà xe nào</option>";
              }
              ?>
            </select>
            <input type="text" placeholder="Điểm khởi hành" class="w-full border p-2 rounded" name="diemKH">
            <input type="text" placeholder="Điểm kết thúc" class="w-full border p-2 rounded" name="diemKT">
            <input type="time" placeholder="Lịch trình" class="w-full border p-2 rounded" name="lichTrinh">
            <input type="date" placeholder="Ngày đi" class="w-full border p-2 rounded" name="ngayDi">
            <input type="text" placeholder="Giá vé" class="w-full border p-2 rounded" name="gia">
            <input type="submit" class="bg-blue-600 text-white px-4 py-2 rounded" name="themchuyendi" value="Thêm chuyến">
          </form>
          <!-- Form thêm và tìm kiếm chuyến đi -->
          <form class="space-y-2 mb-4" method="GET">
            <div class="flex gap-2">
              <input type="text" name="search_tenNX" placeholder="Tìm theo tên nhà xe" class="p-2 rounded-lg border border-gray-300 flex-1"
                value="<?= htmlspecialchars($_GET['search_tenNX'] ?? '') ?>" />
              <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Tìm</button>
            </div>
          </form>
          <?php
            include '../user.php';
            $get_data = new data_chuyendi();

            // Xử lý tìm kiếm chuyến đi theo tên nhà xe
            $search_tenNX = $_GET['search_tenNX'] ?? '';
            if ($search_tenNX != '') {
              $selectchuyendi = $get_data->search_chuyendi_by_tenNX($search_tenNX);
            } else {
              $selectchuyendi = $get_data->select_chuyendi();
            }
          ?>

          <?php
            if (isset($_POST['themchuyendi'])) {
              $insert = $get_data->register(
                $_POST['id_NX'],
                $_POST['diemKH'],
                $_POST['diemKT'],
                $_POST['lichTrinh'],
                $_POST['ngayDi'],
                $_POST['gia']
              );
              if ($insert)
                echo "<script>alert('Thêm nhà xe thành công')</script>";
              else
                echo "<script>alert('Thêm không thành công')</script>";
              header('location:qlchuyendi.php');
            }
          ?>

          <?php
          // Xác định trang hiện tại
          $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
          $limit = 10;
          $offset = ($page - 1) * $limit;

          // Nếu có tìm kiếm tên nhà xe
          $search_tenNX = $_GET['search_tenNX'] ?? '';
          if ($search_tenNX != '') {
              $sql = "SELECT chuyendi.*, nha_xe.tenNX 
                      FROM chuyendi 
                      JOIN nha_xe ON chuyendi.id_NX = nha_xe.id_NX
                      WHERE nha_xe.tenNX LIKE '%$search_tenNX%'
                      LIMIT $limit OFFSET $offset";
              $sql_count = "SELECT COUNT(*) as total 
                            FROM chuyendi 
                            JOIN nha_xe ON chuyendi.id_NX = nha_xe.id_NX
                            WHERE nha_xe.tenNX LIKE '%$search_tenNX%'";
          } else {
              $sql = "SELECT chuyendi.*, nha_xe.tenNX 
                      FROM chuyendi 
                      JOIN nha_xe ON chuyendi.id_NX = nha_xe.id_NX
                      LIMIT $limit OFFSET $offset";
              $sql_count = "SELECT COUNT(*) as total FROM chuyendi";
          }

          $result = mysqli_query($conn, $sql);
          $count_result = mysqli_query($conn, $sql_count);
          $total = mysqli_fetch_assoc($count_result)['total'];
          $total_pages = ceil($total / $limit);
          ?>

          <!-- Hiển thị chuyến đi -->
          <?php while ($se_pro = mysqli_fetch_assoc($result)): ?>
              <ul class="divide-y">
                  <li class="py-2 flex justify-between items-center">
                      <span>Nhà xe: <?= $se_pro['tenNX'] ?> |
                          <?= $se_pro['diemKH'] ?> - <?= $se_pro['diemKT'] ?> <?= $se_pro['lichTrinh'] ?> | <?= $se_pro['ngayDi'] ?> |
                          <?= $se_pro['gia'] ?>đ
                      </span>
                      <div class="space-x-2">
                          <button class="bg-yellow-400 px-2 py-1 rounded text-white">
                              <a href="updatechuyendi.php?update=<?= $se_pro['id_cd'] ?>">Sửa</a>
                          </button>
                          <button class="bg-red-500 px-2 py-1 rounded text-white">
                              <a href="deletechuyendi.php?del=<?= $se_pro['id_cd'] ?>" onClick="if(confirm('Bạn có chắc chắn muốn xóa')) return true; else return false;">Xóa</a>
                          </button>
                      </div>
                  </li>
              </ul>
          <?php endwhile; ?>

          <!-- Phân trang -->
          <div class="flex justify-center mt-4 space-x-2">
              <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                  <a href="?page=<?= $i ?>&search_tenNX=<?= urlencode($search_tenNX) ?>"
                     class="px-3 py-1 rounded <?= $i == $page ? 'bg-blue-600 text-white' : 'bg-gray-200 text-blue-700' ?>">
                      <?= $i ?>
                  </a>
              <?php endfor; ?>
          </div>
        </div>
      </section>
    </main>
  </div>
</body>
</html>

