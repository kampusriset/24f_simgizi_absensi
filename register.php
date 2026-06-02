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
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Registrasi User</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body{
        min-height:100vh;
        display:flex;
        justify-content:center;
        align-items:center;
        background:linear-gradient(135deg,#0d6efd,#6610f2);
        font-family:'Segoe UI',sans-serif;
    }

    .register-card{
        width:450px;
        border:none;
        border-radius:20px;
        overflow:hidden;
        box-shadow:0 15px 35px rgba(0,0,0,.25);
        animation:fadeIn .5s ease;
    }

    @keyframes fadeIn{
        from{
            opacity:0;
            transform:translateY(-20px);
        }
        to{
            opacity:1;
            transform:translateY(0);
        }
    }

    .card-header{
        background:linear-gradient(135deg,#0d6efd,#4f46e5);
        border:none;
        text-align:center;
        padding:25px;
        color:white;
    }

    .logo{
        width:80px;
        height:80px;
        background:white;
        border-radius:50%;
        margin:auto;
        margin-bottom:15px;
        display:flex;
        justify-content:center;
        align-items:center;
        font-size:35px;
    }

    .card-header h3{
        margin:0;
        font-weight:bold;
    }

    .card-body{
        padding:30px;
        background:white;
    }

    .form-label{
        font-weight:600;
    }

    .form-control{
        height:50px;
        border-radius:12px;
        border:2px solid #e5e7eb;
        transition:.3s;
    }

    .form-control:focus{
        border-color:#0d6efd;
        box-shadow:0 0 10px rgba(13,110,253,.2);
    }

    .btn-daftar{
        width:100%;
        height:50px;
        border:none;
        border-radius:12px;
        background:linear-gradient(135deg,#16a34a,#22c55e);
        color:white;
        font-weight:bold;
        font-size:16px;
        transition:.3s;
    }

    .btn-daftar:hover{
        transform:translateY(-2px);
        box-shadow:0 10px 20px rgba(34,197,94,.3);
    }

    .login-link{
        text-align:center;
        margin-top:20px;
    }

    .login-link a{
        text-decoration:none;
        font-weight:bold;
    }
</style>

</head>
<body>

<div class="card register-card">

    <div class="card-header">
        <div class="logo">
            📝
        </div>
        <h3>REGISTRASI USER</h3>
    </div>

    <div class="card-body">

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text"
                       name="nama"
                       class="form-control"
                       placeholder="Masukkan nama lengkap"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text"
                       name="username"
                       class="form-control"
                       placeholder="Masukkan username"
                       required>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Masukkan password"
                       required>
            </div>

            <button type="submit"
                    name="register"
                    class="btn-daftar">
                Daftar Sekarang
            </button>

        </form>

        <div class="login-link">
            Sudah punya akun?
            <a href="login.php">Login</a>
        </div>

    </div>

</div>

</body>
</html>