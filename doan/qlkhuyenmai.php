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

      <!-- Quản lý khuyến mãi -->
      <section id="khuyen-mai">
        <h3 class="text-xl font-semibold mb-2">Quản lý khuyến mãi</h3>
        <div class="bg-white p-4 rounded shadow">
          <form class="space-y-2 mb-4" method="POST">
            <input type="text" placeholder="Mã khuyến mãi" class="w-full border p-2 rounded" name="code">
            <input type="text" placeholder="Phần trăm giảm" class="w-full border p-2 rounded" name="discount_value">
            <input type="submit" class="bg-blue-600 text-white px-4 py-2 rounded" name="themvoucher" value="Thêm mã">

            <?php
                  include('user.php');//Chèn trang control vào bài
                  $get_data=new data_voucher();//Gọi đến class data
                  $selectvoucher=$get_data->select_voucher();//Gọi function select trong trang control
            ?>
            <?php
              if(isset($_POST['themvoucher']))// Thực thị sau khi nhấn nút submit
                {

                  $insert=$get_data->register($_POST['code'],
                                    $_POST['discount_value']);
                  if($insert)
                  echo "<script>alert('Thêm nhà xe thành công')</script>";
                  else echo "<script>alert('Thêm không thành công')</script>"; 
                  header('location:qlkhuyenmai.php');
                }
            ?>
          <!-- Hiển thị nhà xe -->
          <?php 
            foreach($selectvoucher as $se_pro)//Duyệt dữ liệu trả về từ database
            {// Duyệt dữ liệu đến đâu rồi thực hiện in vào các hàng trong bảng
              ?>
                <ul class="divide-y">
                  <li class="py-2 flex justify-between items-center">
                    <span>Mã: <?php echo $se_pro['code']?> giảm <?php echo $se_pro['discount_value']?>%</span>
                    <div class="space-x-2">
                    <button class="bg-yellow-400 px-2 py-1 rounded text-white">
                    <a href="updatevoucher.php?up=<?php echo $se_pro['id_voucher']?>">Sửa</a></button>
                  <button class="bg-red-500 px-2 py-1 rounded text-white">
                    <a href="deletevoucher.php?del=<?php echo $se_pro['id_voucher']?>" onClick="if(confirm('Bạn có chắc chắn muốn xóa')) return true; else return false;">Xóa</a>
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
