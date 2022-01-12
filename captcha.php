<?php
session_start();
$kode = substr(str_shuffle("123456789"), 0, 4);
$captcha = $kode;
$tampil = $kode;
$_SESSION['captcha'] = md5($captcha);
$gambar = imagecreate(90, 40);
$wk = imagecolorallocate($gambar, 255, 255, 255);//membuat warna background
$wt = imagecolorallocate($gambar, 91, 144, 231);//membuat warna tulisan
imagefilledrectangle($gambar, 0, 0, 90, 40, $wk);
imagestring($gambar, 10, 20, 10, $tampil, $wt);
imagejpeg($gambar);
?>