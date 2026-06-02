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

    <div class="card shadow">

        <div class="card-header bg-info text-white">
            Riwayat Absensi
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Status</th>
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
                            <span class="badge bg-success">Hadir</span>
                        <?php } else { ?>
                            <span class="badge bg-danger">Tidak Hadir</span>
                        <?php } ?>
                    </td>
                </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include 'layout/footer.php'; ?>