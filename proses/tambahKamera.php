<?php
include "koneksi.php";
function input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = input($_POST["kode"]);
    $nama = input($_POST["nama"]);
    $harga = input($_POST["harga"]);
    $stok = input($_POST["stok"]);
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $folderFoto = "images/";
    move_uploaded_file($tmp, $folderFoto.$foto);
    $sql = "INSERT INTO kamera (kode_kamera, nama, harga, foto, stok) VALUES ('$id', '$nama',  '$harga', '$foto','$stok')";
    $hasil = mysqli_query($valid, $sql);
    if ($hasil) {
        header("Location: ../MenuAdmin.php");
    } else {
        echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>";
    }
}
?>