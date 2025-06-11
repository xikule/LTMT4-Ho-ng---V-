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

      <?php
        require '../connect.php';
        $sql = "SELECT id_NX, tenNX FROM nha_xe";
        $result = $conn->query($sql);
      ?>
      <!-- Quản lý chuyến đi -->
      <section id="chuyen-di">
        <h3 class="text-xl font-semibold mb-2">Quản lý chuyến đi</h3>
        <div class="bg-white p-4 rounded shadow">
          <form class="space-y-2 mb-4" method="POST">
            <select class="w-full border rounded p-2" name="id_NX" id="id_NX" required>
              <option value="">-- Chọn nhà xe --</option>
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
            <input type="text" placeholder="Điểm khởi hành" class="w-full border p-2 rounded" name="diemKH" required>
            <input type="text" placeholder="Điểm kết thúc" class="w-full border p-2 rounded" name="diemKT" required>
            <input type="date" placeholder="Lịch trình" class="w-full border p-2 rounded" name="lichTrinh" required>
            <input type="text" placeholder="Giá vé" class="w-full border p-2 rounded" name="gia" required>
            <input type="submit" class="bg-blue-600 text-white px-4 py-2 rounded" name="themchuyendi" value="Thêm chuyến">
          
            <?php
                  include('../user.php');
                  $get_data=new data_chuyendi();
                  $selectchuyendi=$get_data->select_chuyendi();
            ?>

            <?php
                if(isset($_POST['themchuyendi']))
                {
                    $id_NX = $_POST['id_NX'] ?? '';
                    $diemKH = $_POST['diemKH'] ?? '';
                    $diemKT = $_POST['diemKT'] ?? '';
                    $lichTrinh = $_POST['lichTrinh'] ?? '';
                    $gia = $_POST['gia'] ?? '';

                    if($id_NX && $diemKH && $diemKT && $lichTrinh && $gia) {
                        $insert = $get_data->register($id_NX, $diemKH, $diemKT, $lichTrinh, $gia);
                        if($insert)
                            echo "<script>alert('Thêm chuyến đi thành công')</script>";
                        else
                            echo "<script>alert('Thêm không thành công')</script>";
                        header('location:qlchuyendi.php');
                        exit();
                    } else {
                        echo "<script>alert('Vui lòng nhập đầy đủ thông tin!')</script>";
                    }
                }
            ?>

          <!-- Hiển thị chuyến đi -->
            <?php 
            foreach($selectchuyendi as $se_pro)//Duyệt dữ liệu trả về từ database
            {// Duyệt dữ liệu đến đâu rồi thực hiện in vào các hàng trong bảng
              ?>
                <ul class="divide-y">
                  <li class="py-2">
                    <span>Nhà xe: <?php echo $se_pro['tenNX']?> | 
                    <?php echo $se_pro['diemKH']?> - <?php echo $se_pro['diemKT']?> <?php echo $se_pro['lichTrinh']?> | 
                    <?php echo $se_pro['gia']?>đ
                  </span>
                <div class="space-x-2">
                  <button class="bg-yellow-400 px-1 py-1 rounded text-white">
                    <a href="updatechuyendi.php?update=<?php echo $se_pro['id_cd']?>">Sửa</a></button>
                  <button class="bg-red-500 px-1 py-1 rounded text-white">
                    <a href="deletechuyendi.php?del=<?php echo $se_pro['id_cd']?>" onClick="if(confirm('Bạn có chắc chắn muốn xóa')) return true; else return false;">Xóa</a>
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
