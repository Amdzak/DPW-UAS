<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Barang</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script>
        alert("belum lengkap");
    </script>
</head>
<body>
        <div class="container">
            <?php
                include("koneksi.php");

                if( !isset($_GET['id']) ) {
                    header('location: view.php');
                }

                $id = $_GET['id'];

                $sql = "SELECT * FROM kamera WHERE id_kamera=$id";
                $query = mysqli_query($valid, $sql);
                $barang = mysqli_fetch_assoc($query);

                if( mysqli_num_rows($query) < 1 ) {
                    die("data tidak ditemukan...");

                    // Mendapatkan nama file foto
                    $foto = $_FILES['foto']['name'];

                    // Tempat penyimpanan file foto sementara
                    $tmp = $_FILES['foto']['tmp_name'];

                    // Folder penyimpanan file foto
                    $folderFoto = "foto/";

                    // Pindahkan file foto ke folder penyimpanan
                    move_uploaded_file($tmp, $folderFoto.$foto);

                    // Query input menginput data ke dalam tabel barang
                    $sql = "INSERT INTO barang (id, nama_barang, jenis_barang, harga, stok, foto) VALUES ('$id', '$nama', '$jenis', '$harga', '$stok', '$foto')";

                    // Mengeksekusi/menjalankan query di atas
                    $hasil = mysqli_query($kon, $sql);

                    // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
                    if ($hasil) {
                        header("Location: barang.php");
                    } else {
                        echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>";
                    }
                }
            ?>
            <h2>Update Data</h2>
            <form action="aksi-update.php" method="post" enctype="multipart/form-data">
                <fieldset>
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?php echo $barang['id_kamera'] ?>">
                    </div>

                    <div class="form-group">
                        <label>Nama Barang:</label>
                        <input type="text" name="nama" class="form-control" placeholder=" Nama Barang" value="<?php echo $barang['nama'] ?>"/>
                    </div>

                    <!-- <div class="form-group">
                        <label for="jenis_barang">Jenis Barang: </label>
                        <?php $jenis_barang = $barang['jenis_barang']; ?>
                        <label><input type="radio" name="jenis_barang" value="Makanan"
                        <?php echo ($jenis_barang == 'Makanan') ? "checked": "" ?>>Makanan</label>
                        <label><input type="radio" name="jenis_barang" value="Peralatan Dapur"
                        <?php echo ($jenis_barang == 'Peralatan Dapur') ? "checked": "" ?>>Peralatan Dapur</label>
                        <label><input type="radio" name="jenis_barang" value="Minuman"
                        <?php echo ($jenis_barang == 'Minuman') ? "checked": "" ?>>Minuman</label>
                    </div> -->

                    <!-- <div class="form-group">
                        <label>Stok: </label>
                        <input type="text" name="stok" class="form-control" placeholder=" Stok" value="<?php echo $barang['stok'] ?>"/>
                    </div> -->

                    <div class="form-group">
                        <label>Harga: </label>
                        <input type="text" name="harga" class="form-control" placeholder=" Harga" value="<?php echo $barang['harga'] ?>"/>
                    </div>

                    <div class="form-group">
                        <label>Gambar: </label>
                        <input type="file" name="gambar" class="form-control" value="<?php echo $barang['foto'] ?>"/>
                    </div>

                    <br>

                    <p>
                        <input type="submit" value="Simpan" name="simpan">
                        <input type="button" value="Kembali" onclick="history.back(-1)">
                    </p>
                </fieldset>
            </p>
            </form>
        </div>
</body>
</html>