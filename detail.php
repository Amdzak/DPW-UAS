<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/tambahan.css">

    <title>Detail Product</title>
</head>
<body>
    <?php 
    include "proses/koneksi.php";
    $id=$_GET['beli'];
    $suuu=mysqli_query($valid, "SELECT detail.kode_kamera, detail.merek, kamera.foto, kamera.nama, kamera.harga, kamera.foto, kamera.stok 
    from detail join kamera on detail.kode_kamera=kamera.kode_kamera where detail.kode_kamera=$id");
    $hasil = mysqli_fetch_array($suuu);
        if (!isset($hasil["kode_kamera"])){
            echo"
            <script>
                alert('Detail Belum Ada');
                window.location='index.php' ;
            </script>
            ";
            die;
        }
        ?>
    <!-- AWAL NAVIGASI BAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark col-12" style="height: 48px;">
        <div class="container-fluid">
            <a class="navbar-brand col-7 offset-1" href="#"><h3>Ahmad Anfi Camera</h3> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse offset-1" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Daftar Kamera sebelumnya</a>
                </li>
                <!-- <li class="nav-item">
                <a class="nav-link" href="home.php">Admin page</a>
                </li> -->
            </ul>
            </div>
        </div>
    </nav>

    <!-- KONTENT UTAMA -->
    <div class="container ms-0 mt-3">
        <div class="row mt-5 offset-1">
            <h4 class="">Detail Product <?=$hasil["kode_kamera"]?></h4>
          <div class="col-9"> <h2>Nama Product : <?=$hasil["nama"]?></h2></div>
          <div class="col-4 mt-4">
          <center>
            <img src="gambar/<?=$hasil["foto"]?>" width="90%" alt="KUCING"></br></br>
            <button style="width: 100px;" onclick="showPopup2()">beli</button>
          </center>
        </div>
          <div class="col-6 mt-4">
            <ul class="navbar-nav">
                <li class="nav-item"><b>Informasi Produk</b></li>
                <li>Merk :  <?=$hasil["merek"]?></li>
                <li>Harga : Rp <?=$hasil["harga"]?></li>
                <li class="mb-3">Stock : <?=$hasil["kode_kamera"]?></li>
                <li><b>Detail Produk</b></li>
                <li>Kondisi barang : barang baru</li>
                <li>Kondisi fisik :  masih mulus</li>
                <li>LCD : bening</li>
                <li>Lensa : normal</li>
                <li>Touch screen :  tidak</li>
                <li class="mb-3">Berat : 50g</li>
                <li><b>Kelengkapan Produk</b></li>
                <li>+ Baterai</li>
                <li>+ Manual book</li>
                <li>+ Tutup lensa</li>
                <li>+ Baterai ori</li>
                <li>+ Tali strap</li>
                <li>+ Charger</li>
            </ul>
          </div>
        </div>
    </div>
</body>
</html>

<!-- Form Update -->
<script>
    function showPopup2() {
        var popup = document.getElementById("popup2");
        popup.style.display = "block";
        }

        function closePopup2() {
        var popup = document.getElementById("popup2");
        popup.style.display = "none";
        }
    </script>
<div id="popup2" class="container ok" style="
    <?php
      if(isset($_GET['beli'])) {
        echo("
        // display:block;
        background-color:cyan;
              ");
      }
    ?>
    ">

    <div class="container anim">
    <?php
      include("proses/koneksi.php");
      if(isset($_GET['id']) ) {
      $id = $_GET['id'];
      $sql = "SELECT * FROM kamera WHERE kode_kamera='$id'";
      $query = mysqli_query($valid, $sql);
      $kamera = mysqli_fetch_assoc($query);
      // print_r($kamera);
      if( mysqli_num_rows($query) < 1 ) {
          die("data tidak ditemukan...");
      $foto = $_FILES['foto']['name'];
      $tmp = $_FILES['foto']['tmp_name'];
      $folderFoto = "gambar/";
      move_uploaded_file($tmp, $folderFoto.$foto);
      $sql = "INSERT INTO kamera (kode_kamera, nama, harga, stok, foto) VALUES ('$id', '$nama', '$harga', '$stok', '$foto')";
      $hasil = mysqli_query($valid, $sql);
      if ($hasil) {
          header("Location: MenuAdmin.php");
      } else {
          echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>";
          header("Location: MenuAdmin.php");

      }
              }}
      ?>
      <h2>Form Pembelian</h2>
      <form action="proses/tambahTransaksi.php" method="post" enctype="multipart/form-data">
          <fieldset>
              <br>
              <!-- <div class="form-group">
                  <label for="">ID Barang : <?php 
                                // $barang['id']
                                // .", Nama Barang : ".$barang['nama_barang']
                                // .", Harga Barang : ".$barang['harga']
                                
                                ?></label>
                  <label>, Nama Barang : <?php //$barang['nama_barang'] ?></label>
                  <input type="hidden" name="id" value="<?php// $barang['id'] ?>"> 
               </div> -->
              <div class="form-group">
              <label>Nama Kamera: </label>
              <input type="text" name="nama" class="form-control" placeholder=" Nama Barang" value="<?php echo $hasil['nama'] ?>"/>
              </div>
              <div class="form-group">
                  <label>Kode Kamera: </label>
                  <input type="hidden" name="kode" class="form-control" placeholder="Kode Kamera" value="<?php echo $hasil['kode_kamera'] ?>"/>
              </div>
              <div class="form-group">
                  <label>Jumlah Pembelian: </label>
                  <input type="text" name="jumlah" class="form-control" placeholder="Jumlah Pembelian" />
              </div>
              <div class="form-group">
                  <label>Nama Pembeli: </label>
                  <input type="text" name="pembeli" class="form-control" placeholder="Nama Pembeli"/>
              </div>
              <br>
              <p>
                  <input type="submit" value="Beli" name="simpan">
                  <input type="button" value="Kembali" onclick="history.back(-1)" style="margin-left:50px;">
              </p>
          </fieldset>
      </form>
      <div class="close-button" onclick="closePopup2()"><h1>&times;</h1></div>
    </div>
  </div>     
<!-- <div class="container">
</div> -->