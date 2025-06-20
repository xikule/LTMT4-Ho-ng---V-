<?php

include('connect.php');
        //testing user
        class data_user
        {
            public function register($user, $email, $pass)
            {
                global $conn;
                $sql="insert into user(user,email,pass)
                        values('$user','$email','$pass')";
                echo $sql;
                $run=mysqli_query($conn,$sql);
                return $run;
            }
        }
        // Nhà xe
        class data_nha_xe
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
        public function register($id_NX,$diemKH,$diemKT,$lichTrinh,$ngayDi,$gia)
            {
                global $conn;
                $sql="insert into chuyendi(id_NX,diemKH,diemKT,lichTrinh,ngayDi,gia)
                        values('$id_NX','$diemKH','$diemKT','$lichTrinh','$ngayDi','$gia')";
                echo $sql;
                $run=mysqli_query($conn,$sql);
                return $run;
            }
        public function select_chuyendi()
            {
                global $conn;
                $sql = "select chuyendi.id_cd, nha_xe.tenNX, chuyendi.diemKH, chuyendi.diemKT, chuyendi.lichTrinh, chuyendi.ngayDi, chuyendi.gia 
                        from chuyendi join nha_xe on chuyendi.id_NX = nha_xe.id_NX";
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
              $sql="select chuyendi.id_cd, nha_xe.tenNX, chuyendi.diemKH, chuyendi.diemKT, chuyendi.lichTrinh, chuyendi.ngayDi, chuyendi.gia 
                        from chuyendi join nha_xe on chuyendi.id_NX = nha_xe.id_NX where id_cd='$id_cd'";
              $run=mysqli_query($conn, $sql);
              return $run;
            }
        public function update_chuyendi($id_NX,$diemKH,$diemKT,$lichTrinh,$ngayDi,$gia,$id_cd)
            {
                global $conn;
                $sql= "update chuyendi set id_NX='$id_NX',
                                        diemKH='$diemKH',
                                        diemKT='$diemKT',
                                        lichTrinh='$lichTrinh',
                                        ngayDi='$ngayDi',
                                        gia='$gia' where id_cd='$id_cd'";
                $run= mysqli_query($conn, $sql);
                return $run;
            }
        public function search_chuyendi($diemKH, $diemKT, $lichTrinh, $ngayDi) {
            global $conn;
            $sql = "SELECT chuyendi.id_cd, nha_xe.tenNX, chuyendi.diemKH, chuyendi.diemKT, chuyendi.lichTrinh, chuyendi.gia, chuyendi.ngayDi 
                    FROM chuyendi 
                    JOIN nha_xe ON chuyendi.id_NX = nha_xe.id_NX
                    WHERE 1";
            if ($diemKH != '') $sql .= " AND chuyendi.diemKH LIKE '%$diemKH%'";
            if ($diemKT != '') $sql .= " AND chuyendi.diemKT LIKE '%$diemKT%'";
            if ($lichTrinh != '') $sql .= " AND chuyendi.lichTrinh = '$lichTrinh'";
            if ($ngayDi != '') $sql .= " AND chuyendi.ngayDi = '$ngayDi'";
            return mysqli_query($conn, $sql);
            }
        public function search_chuyendi_by_tenNX($tenNX) {
            global $conn;
            $sql = "SELECT chuyendi.*, nha_xe.tenNX 
                    FROM chuyendi 
                    JOIN nha_xe ON chuyendi.id_NX = nha_xe.id_NX
                    WHERE nha_xe.tenNX LIKE '%$tenNX%'";
            return mysqli_query($conn, $sql);
            }
        }
        // Vé
        class data_ve
        {
        public function register($id_cd,$id,$tuyenDuong,$lichTrinh,$ngayDi,$ghe,$tongGia, $trangthai)
            {
                global $conn;
                $sql="insert into ve(id_cd,id,tuyenDuong,lichTrinh,ngayDi,ghe,tongGia,trangthai)
                        values('$id_cd','$id','$tuyenDuong','$lichTrinh','$ngayDi','$ghe','$tongGia','$trangthai')";
                echo $sql;
                $run=mysqli_query($conn,$sql);
                return $run;
            }
        public function select_ve()
            {
                global $conn;
                $sql = "SELECT ve.id_ve, chuyendi.diemKH, chuyendi.diemKT, chuyendi.lichTrinh, ve.soLuong, ve.ngayDi, ve.trangThai 
                        FROM ve 
                        JOIN chuyendi ON ve.id_cd = chuyendi.id_cd";
                $run= mysqli_query($conn,$sql);
                return $run;
            }
        public function delete_ve($id_ve)
            {
            global $conn;
            $sql="delete from ve where id_ve='$id_ve'";
            $run=mysqli_query($conn, $sql);
            return $run;
            }
        public function select_id_ve($id_ve)
            {
              global $conn;
              $sql="select * from ve where id_ve='$id_ve'";
              $run=mysqli_query($conn, $sql);
              return $run;
            }
        }

?>
