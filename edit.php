<?php
include 'koneksi.php';

$data = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM absensi WHERE id_absensi = $_GET[id]")
);
?>

<?php 
include 'layout/header.php'; 
include 'layout/sidebar.php'; 
?>

<div class="col-md-10 p-4">

    <div class="card shadow">
        <div class="card-header bg-warning">
            Edit Absensi
        </div>

        <div class="card-body">

            <form method="POST" action="proses.php">

                <input type="hidden" name="id_absensi" value="<?= $data['id_absensi'] ?>">

                <div class="mb-3">
                    <label>Tanggal</label>
                    <input 
                        type="date" 
                        name="tanggal" 
                        value="<?= $data['tanggal'] ?>" 
                        class="form-control"
                    >
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status_hadir" class="form-control">
                        <option <?= $data['status_hadir'] == 'Hadir' ? 'selected' : '' ?>>
                            Hadir
                        </option>
                        <option <?= $data['status_hadir'] == 'Tidak Hadir' ? 'selected' : '' ?>>
                            Tidak Hadir
                        </option>
                    </select>
                </div>

                <button name="edit" class="btn btn-success">Update</button>

            </form>

        </div>
    </div>

</div>

<?php include 'layout/footer.php'; ?>