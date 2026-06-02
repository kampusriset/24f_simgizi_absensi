<?php
session_start();
include 'koneksi.php';

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $q = mysqli_query($conn,"SELECT * FROM users WHERE username='$username'");

    if(mysqli_num_rows($q) > 0){

        $user = mysqli_fetch_assoc($q);

        if(password_verify($password, $user['password'])){

            $_SESSION['login'] = true;
            $_SESSION['nama'] = $user['nama'];

            header("Location:index.php");
            exit;
        }
    }

    $error = "Username atau Password salah!";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Absensi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background: linear-gradient(135deg,#0d6efd,#6610f2);
            font-family:'Segoe UI',sans-serif;
        }

        .login-card{
            width:420px;
            border:none;
            border-radius:20px;
            overflow:hidden;
            box-shadow:0 15px 35px rgba(0,0,0,0.25);
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
            padding:25px;
            border:none;
            text-align:center;
        }

        .logo{
            width:80px;
            height:80px;
            background:white;
            border-radius:50%;
            margin:auto;
            margin-bottom:15px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:35px;
        }

        .card-header h3{
            color:white;
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

        .btn-login{
            width:100%;
            height:50px;
            border:none;
            border-radius:12px;
            background:linear-gradient(135deg,#0d6efd,#2563eb);
            color:white;
            font-weight:bold;
            font-size:16px;
            transition:.3s;
        }

        .btn-login:hover{
            transform:translateY(-2px);
            box-shadow:0 10px 20px rgba(37,99,235,.3);
        }

        .register-link{
            text-align:center;
            margin-top:20px;
        }

        .register-link a{
            text-decoration:none;
            font-weight:bold;
        }

        .alert{
            border-radius:12px;
        }
    </style>
</head>
<body>

<div class="card login-card">

    <div class="card-header">
        <div class="logo">
            📋
        </div>
        <h3>LOGIN ABSENSI</h3>
    </div>

    <div class="card-body">

        <?php if(isset($error)){ ?>
            <div class="alert alert-danger">
                <?= $error ?>
            </div>
        <?php } ?>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input
                    type="text"
                    name="username"
                    class="form-control"
                    placeholder="Masukkan username"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Masukkan password"
                    required>
            </div>

            <button type="submit"
                    name="login"
                    class="btn-login">
                Login
            </button>

        </form>

        <div class="register-link">
            Belum punya akun?
            <a href="register.php">Daftar</a>
        </div>

    </div>

</div>

</body>
</html>