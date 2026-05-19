<?php 
include 'koneksi.php'; 
include 'layout/header.php'; 
include 'layout/sidebar.php'; 
?>

<div class="col-md-10 p-4">

    <h3>Dashboard Absensi</h3>

    <?php
    $total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM absensi"))['total'];
    $hadir = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as hadir FROM absensi WHERE status_hadir='Hadir'"))['hadir'];
    $tidak = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as tidak FROM absensi WHERE status_hadir='Tidak Hadir'"))['tidak'];
    ?>

    <div class="row my-4">

        <div class="col-md-4">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <h5>Total</h5>
                    <h2><?= $total ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <h5>Hadir</h5>
                    <h2><?= $hadir ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-danger text-white shadow">
                <div class="card-body">
                    <h5>Tidak Hadir</h5>
                    <h2><?= $tidak ?></h2>
                </div>
            </div>
        </div>

    </div>

    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            Data Absensi
        </div>

        <div class="card-body">

            <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah</a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 1;
                    $q = mysqli_query($conn, "
                        SELECT a.*, p.nama 
                        FROM absensi a 
                        JOIN penerima_manfaat p 
                        ON a.id_penerima = p.id_penerima
                    ");

                    while ($d = mysqli_fetch_assoc($q)) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $d['nama'] ?></td>
                            <td><?= $d['tanggal'] ?></td>
                            <td>
                                <span class="badge <?= $d['status_hadir'] == 'Hadir' ? 'bg-success' : 'bg-danger' ?>">
                                    <?= $d['status_hadir'] ?>
                                </span>
                            </td>
                            <td>
                                <a href="edit.php?id=<?= $d['id_absensi'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapus.php?id=<?= $d['id_absensi'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>

            </table>

        </div>
    </div>

</div>

<?php include 'layout/footer.php'; ?>