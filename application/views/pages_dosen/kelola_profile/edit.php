<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center">
            <div class="sidebar-brand-icon">
                <i class="fas fa-fw fa-envelope"></i>
            </div>
            <div class="sidebar-brand-text mx-3">SI Layanan Persuratan</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('Dosen'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Menu
        </div>

        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('pengajuan'); ?>">
                <i class='fas fa-fw fa-paper-plane'></i>
                <span>Pengajuan</span></a>
        </li>

        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('arsip'); ?>">
                <i class='fas fa-fw fa-folder-open'></i>
                <span>Arsip Pengajuan</span></a>
        </li>

        <!-- Nav Item -->
        <li class="nav-item active">
            <a class="nav-link" href="<?= base_url('profile'); ?>">
                <i class="fas fa-fw fa-user"></i>
                <span>Profile</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Logout -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div class="d-flex flex-column justify-content-center">
                                    <span class="text-gray-600 small"><?= $user->nama; ?></span>
                                    <span class="text-gray-600 small">(<?= $user->jabatan; ?>)</span>
                                </div>
                                <div class="ml-3">
                                    <img class="img-profile rounded-circle"
                                        src="<?= base_url('assets/'); ?>img/undraw_profile.svg">
                                </div>
                            </div>
                        </a>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card o-hidden border-0 shadow-lg my-3">
                    <div class="card-header text-white bg-success">
                        <h3 class="card-title mt-2">Edit Data Profile</h3>
                    </div>
                    <!-- /.card-header -->

                    <?php if ($this->session->flashdata('message')) : ?>
                        <div class="alert alert-dismissible fade show mb-0" role="alert">
                            <?= $this->session->flashdata('message'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <!-- form start -->
                    <form class="user" action="<?= base_url('editProfile/' . $kelola_user['id']); ?>" method="post">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg">
                                    <div class="p-4">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" value="<?= $kelola_user['nama'] ?>" autofocus>
                                            <?= form_error('nama'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="passnow">Password Lama</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" name="passnow" id="passnow" autocomplete="off" onfocus="showPasswordFields()" onblur="hidePasswordFields()">
                                                <span class="input-group-text" onclick="togglePassword('passnow', 'toggleIcon')" style="cursor: pointer;">
                                                    <i class="fas fa-fw fa-eye-slash" id="toggleIcon"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group" id="newPasswordFields" style="display: none;">
                                            <label for="passnew">Password Baru *</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" name="passnew" id="passnew" autocomplete="off">
                                                <span class="input-group-text" onclick="togglePassword('passnew', 'toggleIcon1')" style="cursor: pointer;">
                                                    <i class="fas fa-fw fa-eye-slash" id="toggleIcon1"></i>
                                                </span>
                                            </div>
                                            <?= form_error('passnew'); ?>
                                        </div>
                                        <div class="form-group" id="passconfField" style="display: none;">
                                            <label for="passconf">Konfirmasi Password Baru *</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" name="passconf" id="passconf" autocomplete="off">
                                                <span class="input-group-text" onclick="togglePassword('passconf', 'toggleIcon2')" style="cursor: pointer;">
                                                    <i class="fas fa-fw fa-eye-slash" id="toggleIcon2"></i>
                                                </span>
                                            </div>
                                            <?= form_error('passconf'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" name="edit" class="btn btn-success btn-sm">
                                <i class="fas fa-fw fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <script>
            // Fungsi untuk menampilkan form Password Baru dan Konfirmasi Password Baru
            function showPasswordFields() {
                document.getElementById("newPasswordFields").style.display = "block";
                document.getElementById("passconfField").style.display = "block";
            }

            // Fungsi untuk menyembunyikan form Password Baru dan Konfirmasi Password Baru jika Password Lama tidak di-click
            function hidePasswordFields() {
                const passnow = document.getElementById("passnow").value;
                if (!passnow) {
                    document.getElementById("newPasswordFields").style.display = "none";
                    document.getElementById("passconfField").style.display = "none";
                }
            }
        </script>

        <script>
            // Fungsi untuk menampilkan atau menyembunyikan password
            function togglePassword(fieldId, iconId) {
                const passwordField = document.getElementById(fieldId);
                const toggleIcon = document.getElementById(iconId);

                // Toggle password visibility
                if (passwordField.type === "password") {
                    passwordField.type = "text"; // Show password
                    toggleIcon.classList.remove("fa-eye-slash");
                    toggleIcon.classList.add("fa-eye");
                } else {
                    passwordField.type = "password"; // Hide password
                    toggleIcon.classList.remove("fa-eye");
                    toggleIcon.classList.add("fa-eye-slash");
                }
            }
        </script>