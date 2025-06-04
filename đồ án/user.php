<?php

function checkuser($user, $pass){
    $conn = connectdb(); // Gọi hàm kết nối CSDL (giả sử hàm connectdb() đã được định nghĩa trước)

    $stmt = $conn->prepare("SELECT * FROM testing WHERE user='".$user."' AND pass='".$pass."'"); 


    $stmt->execute(); // Thực thi câu lệnh SQL
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll();
    return $kq[0]['role'] ?? -1; // Trả về vai trò của người dùng, nếu không tìm thấy thì trả về -1
}
include('connect.php');
        // Nhà xe
        class data_nhaxe
        {
        public function register($tenNX,$soDT)
            {
                global $conn;
                $sql="insert into nhaxe(tenNX,soDT)
                        values('$tenNX','$soDT')";
                echo $sql;
                $run=mysqli_query($conn,$sql);
                return $run;
            }
        public function select_NX()
            {
                global $conn;
                $sql="select * from nhaxe";// Lấy hết các bản ghi trong table thuộc database
                $run= mysqli_query($conn,$sql);
                return $run;
            }

        public function delete_NX($id_NX)
            {
            global $conn;
            $sql="delete from nhaxe where id_NX='$id_NX'";
            $run=mysqli_query($conn, $sql);
            return $run;
            }

        public function select_id_NX($id_NX)
            {
              global $conn;
              $sql="select * from nhaxe where id_NX='$id_NX'";
              $run=mysqli_query($conn, $sql);
              return $run;
            }
        public function update_NX($tenNX,$soDT,$id_NX)
            {
                global $conn;
                $sql= "update nhaxe set tenNX='$tenNX',
                                        soDT='$soDT' where id_NX='$id_NX'";
                $run= mysqli_query($conn, $sql);
                return $run;
            }
        }

        // Khuyến mại
            class data_voucher
        {
        public function register($code,$discount_value)
            {
                global $conn;
                $sql="insert into voucher(code,discount_value)
                        values('$code','$discount_value')";
                echo $sql;
                $run=mysqli_query($conn,$sql);
                return $run;
            }
        public function select_voucher()
            {
                global $conn;
                $sql="select * from voucher";
                $run= mysqli_query($conn,$sql);
                return $run;
            }

        public function delete_voucher($id_voucher)
            {
            global $conn;
            $sql="delete from voucher where id_voucher='$id_voucher'";
            $run=mysqli_query($conn, $sql);
            return $run;
            }

        public function select_id_voucher($id_voucher)
            {
              global $conn;
              $sql="select * from voucher where id_voucher='$id_voucher'";
              $run=mysqli_query($conn, $sql);
              return $run;
            }
        public function update_voucher($code,$discount_value,$id_voucher)
            {
                global $conn;
                $sql= "update voucher set code='$code',
                                        discount_value='$discount_value' where id_voucher='$id_voucher'";
                $run= mysqli_query($conn, $sql);
                return $run;
            }
        }
?>