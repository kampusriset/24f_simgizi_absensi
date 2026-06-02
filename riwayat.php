<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

include 'koneksi.php';
include 'layout/header.php';
include 'layout/sidebar.php';

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
?>

<div class="col-md-10 p-4">

    <div class="card shadow">

        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">

            <h5 class="mb-0">Riwayat Absensi</h5>

            <form method="GET" class="d-flex" style="width:400px;">

                <input
                    type="text"
                    name="keyword"
                    class="form-control form-control-sm me-2"
                    placeholder="Cari nama..."
                    value="<?= htmlspecialchars($keyword); ?>"
                >

                <button type="submit" class="btn btn-light btn-sm me-2">
                    🔍
                </button>

                <a href="<?= $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary btn-sm">
                    Reset
                </a>

            </form>

        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead class="table-dark">
                    <tr>
                        <th width="80">No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th width="150">Status</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                $no = 1;

                $query = "
                    SELECT a.*, p.nama
                    FROM absensi a
                    JOIN penerima_manfaat p
                    ON a.id_penerima = p.id_penerima
                ";

                if(!empty($keyword)){
                    $query .= " WHERE p.nama LIKE '%$keyword%'";
                }

                $query .= " ORDER BY a.id_absensi DESC";

                $q = mysqli_query($conn, $query);

                if(mysqli_num_rows($q) > 0){

                    while($d = mysqli_fetch_assoc($q)){
                ?>

                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d['nama'] ?></td>
                    <td><?= $d['tanggal'] ?></td>

                    <td>
                        <?php if($d['status_hadir'] == 'Hadir'){ ?>
                            <span class="badge bg-success">Hadir</span>
                        <?php } else { ?>
                            <span class="badge bg-danger">Tidak Hadir</span>
                        <?php } ?>
                    </td>
                </tr>

                <?php
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="4" class="text-center">
                            Data tidak ditemukan
                        </td>
                    </tr>
                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include 'layout/footer.php'; ?>