<?php 
include 'koneksi.php'; 
include 'layout/header.php'; 
include 'layout/sidebar.php'; 
?>

<div class="col-md-10 p-4">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            Tambah Absensi
        </div>

        <div class="card-body">

            <form method="POST" action="proses.php">

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status_hadir" class="form-control">
                        <option>Hadir</option>
                        <option>Tidak Hadir</option>
                    </select>
                </div>

                <button name="tambah" class="btn btn-success">Simpan</button>

            </form>

        </div>
    </div>

</div>

<?php include 'layout/footer.php'; ?>