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

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'tanggal';
$order = isset($_GET['order']) ? $_GET['order'] : 'DESC';

$allowed_sort = ['nama','tanggal','status_hadir'];

if(!in_array($sort,$allowed_sort)){
    $sort = 'tanggal';
}

$order = strtoupper($order) == 'ASC' ? 'ASC' : 'DESC';
?>

<div class="col-md-10 p-4">

    <div class="card shadow">

        <div class="card-header text-white d-flex justify-content-between align-items-center">

            <h5 class="mb-0">Riwayat Absensi</h5>

            <form method="GET" class="d-flex search-box">

                <input
                    type="text"
                    name="keyword"
                    class="form-control form-control-sm me-2"
                    placeholder="Cari nama..."
                    value="<?= htmlspecialchars($keyword); ?>"
                >

                <select name="sort" class="form-select form-select-sm me-2">
                    <option value="tanggal" <?= $sort=='tanggal'?'selected':'' ?>>
                        Tanggal
                    </option>

                    <option value="nama" <?= $sort=='nama'?'selected':'' ?>>
                        Nama
                    </option>

                    <option value="status_hadir" <?= $sort=='status_hadir'?'selected':'' ?>>
                        Status
                    </option>
                </select>

                <select name="order" class="form-select form-select-sm me-2">
                    <option value="DESC" <?= $order=='DESC'?'selected':'' ?>>
                        DESC
                    </option>

                    <option value="ASC" <?= $order=='ASC'?'selected':'' ?>>
                        ASC
                    </option>
                </select>

                <button type="submit" class="btn btn-light btn-sm me-2">
                    🔍
                </button>

                <a href="<?= $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary btn-sm">
                    Reset
                </a>

            </form>

        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

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

                if($sort == 'nama'){
                    $query .= " ORDER BY p.nama $order";
                }
                elseif($sort == 'status_hadir'){
                    $query .= " ORDER BY a.status_hadir $order";
                }
                else{
                    $query .= " ORDER BY a.tanggal $order";
                }

                $q = mysqli_query($conn, $query);

                if(mysqli_num_rows($q) > 0){

                    while($d = mysqli_fetch_assoc($q)){
                ?>

                <tr>
                    <td><?= $no++ ?></td>

                    <td><?= htmlspecialchars($d['nama']) ?></td>

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

<style>
.card{
    border:none;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.card-header{
    background:linear-gradient(135deg,#00c6ff,#0072ff)!important;
    border:none;
    padding:20px 25px;
}

.card-header h5{
    font-size:30px;
    font-weight:700;
    margin:0;
}

.search-box{
    width:700px;
}

.search-box input,
.search-box select{
    border:none;
    border-radius:12px;
}

.search-box input:focus,
.search-box select:focus{
    box-shadow:0 0 0 3px rgba(255,255,255,.35);
}

.btn-search{
    background:#fff;
    color:#0072ff;
    border:none;
    border-radius:12px;
}

.btn-reset{
    background:#dc3545;
    color:white;
    border:none;
    border-radius:12px;
}

.table{
    border-radius:12px;
    overflow:hidden;
}

.table-dark{
    background:#1f2937;
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

.card-body{
    background:#fafafa;
}
</style>