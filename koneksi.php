<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_savienna"; 

$mysqli = mysqli_connect($host, $user, $pass, $db);

if (!$mysqli) {
    die("Koneksi gagal: " . mysqli_connect_error());
}