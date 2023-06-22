<?php
include("koneksi.php");

if(isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $gambar = $_FILES["gambar"]['name'];
    $tmp_gambar = $_FILES["gambar"]["tmp_name"];
    $path = "../gambar/" . $gambar;
    if (move_uploaded_file($tmp_gambar, $path)) {
        $sql = "UPDATE kamera SET foto='$gambar', nama='$nama', stok='$stok', harga='$harga' WHERE kode_kamera='$id'";
        $query = mysqli_query($valid, $sql);
        if($query) {
            header('location: ../MenuAdmin.php');            
        } else {
            die("Gagal menyimpan perubahan...");
        }
    } 
    elseif($gambar==null){
        $sql = "UPDATE kamera SET nama='$nama', stok='$stok', harga='$harga' WHERE kode_kamera='$id'";
        $query = mysqli_query($valid, $sql);
        header('location: ../MenuAdmin.php'); 
    }
    else {
    echo "Maaf, Gambar gagal untuk diupload.";
    }


} else {
    die("akses dilarang...");
}
?>