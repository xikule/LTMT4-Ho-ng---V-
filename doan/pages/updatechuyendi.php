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

      <!-- Quản lý nhà xe -->
      <section id="nha-xe">
        <h3 class="text-xl font-semibold mb-2">Sửa chuyến đi</h3>
        <div class="bg-white p-4 rounded shadow">
            <?php
                include('../user.php');
                $get_data=new data_chuyendi();
                $select_cd = $get_data->select_id_cd($_GET['update']);
                foreach($select_cd as $se_cd)
            ?>
            <?php
                require '../connect.php';
                $sql = "SELECT id_NX, tenNX FROM nha_xe";
                $result = $conn->query($sql);
            ?>
        <form class="space-y-2 mb-4" method="POST" >
            Nhà xe:
            <select class="w-full border rounded p-2" name="id_NX" id="id_NX" value="<?php echo $se_cd['tenNX']?>" required>
              <option value="" disabled selected>-- Chọn nhà xe --</option>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id_NX'] . "' " . ($row['tenNX'] == $se_cd['tenNX'] ? 'selected' : '') . ">" . $row['tenNX'] . "</option>";
                    }
                } else {
                    echo "<option disabled>Không có nhà xe nào</option>";
                }
                ?>
            </select>
            Điểm khởi hành: <input type="text" class="w-full border p-2 rounded" name="diemKH" value="<?php echo $se_cd['diemKH']?>">
            Điểm kết thúc: <input type="text" class="w-full border p-2 rounded" name="diemKT" value="<?php echo $se_cd['diemKT']?>">
            Giờ khởi hành: <input type="time" class="w-full border p-2 rounded" name="lichTrinh" value="<?php echo $se_cd['lichTrinh']?>">
            Giá: <input type="text" class="w-full border p-2 rounded" name="gia" value="<?php echo $se_cd['gia']?>">
            <input type="submit" class="bg-blue-600 text-white px-4 py-2 rounded" name="submit" value="Cập nhật">
            <?php
              if(isset($_POST['submit']))// Thực thị sau khi nhấn nút submit
                {
                    $update = $get_data->update_chuyendi($_POST['id_NX'],
                                                        $_POST['diemKH'],
                                                        $_POST['diemKT'],
                                                     $_POST['lichTrinh'],
                                                            $_POST['gia'],
                                                        $_GET['update']);
                    if($update) header('location:qlchuyendi.php');
                    else echo "Không cập nhật được"; 
                }
            ?>
        </div>
        </form>
      </section>
    </main>
  </div>
</body>
</html>
