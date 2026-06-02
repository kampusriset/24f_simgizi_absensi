<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

include 'koneksi.php';
include 'layout/header.php';
include 'layout/sidebar.php';
?>

<style>

body{
    background:#f5f7fb;
}

.dashboard-title{
    font-size:48px;
    font-weight:700;
    color:#1f2937;
}

.user-info{
    background:white;
    padding:12px 18px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.card{
    border:none;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.card-stat{
    transition:.3s;
}

.card-stat:hover{
    transform:translateY(-5px);
}

.card-total{
    background:linear-gradient(135deg,#00c6ff,#0072ff);
}

.card-hadir{
    background:linear-gradient(135deg,#00c853,#009624);
}

.card-tidak{
    background:linear-gradient(135deg,#ff416c,#ff4b2b);
}

.card-stat .card-body{
    padding:30px;
}

.card-stat h5{
    font-size:30px;
    margin-bottom:15px;
}

.card-stat h2{
    font-size:55px;
    font-weight:700;
}

.card-header{
    background:#1f2937 !important;
    color:white !important;
    border:none;
    padding:18px 25px;
    font-size:22px;
    font-weight:600;
}

.btn-tambah{
    background:linear-gradient(135deg,#00c6ff,#0072ff);
    border:none;
    border-radius:12px;
    padding:10px 20px;
    color:white;
    font-weight:600;
}

.btn-tambah:hover{
    color:white;
    transform:translateY(-2px);
}

.btn-edit{
    background:#ffc107;
    color:black;
    border:none;
    border-radius:10px;
}

.btn-edit:hover{
    background:#ffca2c;
}

.btn-hapus{
    background:#dc3545;
    color:white;
    border:none;
    border-radius:10px;
}

.btn-hapus:hover{
    background:#bb2d3b;
    color:white;
}

.table{
    margin-top:10px;
}

.table th{
    padding:16px;
}

.table td{
    padding:16px;
    vertical-align:middle;
}

.table tbody tr{
    transition:.3s;
}

.table tbody tr:hover{
    background:#eef6ff;
}

.badge{
    padding:8px 15px;
    border-radius:20px;
    font-size:13px;
}

</style>

<div class="col-md-10 p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="dashboard-title">
            Dashboard Absensi
        </h1>

        <div class="user-info">

            <span class="me-3">
                Halo, <b><?= $_SESSION['nama']; ?></b>
            </span>

            <a href="logout.php" class="btn btn-danger btn-sm">
                Logout
            </a>

        </div>

    </div>

<?php

$total = mysqli_fetch_assoc(
    mysqli_query($conn,
    "SELECT COUNT(*) as total FROM absensi")
)['total'];

$hadir = mysqli_fetch_assoc(
    mysqli_query($conn,
    "SELECT COUNT(*) as hadir
     FROM absensi
     WHERE status_hadir='Hadir'")
)['hadir'];

$tidak = mysqli_fetch_assoc(
    mysqli_query($conn,
    "SELECT COUNT(*) as tidak
     FROM absensi
     WHERE status_hadir='Tidak Hadir'")
)['tidak'];

?>

<div class="row mb-4">

    <div class="col-md-4 mb-3">

        <div class="card card-stat card-total text-white">

            <div class="card-body text-center">

                <h5>Total Absensi</h5>

                <h2><?= $total ?></h2>

            </div>

        </div>

    </div>

    <div class="col-md-4 mb-3">

        <div class="card card-stat card-hadir text-white">

            <div class="card-body text-center">

                <h5>Hadir</h5>

                <h2><?= $hadir ?></h2>

            </div>

        </div>

    </div>

    <div class="col-md-4 mb-3">

        <div class="card card-stat card-tidak text-white">

            <div class="card-body text-center">

                <h5>Tidak Hadir</h5>

                <h2><?= $tidak ?></h2>

            </div>

        </div>

    </div>

</div>

<div class="card">

    <div class="card-header">
        Data Absensi
    </div>

    <div class="card-body">

        <a href="tambah.php" class="btn btn-tambah mb-3">
            + Tambah Absensi
        </a>

        <table class="table table-bordered table-striped">

            <thead class="table-dark">

                <tr>

                    <th width="80">No</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th width="180">Aksi</th>

                </tr>

            </thead>

            <tbody>

            <?php

            $no = 1;

            $q = mysqli_query($conn,"
                SELECT a.*, p.nama
                FROM absensi a
                JOIN penerima_manfaat p
                ON a.id_penerima = p.id_penerima
                ORDER BY a.id_absensi DESC
            ");

            while($d = mysqli_fetch_assoc($q)){

            ?>

            <tr>

                <td><?= $no++ ?></td>

                <td><?= $d['nama'] ?></td>

                <td><?= $d['tanggal'] ?></td>

                <td>

                    <?php if($d['status_hadir']=='Hadir'){ ?>

                        <span class="badge bg-success">
                            ✓ Hadir
                        </span>

                    <?php } else { ?>

                        <span class="badge bg-danger">
                            ✕ Tidak Hadir
                        </span>

                    <?php } ?>

                </td>

                <td>

                    <a href="edit.php?id=<?= $d['id_absensi']; ?>"
                       class="btn btn-edit btn-sm">
                        Edit
                    </a>

                    <a href="hapus.php?id=<?= $d['id_absensi']; ?>"
                       class="btn btn-hapus btn-sm"
                       onclick="return confirm('Yakin ingin menghapus data?')">
                        Hapus
                    </a>

                </td>

            </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</div>

<?php include 'layout/footer.php'; ?>