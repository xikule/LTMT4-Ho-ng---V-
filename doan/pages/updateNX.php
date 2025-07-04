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

      <!-- Quản lý nhà xe -->
      <section id="nha-xe">
        <h3 class="text-xl font-semibold mb-2">Sửa nhà xe</h3>
        <div class="bg-white p-4 rounded shadow">

            <?php
                include '../user.php';
                $get_data=new data_nha_xe();
                $select_NX=$get_data->select_id_NX($_GET['up']);
                foreach($select_NX as $se_NX)
            ?>

        <form class="space-y-2 mb-4" method="POST" >
            Tên nhà xe: <input type="text" class="w-full border p-2 rounded" name="tenNX" value="<?php echo $se_NX['tenNX']?>">
            Số điện thoại: <input type="text" class="w-full border p-2 rounded" name="soDT" value="<?php echo $se_NX['soDT']?>">
            <input type="submit" class="bg-blue-600 text-white px-4 py-2 rounded" name="submit" value="Cập nhật">
        </form>

            <?php
              if(isset($_POST['submit']))// Thực thị sau khi nhấn nút submit
                {
                    $update = $get_data->update_NX($_POST['tenNX'],
                                                $_POST['soDT'],
                                                $_GET['up']);
                    if($update) header('location:qlkhuyenmai.php');
                    else echo "Không cập nhật được"; 
                }
            ?>
        </div>
      </section>

    </main>
  </div>
</body>
</html>
