<?php 
include 'koneksi.php'; 
include 'layout/header.php'; 
include 'layout/sidebar.php'; 
?>

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
    font-size:24px;
    font-weight:700;
}

.card-body{
    background:#fafafa;
    padding:30px;
}

.form-label{
    font-weight:600;
    color:#374151;
    margin-bottom:8px;
}

.form-control,
.form-select{
    border-radius:12px;
    border:1px solid #d1d5db;
    padding:12px 15px;
    transition:.3s;
}

.form-control:focus,
.form-select:focus{
    border-color:#0072ff;
    box-shadow:0 0 0 4px rgba(0,114,255,.15);
}

.btn-simpan{
    background:linear-gradient(135deg,#00c853,#009624);
    border:none;
    color:white;
    padding:12px 25px;
    border-radius:12px;
    font-weight:600;
    transition:.3s;
}

.btn-simpan:hover{
    transform:translateY(-2px);
    color:white;
    box-shadow:0 8px 20px rgba(0,200,83,.3);
}

.form-section{
    margin-bottom:20px;
}
</style>

<div class="col-md-10 p-4">

    <div class="card">

        <div class="card-header text-white">
            Tambah Absensi
        </div>

        <div class="card-body">

            <form method="POST" action="proses.php">

                <div class="form-section">
                    <label class="form-label">
                        Nama
                    </label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        placeholder="Masukkan nama"
                        required
                    >
                </div>

                <div class="form-section">
                    <label class="form-label">
                        Tanggal
                    </label>

                    <input
                        type="date"
                        name="tanggal"
                        class="form-control"
                        required
                    >
                </div>

                <div class="form-section">
                    <label class="form-label">
                        Status Kehadiran
                    </label>

                    <select name="status_hadir" class="form-select">
                        <option value="Hadir">✅ Hadir</option>
                        <option value="Tidak Hadir">❌ Tidak Hadir</option>
                    </select>
                </div>

                <button type="submit" name="tambah" class="btn btn-simpan">
                    💾 Simpan Absensi
                </button>

            </form>

        </div>

    </div>

</div>

<?php include 'layout/footer.php'; ?>