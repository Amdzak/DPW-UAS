<?php
include("koneksi.php");

if(isset($_GET['id'])) {
    $id = htmlspecialchars($_GET["id"]);

    $sql = "delete from kamera where kode_kamera='$id' ";
    $hasil = mysqli_query($valid, $sql);

    // Kondisi apakah berhasil atau tidak
    if($hasil) {
        echo "<script> alert('Data berhasil di hapus')</script>";
        header("Location: ../MenuAdmin.php");
    } else {
        echo "<div class='alert alert-danger'> Data gagal dihapus.</div>";
    }
}
?>