<?php
    $username = "root";
    $password = "";
    $database = "invensmk";
    $hostname = "localhost";
    $con = mysqli_connect($hostname,$username,$password,$database) or die("Connection Corrupt");


    class KONTROLER{

        public function loginpetugas($username,$password){
            global $con;

            $sql = "SELECT * FROM petugas WHERE username ='$username'";
            $query = mysqli_query($con,$sql);
            $rows  = mysqli_num_rows($query);
            $assoc = mysqli_fetch_assoc($query);
            if($rows > 0){
                if(base64_decode($assoc['password']) == $password){
                    return ['response'=>'positive','alert'=>'Berhasil Login','level'=>$assoc['level']];
                }else{
                    return ['response'=>'negative','alert'=>'Password Salah'];
                }
            }else{

                return ['response'=>'negative','alert'=>'Username atau Password Salah'];
            }
        }

        public function loginpegawai($username,$password){
            global $con;

            $sql = "SELECT * FROM pegawai WHERE username ='$username'";
            $query = mysqli_query($con,$sql);
            $rows  = mysqli_num_rows($query);
            $assoc = mysqli_fetch_assoc($query);
            if($rows > 0){
                if(base64_decode($assoc['password']) == $password){
                    return ['response'=>'positive','alert'=>'Berhasil Login','level'=>$assoc['level']];
                }else{
                    return ['response'=>'negative','alert'=>'Password Salah'];
                }
            }else{

                return ['response'=>'negative','alert'=>'Username atau Password Salah'];
            }
        }

        public function registerPetugas($id_petugas,$username,$password,$name,$confirm,$level,$redirect){

            global $con;

            if($id_petugas == " " || empty($id_petugas) ||  empty($name) || $name == " " || empty($username) || $username == " " || empty($password) || $password == " "){
                return ['response'=>'negative','alert'=>'Lengkapi Form'];
            }

            $sql     = "SELECT * FROM petugas WHERE username = '$username'";
            $query   = mysqli_query($con,$sql);

            $rows    = mysqli_num_rows($query);

            if(strlen($username) < 6){
                return ['response'=>'negative','alert'=>'username minimal 6 Huruf'];
            }



            if($rows == 0){

                $name     = htmlspecialchars($name);

                $username = strtolower(htmlspecialchars($username));
                $password = htmlspecialchars($password);
                $confirm  = htmlspecialchars($confirm);

                if($password == $confirm){
                    $password = base64_encode($password);
                    $sql = "INSERT INTO petugas VALUES('$id_petugas','$username','$password','$name','$level','')";
                    $query   = mysqli_query($con,$sql);
                    if($query){
                        return ['response'=>'positive','alert'=>'Registrasi Berhasil','redirect'=>$redirect];
                    }else{

                        return ['response'=>'negative','alert'=>'Registrasi Error'];
                    }
                }else{

                    return ['response'=>'negative','alert'=>'Password Tidak Cocok'];
                }

            }else if($rows == 1){

                return ['response'=>'negative','alert'=>'Username telah digunakan'];
            }

        }

        public function registerPegawai($kd_user,$name,$username,$password,$confirm,$level,$redirect){

            global $con;

            if($kd_user == " " || empty($kd_user) ||  empty($name) || $name == " " || empty($username) || $username == " " || empty($password) || $password == " "){
                return ['response'=>'negative','alert'=>'Lengkapi Form'];
            }

            $sql     = "SELECT * FROM pegawai WHERE username = '$username'";
            $query   = mysqli_query($con,$sql);

            $rows    = mysqli_num_rows($query);

            if(strlen($username) < 6){
                return ['response'=>'negative','alert'=>'username minimal 6 Huruf'];
            }



            if($rows == 0){

                $name     = htmlspecialchars($name);

                $username = strtolower(htmlspecialchars($username));
                $password = htmlspecialchars($password);
                $confirm  = htmlspecialchars($confirm);

                if($password == $confirm){
                    $password = base64_encode($password);
                    $sql = "INSERT INTO pegawai VALUES('$kd_user','$name','$username','$password','$level')";
                    $query   = mysqli_query($con,$sql);
                    if($query){
                        return ['response'=>'positive','alert'=>'Registrasi Berhasil','redirect'=>$redirect];
                    }else{

                        return ['response'=>'negative','alert'=>'Registrasi Error'];
                    }
                }else{

                    return ['response'=>'negative','alert'=>'Password Tidak Cocok'];
                }

            }else if($rows == 1){

                return ['response'=>'negative','alert'=>'Username telah digunakan'];
            }

        }


        public function sessionCheck(){
            if(!isset($_SESSION['username'])){

                return "false";
            }else{

                return "true";
            }
        }


        public function deniedRequest(){
            if(!isset($denied)){
                return "true";
            }else{
                return "false";
            }
        }


        public function logout(){
            session_destroy();
            header("Location:./../index.php");
        }


        public function querySelect($sql){
            global $con;
            $query = mysqli_query($con,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;
        }


        public function select($table){
            global $con;
            $sql = "SELECT * FROM $table";
            $query = mysqli_query($con,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;
        }

        public function selectWhere($table,$where,$whereValues){
            global $con;
            $sql = "SELECT * FROM $table WHERE $where = '$whereValues'";
            $query = mysqli_query($con,$sql);
            return $data = mysqli_fetch_array($query);
        }

        public function selectWhereHabis($table,$where,$whereValues){
            global $con;
            $sql = "SELECT * FROM $table WHERE $where = '$whereValues'";
            $query = mysqli_query($con,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;
        }

        public function selectWhereOptional($table,$where,$whereValues,$optional){
            global $con;
            $sql = "SELECT $optional FROM $table WHERE $where = '$whereValues'";
            $query = mysqli_query($con,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function selectMax($table,$namaField){
            global $con;
            $sql = "SELECT MAX($namaField) as max FROM $table";
            $query = mysqli_query($con,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function selectMin($table,$namaField){
            global $con;
            $sql = "SELECT MIN($namaField) as min FROM $table";
            $query = mysqli_query($con,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function selectsum($table,$namaField){
            global $con;
            $sql = "SELECT SUM($namaField) as sum FROM $table";
            $query = mysqli_query($con,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function selectsumwhere($table,$namaField,$where){
            global $con;
            $sql = "SELECT SUM($namaField) as sum FROM $table WHERE $where";
            $query = mysqli_query($con,$sql);
            return $data = mysqli_fetch_assoc($query);
            // mamang
        }

        public function selectcount($table,$namaField){
            global $con;
            $sql = "SELECT COUNT($namaField) as count FROM $table";
            $query = mysqli_query($con,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function selectCountWhere($table,$namaField,$where){
            global $con;
            $sql = "SELECT COUNT($namaField) as count FROM $table WHERE $where";
            $query = mysqli_query($con,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function selectAvg($table,$namaField){
            global $con;
            $sql = "SELECT AVG($namaField) as avg FROM $table";
            $query = mysqli_query($con,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function selectBetween($table,$whereparam,$param,$param1){
            global $con;
            $sql = "SELECT * FROM $table WHERE $whereparam BETWEEN '$param' AND '$param1'";
            $query = mysqli_query($con,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;
        }


        public function search($table,$likeKey,$likeOne){
            global $con;
            $sql = "SELECT * FROM $table WHERE $likeKey like '%$likeOne%'";
            $query = mysqli_query($con,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;

        }



        public function getCountRows($table){
            global $con;
            $sql   = "SELECT * FROM $table";
            $query = mysqli_query($con,$sql);
            $rows  = mysqli_num_rows($query);
            return $rows;
        }

        
        public function delete($table,$where,$whereValues,$redirect){
            global $con;
            $sql = "DELETE FROM $table WHERE $where = '$whereValues'";
            $query = mysqli_query($con,$sql);
            if($query){
                return ['response'=>'positive','alert'=>'Berhasil Menghapus Data','redirect'=>$redirect];
            }else{
                echo mysqli_error($con);
                return ['response'=>'negative','alert'=>'Gagal Menghapus Data'];
            }
        }




        public function edit($table,$where,$whereValues){
            global $con;
            $sql = "SELECT * FROM $table WHERE $where = '$whereValues'";
            $query = mysqli_query($con,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;
        }





        public function update($table,$values,$where,$whereValues,$redirect){
            global $con;
            $sql   = "UPDATE $table SET $values WHERE $where = '$whereValues'";
            $query = mysqli_query($con,$sql);
                if($query){
                    return ['response'=>'positive','alert'=>'Berhasil update data','redirect'=>$redirect];
                }else{
                    echo mysqli_error($con);
                    return ['response'=>'negative','alert'=>'Gagal Update Data'];
                }
        }


        public function insert($table,$values,$redirect){
            global $con;

            $sql   = "INSERT INTO $table VALUES($values)";
            $query = mysqli_query($con,$sql);
            if($query){
                return ['response'=>'positive','alert'=>'Berhasil Menambahkan Data','redirect'=>$redirect];
            }else{
                echo mysqli_error($con);
                return ['response'=>'negative','alert'=>'Gagal Menambahkan Data'];
            }
        }

        public function multiInsert($table,array $values,$count){
            global $con;
            for($i = 1;$i <= $count;$i++){
                $sql = "INSERT INTO $table VALUES($values[$i])";
                $error[] = $i;
            }
            if(count($error) < 1){
                return ['response'=>'positive','alert'=>'Berhasil Menambahkan Semua Data'];
            }else{
                return ['response'=>'positive','alert'=>'Error di values ke'.$i];
            }
        }


        public function setJoin($tableOne,$tableTwo,$selectData,$whereJoin){
            global $con;
            $sql = "SELECT $selectData FROM $tableOne INNER JOIN $tableTwo ON $whereJoin";
            $query = mysqli_query($con,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;
        }


        public function setJoinThree($tableOne,$tableTwo,$tableThree,$selectData,$whereJoinOne,$whereJoinTwo){
            global $con;
            $sql = "SELECT $selectData FROM $tableOne INNER JOIN $tableTwo ON $whereJoinOne INNER JOIN $tableThree ON $whereJoinTwo";
            echo $sql;
            $query = mysqli_query($con,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;
        }



        public function AuthPetugas($sessionUser){
            global $con;
            $sql = "SELECT * FROM petugas WHERE username = '$sessionUser'";
            $query = mysqli_query($con,$sql);
            $bigData = mysqli_fetch_assoc($query);
            return $bigData;
        }

        public function AuthPegawai($sessionUser){
            global $con;
            $sql = "SELECT * FROM pegawai WHERE username = '$sessionUser'";
            $query = mysqli_query($con,$sql);
            $bigData = mysqli_fetch_assoc($query);
            return $bigData;
        }

        function validateImage(){
            global $con;
            $name       = $_FILES['foto']['name'];
            $ukuranFile = $_FILES['foto']['size'];
            $error      = $_FILES['foto']['error'];
            $tmpName    = $_FILES['foto']['tmp_name'];


            $folder = 'img/';

            $ekstensiGambar = explode('.',$name);
            $namaGambar = $ekstensiGambar[0];
            $ekstensiBelakang = strtolower(end($ekstensiGambar));
            $ekstensi = ['jpg','jpeg','png'];
            $error = array();


                if (in_array($ekstensiBelakang, $ekstensi) === false) {
                     return ['response'=>'negative','alert'=>'Gambar hanya boleh menggunakan ekstensi jpg,jpeg,png'];
                }

                if ($ukuranFile > 4000000) {
                    return ['response'=>'negative','alert'=>'Ukuran gambar terlalu besar'];
                }


            if (empty($errors)) {
                if (!file_exists('img')) {
                    mkdir('img',0563);
                }

            }
            $name = random_int(1, 999);
            $name = time().$name.".".$ekstensiBelakang;
            move_uploaded_file($tmpName, $folder.$name);

            return ['types'=>'true','image'=>$name];
        }



        public function autokode($table,$field,$pre){
            global $con;
            $sqlc   = "SELECT COUNT($field) as jumlah FROM $table";
            $querys = mysqli_query($con,$sqlc);
            $number = mysqli_fetch_assoc($querys);
            if($number['jumlah'] > 0){
                $sql    = "SELECT MAX($field) as kode FROM $table";
                $query  = mysqli_query($con,$sql);
                $number = mysqli_fetch_assoc($query);
                $strnum = substr($number['kode'], 2,3);
                $strnum = $strnum + 1;
                if(strlen($strnum) == 3){
                    $kode = $pre.$strnum;
                }else if(strlen($strnum) == 2){
                    $kode = $pre."0".$strnum;
                }else if(strlen($strnum) == 1){
                    $kode = $pre."00".$strnum;
                }
            }else{
                $kode = $pre."001";
            }

            return $kode;
        }

        public function validateHtml($field){
            $field = htmlspecialchars($field);
            return $field;
        }

        public function validateLower($field){
            $field = strtolower($field);
            return $field;
        }

        public function toExcel($nameFile){

            $dateNow = date("Y-m-d");


            $rawSended = header("Content-type : application/vnd-ms-excel");

            $GoExport  = header("Content-Disposition : attachment; filename = $dateNow-$nameFile");


            if($rawSended == true && $GoExport == true){

                return ['response'=>'positive','alert'=>'Berhasil Meng Export data'];
            }else{

                return ['response'=>'negative','alert'=>'Gagal Melakukan Export'];
            }
        }

        public function toPdf(){
            echo "window.print()";
        }

        public function Clone($what,$number){
            for($i = 1;$i <= $number; $i++){
                echo $what;
            }
        }

        public function addComent($table,$post_id,$whoComment,$values){
            global $con;
            $sql = "INSERT INTO $table VALUES('','$post_id','$whoComment',$values)";
            $query = mysqli_query($con,$sql);
            if($query){
                return ['response'=>'positive'];
            }else{
                return ['response'=>'negative'];
            }
        }

        public function validateNumber($field,$alert){
            if (!is_numeric($field)) {
                return ['response'=>'negative','alert'=>$alert];
            }
            else{
                return true;
            }
        }



    }

?>
