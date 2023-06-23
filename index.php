<?php ?>
<!DOCTYPE html>
<html>

<head>
  <title>Kamera Store</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/w3.css">
  <link rel="stylesheet" href="css/bootstrap.css">

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
  <style>
    .popup, .popup2 {
    width: 300px;
    height: 200px;
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: none;
    }

    .container {
    max-width: 500px;
    margin: 50px auto;
    padding: 20px;
    background-color: magenta;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .ok{
    font-family: Arial, sans-serif;
    z-index: 2;
    display: none;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    }

    .form-group {
    margin-bottom: 20px;
    }

    label {
    font-weight: bold;
    }

    .btn {
    margin-right: 10px;
    }

    .close-button {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 18px;
    cursor: pointer;
    }

    .anim {
        animation: fade 1.5s normal;
      }
    
      @keyframes fade {
        0% {
          opacity: 0;
        }
        50% {
          opacity: 0.5;
        }
        100% {
          opacity: 1;
        }
      }
  </style>
</head>

<body>
      <?php
      if($_GET["salah"]==999){
        echo("
        <script>
            alert('Stok Habis');
            window.location='index.php';
        </script>
        ");
      }
      if(isset($_GET["salah"]) && $_GET["salah"]==998){
        echo("
        <script>
            alert('Jumlah Ngawur');
            window.location='index.php';
        </script>
        ");
      }
      ?>


  <!-- Navbar (sit on top) -->
  <div class="w3-top">
    <div class="w3-bar w3-wide w3-padding w3-card" style="background-color:#b98daf;"> <!--w3-white-->
      <a href="Home.php" class="w3-bar-item w3-button"><b>Ahmad Anfi </b>Kamera Store</a>
      <div class="w3-right w3-hide-small">
        <div class="w3-bar-item w3-button dropdown" style="color: black;">Menu
          <div class="dropdown-content">
            <a href="#loh" class="w3-bar-item w3-button">Katalog  </a><br>
            <a href="transaksi.php" class="w3-bar-item w3-button">Transaksi  </a><br>

            <!-- <button class="w3-bar-item w3-button" onclick="showPopup2()">Beli </button> -->
          </div>
        </div>
        <a href="admin.php" style="color: black;">
        <button class="w3-bar-item w3-button" style="letter-spacing: 4px;">Admin</button></a>
        <form action="" class="w3-bar-item" style="display:none;"><label for="serahasia">| Password:</label> <input type="text" style="height: 22.5px;" name="serahasia"></form>
      </div>
    </div>
  </div>

  <!-- Header -->
  <header class="w3-display-container w3-content w3-wide" style="max-width:100%;" id="home">
    <img class="w3-image" src="gambar/BG.png" alt="Wallpaper" width="100%">
    <div class="w3-display-middle w3-margin-top w3-center">
      <h1 class="w3-xxlarge w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b>Ahmad Anfi</b></span> <span class="w3-hide-small w3-text-light-grey" style="font-color:black;">Kamera Store</span></h1>
    </div>
  </header>

  <!-- Content -->
  <div class="w3-row-padding" style="background: #E5BEEC;">
    <hr style="border: 1px solid; color: black;">
    <h1 id="loh"
      style="font-family: Verdana,sans-serif; font-size: 15px;line-height: 1.5; font-weight: bolder; font-size: 30px; margin: 20px 0px; letter-spacing: 3px;">
      <center> LIST  KAMERA</center>
    </h1>
    <hr style="border: 1px solid; color: black;">
    
    <?php
      include "proses/koneksi.php";
      $hasil = mysqli_query($valid, "select * from kamera order by kode_kamera asc ");
      while($data = mysqli_fetch_array($hasil)) {
    ?>
    <div class="w3-col l4 m6 w3-margin-bottom">
      <img src=<?="gambar/".$data["foto"];?> alt="Kamera" style="width:100%;height: 30em;">
      <h3><?php echo $data["nama"]?></h3>
      <p class="w3-opacity">Kode Kamera : <?php echo $data["kode_kamera"]?></p>
      <p>Stok : <?php echo $data["stok"]?></p>
      <p>Harga : <?php echo $data["harga"]?></p>
      <a href="index.php?id=<?php echo htmlspecialchars($data['kode_kamera']); ?>">
        <p><button class="w3-button w3-light-grey w3-block">Beli Kamera</button></p>
      </a>
    </div>
    <?php } ?>
  </div>
  
  <!-- Separator -->
  <div class="w3-row-padding" style="background: #E5BEEC;"></div>

  <!-- Form Update -->
  <div id="popup2" class="container ok" style="
    <?php
      if(isset($_GET['id'])) {
        echo("
        display:block;
              ");
      }
    ?>
    ">

    <div class="container anim">
    <?php
      $server = "localhost";
      $user = "root";
      $password = "";
      $database = "bebas";
      $kon = mysqli_connect($server, $user, $password, $database);
      if(!$kon) {
          die("gagal terhubung dengan database: " . mysqli_connect_error());
      }
      ?>
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
              <input type="text" name="nama" class="form-control" placeholder=" Nama Barang" value="<?php echo $kamera['nama'] ?>"/>
              </div>
              <div class="form-group">
                  <label>Kode Kamera: </label>
                  <input readonly type="text" name="kode" class="form-control" placeholder="Kode Kamera" value="<?php echo $kamera['kode_kamera'] ?>"/>
              </div>
              <div class="form-group">
                  <label>Jumlah Pembelian: </label>
                  <input type="text" name="jumlah" class="form-control" placeholder="Jumlah Pembelian" />
              </div>
              <div class="form-group">
                  <label>Nama Pembeli: </label>
                  <input type="text" name="pembeli" class="form-control" placeholder="Nama Pembeli"/>
              </div>
              <p>
                <center>
                  <input class="btn btn-warning" type="submit" value="Beli" name="simpan">
                </center>
                  <!-- <input type="button" value="Kembali" onclick="history.back(-1)" style="margin-left:50px;"> -->
              </p>
          </fieldset>
      </form>
      <div class="close-button" onclick="closePopup2()"><h1>&times;</h1></div>
    </div>
  </div>           
        
  <!-- Footer -->
  <footer class="w3-center "
    style="background-color:#dcaacd; color: #fff!important; padding-top: 6px!important; padding-bottom: 6px!important; border-top: solid #d584c2 3.9px;">
    <p style="font-size: x-large;">Powered by A<sup>2</sup>
      <!-- <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">w3.css</a> -->
    </p>
  </footer>

</body>