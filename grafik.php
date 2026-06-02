<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

include 'koneksi.php';
include 'layout/header.php';
include 'layout/sidebar.php';

// ambil filter
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

    <!-- ================= FILTER ================= -->
    <div class="card shadow mb-4">

        <div class="card-header text-white d-flex justify-content-between align-items-center">

            

            <form method="GET" class="d-flex search-box">

                <select name="sort" class="form-select form-select-sm me-2">
                    <option value="tanggal" <?= $sort=='tanggal'?'selected':'' ?>>Tanggal</option>
                    
                </select>

                <select name="order" class="form-select form-select-sm me-2">
                    <option value="DESC" <?= $order=='DESC'?'selected':'' ?>>DESC</option>
                    <option value="ASC" <?= $order=='ASC'?'selected':'' ?>>ASC</option>
                </select>

                <button class="btn btn-light btn-sm me-2">🔍</button>

                <a href="<?= $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary btn-sm">
                    Reset
                </a>

            </form>

        </div>

    </div>

    <!-- ================= GRAFIK ================= -->
    <div class="card shadow mb-4">

        <div class="card-header bg-info text-white">
            Grafik Absensi
        </div>

        <div class="card-body">
            <canvas id="grafik"></canvas>
        </div>

    </div>

    <?php
    // QUERY GRAFIK
    $query_chart = "
        SELECT a.tanggal,
        SUM(a.status_hadir='Hadir') as hadir,
        SUM(a.status_hadir='Tidak Hadir') as tidak
        FROM absensi a
        JOIN penerima_manfaat p
        ON a.id_penerima = p.id_penerima
    ";

    if(!empty($keyword)){
        $query_chart .= " WHERE p.nama LIKE '%$keyword%'";
    }

    $query_chart .= " GROUP BY a.tanggal ORDER BY a.tanggal $order";

    $q_chart = mysqli_query($conn, $query_chart);

    $tanggal = [];
    $hadir = [];
    $tidak = [];

    while($d = mysqli_fetch_assoc($q_chart)){
        $tanggal[] = $d['tanggal'];
        $hadir[] = $d['hadir'];
        $tidak[] = $d['tidak'];
    }
    ?>



<!-- CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('grafik'), {
    type: 'bar', // ganti jadi batang
    data: {
        labels: <?= json_encode($tanggal) ?>,
        datasets: [
            {
                label: 'Hadir',
                data: <?= json_encode($hadir) ?>,
                backgroundColor: 'rgba(40, 167, 69, 0.7)', // hijau
                borderColor: 'rgba(40, 167, 69, 1)',
                borderWidth: 1
            },
            {
                label: 'Tidak Hadir',
                data: <?= json_encode($tidak) ?>,
                backgroundColor: 'rgba(220, 53, 69, 0.7)', // merah
                borderColor: 'rgba(220, 53, 69, 1)',
                borderWidth: 1
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top'
            }
        }
    }
});
</script>

<?php include 'layout/footer.php'; ?>