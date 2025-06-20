<?php
include "connect.php";
if (isset($_POST['id_ve'])) {
    $id_ve = $_POST['id_ve'];
    $sql = "UPDATE ve SET trangthai='Huy' WHERE id_ve='$id_ve'";
    mysqli_query($conn, $sql);
}
header("Location: qlcanhan.php");
exit;
?>