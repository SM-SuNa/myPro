<?php
$host  ="localhost";
$user  ="root";
$pass  ="";
$db    ="db_toko";

$koneksi=mysqli_connect($host,$user,$pass,$db);
if(!$koneksi){
    die("tidak bisa terkoneksi ke database");
}
$id="";
$nama_barang     ="";
$harga_barang    ="";
$jenis_barang  ="";
$stok="";
$foto="";
$sukses  ="";
$eror    ="";

if(isset($_GET['op'])){
  $op=$_GET['op'];
}else{
  $op="";
}

if($op=='delete'){
  $id_barang=$_GET['id'];
  $sql1="delete from barang where id_barang= '$id_barang'";
  $q1=mysqli_query($koneksi,$sql1);
  if($q1){
    $sukses="berhasil menghapus data";
  }else{
    $eror="Gagal menghapus data";
  }
}

if($op =='edit'){
  $id_barang      =$_GET['id'];
  $sql1    ="select * from barang where id_barang ='$id_barang'";
  $q1      =mysqli_query($koneksi,$sql1);
  $r1      =mysqli_fetch_array($q1);
  $nama_barang    =$r1['nama_barang'];
  $harga_barang  =$r1['harga_barang'];
  $jenis_barang  =$r1['jenis_barang'];
  $stok  =$r1['stok'];
  $foto=$r1['foto'];


  if($id_barang==''){
    $eror="data tidak ditemukan";
  }
}

if(isset($_POST['simpan'])){
  $nama_barang = $_POST['nama_barang'];
  $harga_barang = $_POST['harga_barang'];
  $jenis_barang = $_POST['jenis_barang'];
  $stok = $_POST['stok'];
  $foto = $_FILES['foto']['name'];
  $ekstensi1 = array('png','jpg','jpeg');
  $x = explode('.',$foto);
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['foto']['tmp_name'];

if(in_array($ekstensi,$ekstensi1) === true){
    move_uploaded_file($file_tmp,'img/'.$foto);
}else{
    echo "<script> alert('Ekstensi tidak diperbolehkan')</script>";
}

  if($nama_barang && $harga_barang && $jenis_barang && $stok && $foto){
    if($op=='edit'){
      $sql1="update barang set nama_barang='$nama_barang',harga_barang='$harga_barang',jenis_barang='$jenis_barang',stok='$stok',foto='$foto' where id_barang='$id_barang'";
      $q1=mysqli_query($koneksi,$sql1);
      if($q1){
        $sukses="Data berhasil di update";
      }else{
        $eror="Data Gagal di Update";
      }
    }else{
    $sql1="insert into barang(nama_barang,harga_barang,jenis_barang,stok,foto) values('$nama_barang','$harga_barang','$jenis_barang','$stok','$foto')";
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
    <title>Data Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
  </head>
    <style>
      .mx-auto{width:1100px;}
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
    <div class="mx-auto">
        <div class="card">
  <div class="card-header">
    Create /Edit Data
  </div>
  <div class="card-body">
    <?php
    if($eror){
        ?>

        <div class="alert alert-danger" role="alert">
  <?php  echo $eror?>
</div>
        <?php
        header("refresh:5;url=crudadmin.php");
    }
    ?>
    <?php
    if($sukses){
        ?>

        <div class="alert alert-success" role="alert">
 <?php  echo $sukses?>
</div>
        <?php header("refresh:5;url=crudadmin.php");
    }
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
   <div class="mb-3 row">
    <label for="nama_barang" class="col-sm-2 col-form-label">NAMA BARANG</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="nama_barang" name ="nama_barang" value="<?php echo $nama_barang?>">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="harga_barang" class="col-sm-2 col-form-label">HARGA BARANG</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="harga_barang" name ="harga_barang" value="<?php echo $harga_barang?>">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="jenis_barang" class="col-sm-2 col-form-label">JENIS BARANG</label>
    <div class="col-sm-10">
      <select class="form-control" id="jenis_barang" name="jenis_barang">
        <option value="">PILIH JENIS MADU</option>
        <option value="vitomata"<?php if($jenis_barang=="vitomata") echo"selected"?>>Vitomata</option>
        <option value="jamkorat"<?php if($jenis_barang=="jamkorat") echo"selected"?>>Jamkorat</option>
        <option value="nurutenz"<?php if($jenis_barang=="nurutenz") echo"selected"?>>Nurutenz</option>
        <option value="gurahfit"<?php if($jenis_barang=="gurahfit") echo"selected"?>>Gurah Fit</option>
      </select>
    </div>
  </div> 
  <div class="mb-3 row">
    <label for="stok" class="col-sm-2 col-form-label">STOK</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="stok" name ="stok" value="<?php echo $stok?>">
    </div>
  </div>
  
    <div class="mb-3 row">
    <label for="foto" class="col-sm-2 col-form-label">GAMBAR</label>
    <div class="col-sm-10">
      <input type="file" class="form-control" id="foto" name ="foto" value="<?php echo $foto?>">
    </div>
  </div>
  <div class="col-12">
    <input type="submit" name="simpan" value="simpan data" class="btn btn-primary">
  </div>
    </form>
  </div>
</div>

<div class="card mx-auto" >
  <div class="card-header text-white bg-secondary">
   Data barang
  </div>
  <div class="card-body">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">ID</th>
        <th scope="col">NAMA BARANG</th>
        <th scope="col">HARGA BARANG</th>
        <th scope="col">JENIS BARANG</th>
        <th scope="col">STOK</th>
        <th scope="col">FOTO</th>
        <th scope="col">AKSI</th>
      </tr>
      <tbody>
        <?php
        session_start();
        $sql2="select * from barang order by id_barang desc";
        $q2=mysqli_query($koneksi,$sql2);
        $urut=1;
        while ($r2=mysqli_fetch_array($q2)){
          $id_barang=$r2['id_barang'];
          $nama_barang = $r2['nama_barang'];
          $harga_barang  = $r2['harga_barang'];
          $jenis_barang  = $r2['jenis_barang'];
          $stok  = $r2['stok'];
          $foto = $r2['foto'];


          ?>
            <tr>
              <th scope="row"><?php  echo $urut++ ?></th>
              <td scope="row"><?php echo $id_barang?></td>
              <td scope="row"><?php echo $nama_barang?></td>
              <td scope="row"><?php echo $harga_barang?></td>
              <td scope="row"><?php echo $jenis_barang?></td>
              <td scope="row"><?php echo $stok?></td>
              <td scope="row">
                <img src="img/<?php echo $foto?>" width="100px" height="100px">
              </td>
              <td scope="row">
                <a href="crudadmin.php?op=edit&id=<?php echo $id_barang ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                <a href="crudadmin.php?op=delete&id=<?php echo $id_barang ?>" onclick="return confirm('yakin mau delete data')"> <button type="button" class="btn btn-danger">Delete</button></a>
               
                
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