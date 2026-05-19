<?php
include 'koneksi.php';
mysqli_query($conn,"DELETE FROM absensi WHERE id_absensi=$_GET[id]");
header("Location:index.php");