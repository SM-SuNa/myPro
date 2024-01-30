<?php
session_start();
session_destroy();
$host  ="localhost";
$user  ="root";
$pass  ="";
$db    ="db_toko";

$koneksi=mysqli_connect($host,$user,$pass,$db);
if(!$koneksi){
    die("tidak bisa terkoneksi ke database");
}
$id_transaksi   ="";
$tgl_transaksi ="";
$jumlah_pembelian="";
$total="";
$alamat="";
$sukses  ="";
$eror    ="";

if(isset($_GET['op'])){
  $op=$_GET['op'];
}else{
  $op="";
}

if($op=='delete'){
  $id_transaksi=$_GET['id'];
  $sql1="delete from dibeli where id_transaksi= '$id_transaksi'";
  $q1=mysqli_query($koneksi,$sql1);
  if($q1){
    $sukses="berhasil menghapus data";
  }else{
    $eror="Gagal menghapus data";
  }
}

if($op =='edit'){
  $id_transaksi      =$_GET['id'];
  $sql1    ="select * from dibeli where id_transaksi ='$id_transaksi'";
  $q1      =mysqli_query($koneksi,$sql1);
  $r1      =mysqli_fetch_array($q1);
  $id_transaksi    =$r1['id_transaksi'];
  $tgl_transaksi =$r1['tgl_transaksi'];
  $jumlah_pembelian=$r1['jumlah_pembelian'];
  $total=$r1['total'];
  $alamat=$r1['alamat'];
  

  if($id_transaksi==''){
    $eror="data tidak ditemukan";
  }
}

if(isset($_POST['simpan'])){
  $id_transaksi     =$_POST['id_transaksi'];
  $tgl_transaksi =$_POST['tgl_transaksi'];
  $jumlah_pembelian=$_POST['jumlah_pembelian'];
  $total=$_POST['total'];
  $alamat=$_POST['alamat'];
  

  if($id_transaksi && $tgl_transaksi && $jumlah_pembelian && $total && $alamat){
    if($op=='edit'){
      $sql1="update dibeli set id_transaksi='$id_transaksi',tgl_transaksi='$tgl_transaksi',jumlah_pembelian='$jumlah_pembelian',total='$total',alamat='$alamat' where id_transaksi='$id_transaksi'";
      $q1=mysqli_query($koneksi,$sql1);
      if($q1){
        $sukses="Data berhasil di update";
      }else{
        $eror="Data Gagal di Update";
      }
    }else{
    $sql1="insert into dibeli(id_transaksi,tgl_transaksi,jumlah_pembelian,total,alamat) values('$id_transaksi','$tgl_transaksi','$jumlah_pembelian','$total','$alamat')";
     $q1= mysqli_query($koneksi,$sql1);
     if($q1){
      $sukses="berhasil memasukkan data";
     }else{
      $eror="gagal memasukkan data";
     }
    }
    
  }else{
    $eror="silakan memasukkan semua data";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
   
    <style>
      .mx-auto{width:900px;}
      .card{margin-top:10px;}
    </style>
</head>
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
   
    <?php
    if($eror){
        ?>

        <div class="alert alert-danger" role="alert">
  <?php  echo $eror?>
</div>
        <?php
        header("refresh:5;url=dibeli.php");
    }
    ?>
    <?php
    if($sukses){
        ?>

        <div class="alert alert-success" role="alert">
 <?php  echo $sukses?>
</div>
        <?php header("refresh:5;url=dibeli.php");
    }
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<div class="card mx-auto">
  <div class="card-header text-white bg-secondary">
   Data Transaksi
  </div>
  <div class="card-body">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">ID TRANSAKSI</th>
        <th scope="col">TANGGAL</th>
        <th scope="col">JUMLAH PEMBELIAN</th>
        <th scope="col">TOTAL</th>
        <th scope="col">ALAMAT</th>
        <th scope="col">AKSI</th>
      </tr>
      <tbody>
        <?php
        
        $sql2="select * from dibeli order by id_transaksi desc";
        $q2=mysqli_query($koneksi,$sql2);
        $urut=1;
        while($r2=mysqli_fetch_array($q2)){
          $id_transaksi=$r2['id_transaksi'];
          $tgl_transaksi=$r2['tgl_transaksi'];
          $jumlah_pembelian=$r2['jumlah_pembelian'];
          $total=$r2['total'];
          $alamat=$r2['alamat'];
          
          ?>
            <tr>
              <th scope="row"><?php  echo $urut++ ?></th>
              <td scope="row"><?php echo $id_transaksi?></td>
              <td scope="row"><?php echo $tgl_transaksi?></td>
              <td scope="row"><?php echo $jumlah_pembelian?></td>
              <td scope="row"><?php echo $total?></td>
              <td scope="row"><?php echo $alamat?></td>
              <td scope="row">
                <a href="dibeli.php?op=delete&id=<?=$id_transaksi?>" onclick="return confirm('yakin mau delete data')"> <button type="button" class="btn btn-danger">Delete</button></a>
               
                
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