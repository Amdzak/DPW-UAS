<h1>ok</h1>
<?php
    include "proses/koneksi.php";
    $uwu=mysqli_fetch_array(mysqli_query($valid,"SELECT stok from kamera where kode_kamera=1"));
    echo($uwu["stok"]); 
?>