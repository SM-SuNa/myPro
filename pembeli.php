<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_toko";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database");
}

$id_pembeli="";
$username="";
$email="";
$no_telpon="";
$password="";
$error="";
$sukses="";

if(isset($_GET['op'])){
     $op=$_GET['op'];
}else{
    $op="";
}

if($op =='delete'){
    $id_pembeli=$_GET['id'];
    $sql1="delete from pembeli where id_pembeli='$id_pembeli'";
    $q1=mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses="berhasil hapus data";
    }else{
        $error="gagal hapus data";
    }
}

if($op=='edit'){
    $id_pembeli=$_GET['id'];
    $sql1="select * from pembeli where id_pembeli = '$id_pembeli'";
    $q1=mysqli_query($koneksi,$sql1);
    $r1=mysqli_fetch_array($q1);
    $id=$r1['id'];
    $username=$r1['username'];
    $email=$r1['email'];
    $no_telpon=$r1['no_telpon'];
    $password=$r1['password'];

    if($username==''){
        $error="data tidak ditemukan";
    }
}

if(isset($_POST['simpan'])){
    $id_pembeli=$_POST['id_pembeli'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $no_telpon=$_POST['no_telpon'];
    $password=$_POST['password'];

    if($id && $username && $email && $no_telpon && $password){

        if($op=='edit'){
            $sql1="update pembeli set id_pembeli='$id_pembeli' username='$username',email='$email',no_telpon='$no_telpon',password='$password' where id_pembeli='$id_pembeli' ";
            $q1=mysqli_query($koneksi,$sql1);
            if($q1){
                $sukses="data berhasil diupdate";
            }else{
                $error="data gagal diupdate";
            }
        }else{
            $sql1="insert into pembeli(id,username,email,no_telpon,password) values ('$id','$username','$email','$no_telpon','$password')";
        $q1=mysqli_query($koneksi,$sql1);
        if($q1){
            $sukses="berhasil memasukan data baru";
        }else{
            $error="gagal memasukan data";
        }
        }
    }else{
        $error="silakan masukan datanya";
    }
}
?>
<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data pembeli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
      </head>
    <style>
        .mx-auto {
            width: 1000px
        }
        .card {
            margin-top: 10px;
        }
    </style>
<body>

<div class="nav">
        <div class="logo">
            <p><a href="crudadmin.php">Admin</a></p>
        </div>
        <div class="right-links">
            <a href="crudadmin.php">Data Barang</a>
            <a href="pembeli.php">Data Pembeli</a>
            <a href="dibeli.php">Data Transaksi</a>
            <a href="logout.php"><button class="btn">Log Out</button></a>
        </div>
    </div>
    <main>
        <div class="main-box top">
            <div class="top">
                <div class="box">
                    <p>Hallo <b>Admin</b>, Selamat datang</p>
                </div> 
                <div class="box">
                    <p>Email anda adalah <b>admin@gmail.com</b>, Selamat datang</p>
                </div> 
            </div>
            <div class="bottom">
                <div class="box">
                    <p>No Telpon anda  <b>+62-000-9121-3654</b>.</p>
                </div>
            </div>
        </div>
    </main>
    <br>
    <div class="mx-auto">
        <div class="card">
            <div class="card-header">
                Create / Delete data
            </div>
            <div class="card-body">
                <?php
                if($error){
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>                
                <?php
                }
                ?>
            <div class="card-body">
                <?php
                if($sukses){
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>                
                <?php
                 header("refresh:5;url=pembeli.php");
                }
                ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
            <div class="card">
                <div class="card-header text-white bg-secondary">
                    data pembeli
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID</th>
                                <th scope="col">USERNAME</th>
                                <th scope="col">EMAIL</th>
                                <th scope="col">NO TELPON</th>
                                <th scope="col">PASSWORD</th>
                                <th scope="col">AKSI</th>

                            </tr>
                            <tbody>
                                <?php
                                 $sql2="select * from pembeli";
                                 $q2=mysqli_query($koneksi,$sql2);
                                 $urut=1;
                                 while($r2=mysqli_fetch_array($q2)){
                                    $id_pembeli=$r2['id_pembeli'];
                                    $username=$r2['username'];
                                    $email=$r2['email'];
                                    $no_telpon=$r2['no_telpon'];
                                    $password=$r2['password'];

                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $urut++ ?></th>
                                        <td scope="row"><?php echo $id_pembeli ?></td>
                                        <td scope="row"><?php echo $username ?></td>
                                        <td scope="row"><?php echo $email ?></td>
                                        <td scope="row"><?php echo $no_telpon ?></td>
                                        <td scope="row"><?php echo $password ?></td>                                      
                                        <td scope="row">
                                        <a href="pembeli.php?op=delete&id=<?php echo $id_pembeli ?>"onclick="return confirm('yakin ingin delete?')"><button type="button" class="btn btn-warning">Delete</button></a>

                                        </td>
                                    </tr>
                                    <?php
                                 }
                                ?>
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
</body>

</html>