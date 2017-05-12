<?php
    $host = "localhost";
    $user = "";
    $password = "";
    $db = "helth_hospital";
    $con  = mysqli_connect($host, $user, $password, $db) or die("Erro ao conectar: " . mysqli_connect_error());
    mysqli_set_charset($con, 'utf8');
