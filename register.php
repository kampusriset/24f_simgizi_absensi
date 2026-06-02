<?php
include 'koneksi.php';

if(isset($_POST['register'])){

    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $cek = mysqli_query($conn,
        "SELECT * FROM users WHERE username='$username'"
    );

    if(mysqli_num_rows($cek) > 0){
        echo "<script>alert('Username sudah digunakan');</script>";
    } else {

        mysqli_query($conn,
        "INSERT INTO users(nama,username,password)
        VALUES('$nama','$username','$password')");

        echo "<script>
            alert('Registrasi berhasil');
            window.location='login.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            Registrasi User
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" name="register" class="btn btn-success">
                    Daftar
                </button>

            </form>

        </div>
    </div>
</div>

</body>
</html>