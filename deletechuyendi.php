<?php
include('user.php');
$get_data=new data_chuyendi();
$delete=$get_data->delete_chuyendi($_GET['del']); //Gọi function tương ứng với tham số là giá trị truyền trang
if($delete) header('location:qlchuyendi.php');// nếu xóa thành công thì chuyển trang
else echo "Chưa thể xóa";
?>