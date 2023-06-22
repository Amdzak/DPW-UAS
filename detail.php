<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Detail Product</title>
</head>
<body>
    <?php 
    include "proses/koneksi.php";
    $id=$_GET['beli'];
    $hasil = mysqli_fetch_array(mysqli_query($valid, "SELECT detail.kode_kamera, detail.merek, kamera.foto, kamera.nama, kamera.harga, kamera.foto, kamera.stok 
                                                    from detail join kamera on detail.kode_kamera=kamera.kode_kamera where detail.kode_kamera=$id"));
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
            <img src="gambar/<?=$hasil["foto"]?>" width="90%" alt="KUCING"></div>
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

<!-- <div class="container">
</div> -->