<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "kamera";

    $valid = mysqli_connect($server,$user,$pass,$db);

    if (!$valid) {
        die("server gagal terhuung" . mysqli_connect_error);
    }    
?>