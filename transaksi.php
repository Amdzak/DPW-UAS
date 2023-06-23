<!-- <h1>ok</h1> -->
<?php
    include "proses/koneksi.php";
    // $o=$_GET['kode'];
    $uwu=mysqli_fetch_array(mysqli_query($valid,"SELECT * from kamera "));
    // echo($uwu["stok"]); 
    
?>
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

<link rel="stylesheet" href="css/bootstrap.css">

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

            $hasil = mysqli_query($valid, "select tr.id_transaksi, tr.kode_kamera, tr.jumlah, tr.nama_pelanggan, kamera.nama from transaksi tr join kamera on tr.kode_kamera=kamera.kode_kamera order by kode_kamera desc limit $halaman_awal, $batas");
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

