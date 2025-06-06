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
                $sql="insert into nha_xe(tenNX,soDT)
                        values('$tenNX','$soDT')";
                echo $sql;
                $run=mysqli_query($conn,$sql);
                return $run;
            }
        public function select_NX()
            {
                global $conn;
                $sql="select * from nha_xe";// Lấy hết các bản ghi trong table thuộc database
                $run= mysqli_query($conn,$sql);
                return $run;
            }

        public function delete_NX($id_NX)
            {
            global $conn;
            $sql="delete from nha_xe where id_NX='$id_NX'";
            $run=mysqli_query($conn, $sql);
            return $run;
            }

        public function select_id_NX($id_NX)
            {
              global $conn;
              $sql="select * from nha_xe where id_NX='$id_NX'";
              $run=mysqli_query($conn, $sql);
              return $run;
            }
        public function update_NX($tenNX,$soDT,$id_NX)
            {
                global $conn;
                $sql= "update nha_xe set tenNX='$tenNX',
                                        soDT='$soDT' where id_NX='$id_NX'";
                $run= mysqli_query($conn, $sql);
                return $run;
            }
        }
        class data_user{
            public function register($fullname, $email, $pass)
            {
                global $conn;
                $sql="insert into testing(user,email,pass)
                        values('$fullname','$email','$pass')";
                echo $sql;
                $run=mysqli_query($conn,$sql);
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
            // Chuyến đi
        class data_chuyendi
        {
        public function register($id_NX,$diemKH,$diemKT,$lichTrinh,$gia)
            {
                global $conn;
                $sql="insert into chuyendi(id_NX,diemKH,diemKT,lichTrinh,gia)
                        values('$id_NX','$diemKH','$diemKT','$lichTrinh','$gia')";
                echo $sql;
                $run=mysqli_query($conn,$sql);
                return $run;
            }
        public function select_chuyendi()
            {
                global $conn;
                $sql = "select chuyendi.id_cd, nhaxe.tenNX, chuyendi.diemKH, chuyendi.diemKT, chuyendi.lichTrinh, chuyendi.gia 
                        from chuyendi join nhaxe on chuyendi.id_NX = nhaxe.id_NX";
                $run= mysqli_query($conn,$sql);
                return $run;
            }
        public function select_cd()
            {
                global $conn;
                $sql="select * from chuyendi";
                $run= mysqli_query($conn,$sql);
                return $run;
            }
        public function delete_chuyendi($id_cd)
            {
            global $conn;
            $sql="delete from chuyendi where id_cd='$id_cd'";
            $run=mysqli_query($conn, $sql);
            return $run;
            }

        public function select_id_cd($id_cd)
            {
              global $conn;
              $sql="select chuyendi.id_cd, nhaxe.tenNX, chuyendi.diemKH, chuyendi.diemKT, chuyendi.lichTrinh, chuyendi.gia 
                        from chuyendi join nhaxe on chuyendi.id_NX = nhaxe.id_NX where id_cd='$id_cd'";
              $run=mysqli_query($conn, $sql);
              return $run;
            }
        public function update_chuyendi($id_NX,$diemKH,$diemKT,$lichTrinh,$gia,$id_cd)
            {
                global $conn;
                $sql= "update chuyendi set id_NX='$id_NX',
                                        diemKH='$diemKH',
                                        diemKT='$diemKT',
                                        lichTrinh='$lichTrinh',
                                        gia='$gia' where id_cd='$id_cd'";
                $run= mysqli_query($conn, $sql);
                return $run;
            }
        }
?>
