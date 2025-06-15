<?php
include '../user.php';
$get_data=new data_nha_xe();
$delete=$get_data->delete_NX($_GET['del']); //Gọi function tương ứng với tham số là giá trị truyền trang
if($delete) header('location:qlnhaxe.php');// nếu xóa thành công thì chuyển trang
else echo "Chưa thể xóa";
?>