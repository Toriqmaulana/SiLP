<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SILP - <?= $judul; ?></title>

    <!-- Favicons -->
    <link href="<?= base_url('assets/') ?>img/logo-surat.png" rel="icon">
    <link href="<?= base_url('assets/') ?>img/logo-surat.png" rel="apple-touch-icon">

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            max-width: 750px;
            width: 100%;
            display: flex;
            overflow: hidden;
        }

        .login-left {
            background-color: #fff;
            padding: 40px;
            flex: 1;
            border: 1px solid #dee2e6;
            /* border */
            border-radius: 35px 0 0 35px;
            /* hanya round di kiri atas & kiri bawah */
        }

        .login-right {
            background-color: #198754;
            /* hijau tua */
            color: #fff;
            padding: 40px;
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            border-radius: 0 35px 35px 0;
            /* round kanan atas & kanan bawah */
        }

        .login-right h6 {
            color: #fff;
        }

        .login-right h5 {
            font-weight: bold;
            color: #fff;
        }

        .btn-login {
            background-color: #198754;
            border: none;
            color: #fff;
        }

        .btn-login:focus,
        .btn-login:active {
            background-color: #14a44d !important;
            color: #fff !important;
        }

        .btn-login:hover {
            background-color: #14a44d;
            /* sedikit lebih terang saat hover */
            color: #fff;
        }
    </style>

</head>

<body>

    <div class="login-card">
        <!-- Left Section -->
        <div class="login-left text-center">
            <div class="mb-4">
                <img src="<?= base_url('assets/') ?>img/logo.png" alt="Logo" width="120">
            </div>

            <?= $this->session->flashdata('pesan'); ?>

            <form action="<?= base_url('Homepage'); ?>" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username" required autofocus autocomplete="off">
                </div>
                <div class="mb-3 input-group">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password" required autocomplete="off">
                    <span class="input-group-text" onclick="togglePassword()" style="cursor:pointer;">
                        <i class="bi bi-eye-slash" id="toggleIcon"></i>
                    </span>
                </div>
                <?= $this->session->flashdata('message'); ?>
                <button type="submit" name="login" class="btn btn-login btn-lg w-100">Login</button>
            </form>
        </div>

        <!-- Right Section -->
        <div class="login-right text-center">
            <h5>FORM LOGIN</h5>
            <h6>Sistem Informasi Layanan Persuratan</h6>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const toggleIcon = document.getElementById("toggleIcon");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("bi-eye-slash");
                toggleIcon.classList.add("bi-eye");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("bi-eye");
                toggleIcon.classList.add("bi-eye-slash");
            }
        }
    </script>

</body>

</html>