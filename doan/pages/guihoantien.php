<?php
include "../connect.php"; // Thêm dấu .. để quay về thư mục cha

if (isset($_POST['id_ve'])) {
    $id_ve = $_POST['id_ve'];

    // Lấy thông tin vé và email khách hàng
    $sql = "SELECT ve.*, user.email FROM ve 
            JOIN user ON ve.id = user.id 
            WHERE ve.id_ve = '$id_ve'";
    $result = mysqli_query($conn, $sql);
    $ve = mysqli_fetch_assoc($result);

    // Cập nhật trạng thái vé
    $sql_update = "UPDATE ve SET trangthai='Da hoan tien' WHERE id_ve='$id_ve'";
    mysqli_query($conn, $sql_update);

    // Gửi email thông báo hoàn tiền (giả lập)
    $to = $ve['email'];
    $subject = "Thông báo hoàn tiền vé xe";
    $message = "Kính gửi quý khách, vé mã số {$id_ve} đã được hoàn tiền. Xin cảm ơn!";
    $headers = "From: admin@xekhach365.vn\r\n";
    // mail($to, $subject, $message, $headers); // Bỏ comment nếu server hỗ trợ gửi mail

    echo "<script>alert('Đã gửi thông báo hoàn tiền cho khách!');window.location='qldonve.php';</script>";
    exit;
} else {
    echo "Không tìm thấy vé cần hoàn tiền!";
}
?>