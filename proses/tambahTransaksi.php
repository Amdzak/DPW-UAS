<?php
include "koneksi.php";
$kode_kamera=$_POST["kode"];
$jumlah=$_POST["jumlah"];
$nama=$_POST["pembeli"];
$ah=mysqli_query($valid,"SELECT stok from kamera where kode_kamera='$kode_kamera'");
$stok=mysqli_fetch_array($ah);
if($jumlah>0){
    if ($jumlah<=$stok["stok"]){
        $sql = "INSERT INTO transaksi (kode_kamera,jumlah,nama_pelanggan) VALUES ( '$kode_kamera', '$jumlah', '$nama')";
        $hasil = mysqli_query($valid, $sql);
        if ($hasil) {
            $pengurangan=$stok["stok"]-$jumlah;
            $set=mysqli_query($valid, "UPDATE kamera set stok = $pengurangan where kode_kamera='$kode_kamera'");
            header("Location:../transaksi.php");
        } else {
            echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>";
        }
    } else {
        header('location:../index.php?salah=999');
    }
} else { header('location:../index.php?salah=998');}
?>