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

<div class="col-md-10 p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Dashboard Absensi</h3>

        <div>
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
        mysqli_query($conn, "SELECT COUNT(*) as total FROM absensi")
    )['total'];

    $hadir = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT COUNT(*) as hadir FROM absensi WHERE status_hadir='Hadir'")
    )['hadir'];

    $tidak = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT COUNT(*) as tidak FROM absensi WHERE status_hadir='Tidak Hadir'")
    )['tidak'];
    ?>

    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card bg-primary text-white shadow">
                <div class="card-body text-center">
                    <h5>Total Absensi</h5>
                    <h2><?= $total ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-success text-white shadow">
                <div class="card-body text-center">
                    <h5>Hadir</h5>
                    <h2><?= $hadir ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-danger text-white shadow">
                <div class="card-body text-center">
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

            <a href="tambah.php" class="btn btn-primary mb-3">
                + Tambah Absensi
            </a>

            <table class="table table-bordered table-striped">

                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th width="150">Aksi</th>
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
                        <?php if($d['status_hadir'] == 'Hadir'){ ?>
                            <span class="badge bg-success">
                                Hadir
                            </span>
                        <?php } else { ?>
                            <span class="badge bg-danger">
                                Tidak Hadir
                            </span>
                        <?php } ?>
                    </td>

                    <td>
                        <a href="edit.php?id=<?= $d['id_absensi']; ?>"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <a href="hapus.php?id=<?= $d['id_absensi']; ?>"
                           class="btn btn-danger btn-sm"
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