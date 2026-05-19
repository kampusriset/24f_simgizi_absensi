<?php
include 'koneksi.php';

if(isset($_POST['tambah'])){

    $nama = $_POST['nama'];
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status_hadir'];

    // CEK apakah nama sudah ada
    $cek = mysqli_query($conn, "SELECT * FROM penerima_manfaat WHERE nama='$nama'");

    if(mysqli_num_rows($cek) > 0){
        // Kalau sudah ada → ambil id
        $data = mysqli_fetch_assoc($cek);
        $id_penerima = $data['id_penerima'];
    } else {
        // Kalau belum ada → insert baru
        mysqli_query($conn, "INSERT INTO penerima_manfaat (nama) VALUES ('$nama')");
        $id_penerima = mysqli_insert_id($conn);
    }

    // Simpan ke absensi
    mysqli_query($conn, "INSERT INTO absensi (id_penerima, tanggal, status_hadir)
        VALUES ('$id_penerima','$tanggal','$status')");

    header("Location: index.php");
}

if(isset($_POST['edit'])){
mysqli_query($conn,"UPDATE absensi SET tanggal='$_POST[tanggal]',status_hadir='$_POST[status_hadir]' WHERE id_absensi='$_POST[id_absensi]'");
}

header("Location:index.php");