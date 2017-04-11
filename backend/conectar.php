<?php
    // $host = "192.168.0.170";
    // $user = "helth";
    // $password = "helth";
    // $db = "helth_hospital";

    $host = "localhost";
    $user = "";
    $password = "";
    $db = "hospital1";
    $con  = mysqli_connect($host, $user, $password, $db) or die ("Erro ao conectar: " . mysqli_connect_error());
?>
