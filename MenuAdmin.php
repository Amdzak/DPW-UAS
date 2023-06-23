<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- <link rel="stylesheet" href="css/tambahan.css"> -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <title>Data Penjualan Kamera</title>
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
        /* 
        body {
        background: linear-gradient(to right, #e0c3fc, #8ec5fc);
        font-family: Arial, sans-serif;
        }
        */


        .ok{
        /* background: linear-gradient(to right, #e0c3fc, #8ec5fc); */
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
        /* background-color: black; */
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
        <?php
        session_start();
        if(!($_SESSION["loggedin"] == "haha" && isset($_SESSION["loggedin"]))){header("location:index.php");}
            if(isset($_GET['id'])) {
                    echo("
                        // body {
                        //     background: linear-gradient(to right, #e0c3fc, #8ec5fc);
                        //     font-family: Arial, sans-serif;
                        //     }
                        .ok{background-color: #c4c396;}                    
                        #popup2{display:block;}  
                    ");
                }
                // if(isset($_GET['id'])) {
                //     echo("
                //     ok{background-color: #c4c396;}                    
                //     ");
                // }
                ?>
    </style>
</head>
<body>
    <!-- AWAL NAVIGASI BAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark col-12" style="height: 48px;">
        <div class="container-fluid">
            <a class="navbar-brand col-9 offset-1" href="#"><h3>Ahmad Anfi Camera</h3> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse offset-1" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active me-1 btn-primary btn text-light" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                <!-- <a class="nav-link active me-1 btn-info btn text-black" href="home.php">Admin page</a> -->
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <!-- AKHIR NAVIGASI BAR -->
    
    <!-- MAIN CONTENT -->
    <div class="container ms-0 mt-3">
        <h4 id="KAMERA">Data Kamera</h4>
        <button onclick="showPopup()" class="btn btn-primary">Tambah Data</button>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Kamera</th>
                    <th>Gambar</th>
                    <th>Nama Kamera</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    
                    <th colspan='2'>Aksi</th>
                </tr>
            </thead>
            <?php
            include "proses/koneksi.php";

            $batas = 5;
            $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
            $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;

            $previous = $halaman - 1;
            $next = $halaman + 1;

            $sql = mysqli_query($valid,"select * from kamera order by kode_kamera desc");
            $jumlah_data = mysqli_num_rows($sql);
            $total_halaman = ceil($jumlah_data / $batas);

            $hasil = mysqli_query($valid, "select * from kamera order by kode_kamera desc limit $halaman_awal, $batas");
            $no = $halaman_awal + 1;
            while($data = mysqli_fetch_array($hasil)) {
            ?>
            <tbody>
                <tr>
                    <td><?php echo $no++?></td>
                    <td><?php echo $data["kode_kamera"]?></td>
                    <td><?php echo "<img src='gambar/".$data["foto"]."' width='100' height='100'></td>"; ?>
                    <td><?php echo $data["nama"]?></td>
                    <td><?php echo $data["harga"]?></td>
                    <td><?php echo $data["stok"]?></td>
                    
                    <td>
                        <a href="proses/hapus.php?id=<?php echo htmlspecialchars($data['kode_kamera']); ?>" class="btn btn-danger" role="button">Hapus</a>
                        <a href="MenuAdmin.php?id=<?php echo htmlspecialchars($data['kode_kamera']); ?>" class="btn btn-warning" role="button">Ubah</a>
                    </td>
                </tr>
            </tbody>
            <?php
            }
            ?>
        </table>
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; }?>>Previous</a>
                </li>
                <?php
                for($x = 1; $x <= $total_halaman; $x++) {
                    ?>
                <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>                 
                <?php
                }
                ?>
                <li class="page-item">
                    <a class="page-link" <?php if($halaman < $total_halaman) {echo "href='?halaman=$next'"; } ?>>Next</a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- AKHIR MAIN KONTEN -->

    
    
    <div id="popup2" class="container ok">
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
                    <h2>Update Data</h2>
                    <form action="proses/update.php" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $kamera['kode_kamera'] ?>">
                            </div>

                            <div class="form-group">
                                <label>Nama Barang:</label>
                                <input type="text" name="nama" class="form-control" placeholder=" Nama Barang" value="<?php echo $kamera['nama'] ?>"/>
                            </div>

                            <!-- <div class="form-group">
                                <label for="jenis_barang">Jenis Barang: </label>
                                <?php $jenis_barang = $kamera['jenis_barang']; ?>
                                <label><input type="radio" name="jenis_barang" value="Makanan"
                                <?php echo ($jenis_barang == 'Makanan') ? "checked": "" ?>>Makanan</label>
                                <label><input type="radio" name="jenis_barang" value="Peralatan Dapur"
                                <?php echo ($jenis_barang == 'Peralatan Dapur') ? "checked": "" ?>>Peralatan Dapur</label>
                                <label><input type="radio" name="jenis_barang" value="Minuman"
                                <?php echo ($jenis_barang == 'Minuman') ? "checked": "" ?>>Minuman</label>
                            </div> -->

                            <div class="form-group">
                                <label>Stok: </label>
                                <input type="text" name="stok" class="form-control" placeholder=" Stok" value="<?php echo $kamera['stok'] ?>"/>
                            </div>

                            <div class="form-group">
                                <label>Harga: </label>
                                <input type="text" name="harga" class="form-control" placeholder=" Harga" value="<?php echo $kamera['harga'] ?>"/>
                            </div>

                            <div class="form-group">
                                <label>Gambar: </label>
                                <input type="file" name="gambar" class="form-control" value="<?php echo $kamera['foto'] ?>"/>
                            </div>

                            <br>

                            <p>
                                <input type="submit" value="Simpan" name="simpan">
                                <input type="button" value="Kembali" onclick="history.back(-1)">
                            </p>
                        </fieldset>
                    </p>
                    </form>
                    <div class="close-button" onclick="closePopup2()"><h1>&times;</h1></div>
                    </div>
                </div>    

<?php
    if(isset($_POST["uasssu"])){
        $id=($_POST["uasssu"]);
        $nama=($_POST["nama"]);
        $harga=($_POST["harga"]);
        $stok=($_POST["stok"]);
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $folderFoto = "gambar/";
        move_uploaded_file($tmp, $folderFoto.$foto);
        $sql = "INSERT INTO kamera (kode_kamera, nama, harga, foto, stok) VALUES ('$id', '$nama',  '$harga', '$foto','$stok')";
        $hasil = mysqli_query($valid, $sql);
        if ($hasil) {
            // header("Location: ../satru.php");
            echo "<div class='alert alert-success'>Data Berhasil disimpan.</div>";
        } else {
            echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>";
        }
    }
?>
        <div id="popup" class="container ok" style="background-color:#c4c396;">
            <div class="container anim">
    <h2>Input Data Kamera</h2>
    <form action="MenuAdmin.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="id">Kode Barang:</label>
            <input type="text" name="uasssu" class="form-control" placeholder="Masukkan Kode Barang" required />
        </div>
        <div class="form-group">
            <label for="nama">Nama Barang:</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Barang" required />
        </div>
        <!-- <div class="form-group">
            <label for="jenis_barang">Jenis Barang:</label><br>
            <label><input type="radio" name="jenis_barang" value="Makanan"> Makanan</label><br>
            <label><input type="radio" name="jenis_barang" value="Peralatan Dapur"> Peralatan Dapur</label><br>
            <label><input type="radio" name="jenis_barang" value="Minuman"> Minuman</label>
        </div> -->
        <div class="form-group">
            <label for="harga">Harga:</label>
            <input type="text" name="harga" class="form-control" placeholder="Masukkan Harga Barang" required />
        </div>
        <div class="form-group">
            <label for="stok">Stok:</label>
            <input type="number" name="stok" class="form-control" placeholder="Masukkan Stok Barang" required />
        </div>
        <div class="form-group">
            <label for="foto">Foto:</label>
            <input type="file" name="foto" class="form-control" required />
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <a href="barang.php" class="btn btn-secondary">Kembali</a>
    </form>
    </div>
                    <!-- <button onclick="closePopup()">Tutup</button> -->
                    <div class="close-button" onclick="closePopup()"><h1>&times;</h1></div>
                </div>
</div>  

<div class="container ms-0 mt-3">
        <h4 id="KAMERA">Data Transaksi</h4>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Transaksi</th>
                    <th>Kode Kamera</th>
                    <th>Nama Kamera</th>
                    <th>Jumlah</th>
                    <th>Nama Pelanggan</th>
                    
                    <th colspan='2'>Aksi</th>
                </tr>
            </thead>
            <?php
            include "proses/koneksi.php";

            $batas = 5;
            $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
            $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;

            $previous = $halaman - 1;
            $next = $halaman + 1;

            $sql = mysqli_query($valid,"select * from transaksi order by kode_kamera desc");
            $jumlah_data = mysqli_num_rows($sql);
            $total_halaman = ceil($jumlah_data / $batas);

            $hasil = mysqli_query($valid, "select tr.id_transaksi, tr.kode_kamera, tr.jumlah, tr.nama_pelanggan, kamera.nama from transaksi tr left join kamera on tr.kode_kamera=kamera.kode_kamera order by kode_kamera desc limit $halaman_awal, $batas");
            $no = $halaman_awal + 1;
            while($data = mysqli_fetch_array($hasil)) {
            ?>
            <tbody>
                <tr>
                    <td><?php echo $no++?></td>
                    <td><?php echo $data["id_transaksi"]?></td>
                    <td><?php echo $data["kode_kamera"]?>
                    <td><?php echo $data["nama"]?></td>
                    <td><?php echo $data["jumlah"]?></td>
                    <td><?php echo $data["nama_pelanggan"]?></td>
                    
                    <td>
                        <a href="proses/hapusTransaksi.php?id=<?php echo htmlspecialchars($data['id_transaksi']); ?>" class="btn btn-danger" role="button">Hapus</a>
                        <!-- <a href="MenuAdmin.php?id  =<?php echo htmlspecialchars($data['kode_kamera']); ?>" class="btn btn-warning" role="button">Ubah</a> -->
                    </td>
                </tr>
            </tbody>
            <?php
            }
            ?>
        </table>
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; }?>>Previous</a>
                </li>
                <?php
                for($x = 1; $x <= $total_halaman; $x++) {
                    ?>
                <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>                 
                <?php
                }
                ?>
                <li class="page-item">
                    <a class="page-link" <?php if($halaman < $total_halaman) {echo "href='?halaman=$next'"; } ?>>Next</a>
                </li>
            </ul>
        </nav>
    </div>

<script>
        function showPopup() {
        var popup = document.getElementById("popup");
        popup.style.display = "block";
        }

        function closePopup() {
        var popup = document.getElementById("popup");
        popup.style.display = "none";
        }
        
        function showPopup2() {
        var popup = document.getElementById("popup2");
        popup.style.display = "block";
        }

        function closePopup2() {
        var popup = document.getElementById("popup2");
        popup.style.display = "none";
        }
    </script>
</body>
</html>