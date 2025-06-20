<?php
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

      <!-- Quản lý nhà xe -->
      <section id="nha-xe">
        <h3 class="text-xl font-semibold mb-2">Quản lý nhà xe</h3>
        <div class="bg-white p-4 rounded shadow">
          <form class="space-y-2 mb-4" method="POST" >
            <input type="text" placeholder="Tên nhà xe" class="w-full border p-2 rounded" name="tenNX">
            <input type="text" placeholder="Số điện thoại" class="w-full border p-2 rounded" name="soDT">
            <input type="submit" class="bg-blue-600 text-white px-4 py-2 rounded" name="themnhaxe" value="Thêm nhà xe">

            <?php
                  include('../user.php');//Chèn trang control vào bài
                  $get_data=new data_nha_xe();//Gọi đến class data
                  $select=$get_data->select_NX();//Gọi function select trong trang control
            ?>

            <?php
              if(isset($_POST['themnhaxe']))// Thực thị sau khi nhấn nút submit
                {

                  $insert=$get_data->register($_POST['tenNX'],
                                              $_POST['soDT']);
                  if($insert) 
                  echo "<script>alert('Thêm nhà xe thành công')</script>";
                  else echo "<script>alert('Thêm không thành công') </script>"; 
                  header('location:qlnhaxe.php');
                }
            ?>
        <!-- Hiển thị nhà xe -->
          <?php 
            foreach($select as $se_pro)//Duyệt dữ liệu trả về từ database
            {// Duyệt dữ liệu đến đâu rồi thực hiện in vào các hàng trong bảng
              ?>
                <ul class="divide-y">
                  <li class="py-2 flex justify-between items-center">
                    <span>Nhà xe: <?php echo $se_pro['tenNX']?> | Số điện thoại: <?php echo $se_pro['soDT']?></span>
                <div class="space-x-2">
                  <button class="bg-yellow-400 px-2 py-1 rounded text-white">
                    <a href="updateNX.php?up=<?php echo $se_pro['id_NX']?>">Sửa</a></button>
                  <button class="bg-red-500 px-2 py-1 rounded text-white">
                    <a href="delete.php?del=<?php echo $se_pro['id_NX']?>" onClick="if(confirm('Bạn có chắc chắn muốn xóa')) return true; else return false;">Xóa</a>
                  </button>
                </div>
                  </li>
                </ul>
              <?php } ?>
          </form>
        </div>
      </section>

    </main>
  </div>
</body>
</html>
