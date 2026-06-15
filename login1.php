<?php

// Memulai session
session_start();

// Koneksi ke database
$koneksi = mysqli_connect(
    "localhost",
    "root",
    "",
    "db_penjualan"
);

// Mengecek apakah koneksi berhasil
if (!$koneksi) {
    die("Koneksi Gagal : " . mysqli_connect_error());
}

// Mengecek apakah tombol login ditekan
if (isset($_POST['login'])) {

    // Mengambil data dari form login
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Validasi jika username atau password kosong
    if (empty($username) || empty($password)) {

        echo "<script>
                alert('Username dan Password tidak boleh kosong');
              </script>";

    } else {

        // Mencari username pada tabel_user
        $query = mysqli_query(
            $koneksi,
            "SELECT * FROM tabel_user WHERE username='$username'"
        );

        // Jika username ditemukan
        if (mysqli_num_rows($query) > 0) {

            // Mengambil data user dari database
            $data = mysqli_fetch_assoc($query);

            // Membandingkan password input dengan password database
            if ($data['password'] == $password) {

                // Membuat session login
                $_SESSION['id_user']  = $data['id_user'];
                $_SESSION['username'] = $data['username'];
                $_SESSION['role']     = $data['role'];

                // Login berhasil dan pindah ke dashboard
                echo "<script>
                        alert('Login Berhasil');
                        window.location='index1.php';
                      </script>";
                exit;

            } else {

                // Password salah
                echo "<script>
                        alert('Password Salah');
                      </script>";
            }

        } else {

            // Username tidak ditemukan
            echo "<script>
                    alert('Username Tidak Ditemukan');
                  </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Login Sistem Penjualan</title>

<!-- Font Google -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">

<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

<!-- AdminLTE -->
<link rel="stylesheet" href="dist/css/adminlte.min.css">

<style>

/* Background halaman */
body{
    background: linear-gradient(135deg,#1e3c72,#2a5298);
    min-height:100vh;
}

/* Ukuran kotak login */
.login-box{
    width:420px;
}

/* Tampilan card */
.card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 15px 35px rgba(0,0,0,0.3);
}

/* Isi card */
.login-card-body{
    padding:35px;
}

/* Lingkaran logo */
.logo-circle{
    width:110px;
    height:110px;
    background:white;
    border-radius:50%;
    margin:0 auto 20px;
    display:flex;
    justify-content:center;
    align-items:center;
    box-shadow:0 5px 15px rgba(0,0,0,0.3);
}

/* Icon toko */
.logo-circle i{
    font-size:50px;
    color:#2a5298;
}

/* Judul aplikasi */
.login-logo a{
    color:white;
    font-weight:bold;
    font-size:28px;
}

/* Tulisan silakan login */
.login-box-msg{
    font-size:18px;
    font-weight:bold;
    color:#444;
}

/* Input username dan password */
.form-control{
    height:45px;
    border-radius:30px;
}

/* Icon pada input */
.input-group-text{
    border-radius:0 30px 30px 0;
}

/* Tombol login */
.btn-login{
    border-radius:30px;
    font-weight:bold;
    padding:10px;
}

/* Footer */
.footer-login{
    color:white;
    text-align:center;
    margin-top:15px;
}

/* Cursor icon mata */
.show-password{
    cursor:pointer;
}

</style>

</head>

<body class="hold-transition login-page">

<div class="login-box">

    <!-- Logo Sistem -->
    <div class="logo-circle">
        <i class="fas fa-store"></i>
    </div>

    <!-- Judul Sistem -->
    <div class="login-logo">
        <a href="#">
            SISTEM DATA<br>
            PENJUALAN
        </a>
    </div>

    <div class="card">

        <div class="card-body login-card-body">

            <p class="login-box-msg">
                Silakan Login
            </p>

            <!-- Form Login -->
            <form method="POST">

                <!-- Input Username -->
                <div class="input-group mb-3">

                    <input
                        type="text"
                        name="username"
                        class="form-control"
                        placeholder="Username"
                        required>

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>

                </div>

                <!-- Input Password -->
                <div class="input-group mb-3">

                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        placeholder="Password"
                        required>

                    <!-- Tombol Show Password -->
                    <div class="input-group-append">
                        <div class="input-group-text show-password"
                             onclick="togglePassword()">

                            <span id="iconPassword"
                                  class="fas fa-eye"></span>

                        </div>
                    </div>

                </div>

                <!-- Tombol Login -->
                <button
                    type="submit"
                    name="login"
                    class="btn btn-primary btn-block btn-login">

                    <i class="fas fa-sign-in-alt"></i>
                    LOGIN

                </button>

            </form>

        </div>

    </div>

    <!-- Footer -->
    <div class="footer-login">
        © 2026 Sistem Informasi Data Penjualan
    </div>

</div>

<!-- JQuery -->
<script src="plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE -->
<script src="dist/js/adminlte.min.js"></script>

<script>

// Fungsi menampilkan dan menyembunyikan password
function togglePassword(){

    var password = document.getElementById("password");
    var icon = document.getElementById("iconPassword");

    if(password.type === "password"){

        password.type = "text";

        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");

    }else{

        password.type = "password";

        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");

    }

}

</script>

</body>
</html>