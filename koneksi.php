<?php
$host = "localhost";
$user = "root";
$pass = "";
$name = "db_sembako";
 
$database = new mysqli($host, $user, $pass, $name);
date_default_timezone_set('Asia/Jakarta');

include("enkripsi.php");
include("bilangan.php");
?>