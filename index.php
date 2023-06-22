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
</head>
<body>
    <!-- AWAL NAVIGASI BAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light ">
        <div class="container-fluid">
            <a class="navbar-brand " href="#"><h3>Ahmad Anfi Camera</h3> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse offset-2" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#KAMERA">Daftar Kamera</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="home.php">Admin page</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <!-- AKHIR NAVIGASI BAR -->

    <!-- MAIN CONTENT -->
    <div class="container ms-0 mt-3">
        <h4 id="KAMERA">Daftar Kamera</h4>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Kamera</th>
                    <th>Gambar</th>
                    <th>Nama Kamera</th>
                    <th>Harga</th>
                    
                    <th colspan='2'>Aksi</th>
                </tr>
            </thead>
            <?php
            include "koneksi.php";

            $batas = 5;
            $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
            $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;

            $previous = $halaman - 1;
            $next = $halaman + 1;

            $sql = mysqli_query($valid,"select * from kamera order by id_kamera desc");
            $jumlah_data = mysqli_num_rows($sql);
            $total_halaman = ceil($jumlah_data / $batas);

            $hasil = mysqli_query($valid, "select * from kamera order by id_kamera desc limit $halaman_awal, $batas");
            $no = $halaman_awal + 1;
            while($data = mysqli_fetch_array($hasil)) {
            ?>
            <tbody>
                <tr>
                    <td><?php echo $no++?></td>
                    <td><?php echo $data["id_kamera"]?></td>
                    <td><?php echo "<img src='images/".$data["foto"]."' width='100' height='100'></td>"; ?>
                    <td><?php echo $data["nama"]?></td>
                    <!-- <td><?php echo $data["jenis_barang"]?></td>
                    <td><?php echo $data["stok"]?></td> -->
                    <td><?php echo $data["harga"]?></td>
                    

                    <td>
                        <a target="_blank" href="detail.html?id=<?php echo htmlspecialchars($data['id_kamera']); ?>" class="btn btn-primary" role="button">Detail</a>
                        <a target="_blank" href="beli.php?id=<?php echo htmlspecialchars($data['id_kamera']); ?>" class="btn btn-success" role="button">Beli</a>
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
</body>
</html>