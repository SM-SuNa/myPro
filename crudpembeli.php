<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_toko";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database");
}
include 'koneksi.php';
session_start();
if(!isset($_SESSION['username'])){
    header('location:admin.php');
}
$mysql_adm=mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$_SESSION[username]'");
$data_adm=mysqli_fetch_array($mysql_adm);

$id="";
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
    $id=$_GET['id'];
    $sql1="delete from pembeli where id='$id'";
    $q1=mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses="berhasil hapus data";
    }else{
        $error="gagal hapus data";
    }
}

if($op=='edit'){
    $id=$_GET['id'];
    $sql1="select * from pembeli where id = '$id'";
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
    $id=$_POST['id'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $no_telpon=$_POST['no_telpon'];
    $password=$_POST['password'];

    if($id && $username && $email && $no_telpon && $password){

        if($op=='edit'){
            $sql1="update pembeli set id='$id' username='$username',email='$email',no_telpon='$no_telpon',password='$password' where id='$id' ";
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data pembeli</title>
    <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <h1>Hello, world!</h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>
    <style>
        body{
            background-image: url('');
        }

        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;

        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <div class="card">
            <div class="card-header">
                Create / edit data
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
                 header("refresh:5;url=halamanpembeli.php");
                }
                ?>

            <div class="card">
                <div class="card-header text-white bg-secondary">
                    data pembeli
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">id</th>
                                <th scope="col">username</th>
                                <th scope="col">email</th>
                                <th scope="col">no_telpon</th>
                                <th scope="col">password</th>

                            </tr>
                            <tbody>
                                <?php
                                 $sql2="select * from pembeli";
                                 $q2=mysqli_query($koneksi,$sql2);
                                 $urut=1;
                                 while($r2=mysqli_fetch_array($q2)){
                                    $id=$r2['id'];
                                    $username=$r2['username'];
                                    $email=$r2['email'];
                                    $no_telpon=$r2['no_telpon'];
                                    $password=$r2['password'];

                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $urut++ ?></th>
                                        <td scope="row"><?php echo $id ?></td>
                                        <td scope="row"><?php echo $username ?></td>
                                        <td scope="row"><?php echo $email ?></td>
                                        <td scope="row"><?php echo $no_telpon ?></td>
                                        <td scope="row"><?php echo $password ?></td>
                                        <td scope="row">
                                        <a href="halamanpembeli.php?op=delete&id=<?php echo $id ?>"onclick="return confirm('yakin ingin delete?')"><button type="button" class="btn btn-warning">Delete</button></a>

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