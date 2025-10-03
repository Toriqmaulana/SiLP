<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

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
            <a class="nav-link" href="<?= base_url('Admin'); ?>">
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
            <a class="nav-link" href="<?= base_url('pengguna'); ?>">
                <i class="fas fa-fw fa-users"></i>
                <span>Pengguna</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('prodi'); ?>">
                <i class="fas fa-fw fa-user-graduate"></i>
                <span>Prodi</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('jurusan'); ?>">
                <i class="fas fa-fw fa-user-tie"></i>
                <span>Jurusan</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('jenisSurat'); ?>">
                <i class="fas fa-fw fa-envelope-open-text"></i>
                <span>Jenis Surat</span></a>
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
                                    <span class="text-gray-600 small">(<?= $user->role; ?>)</span>
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

                <!-- Button -->
                <div>
                    <a href="<?= base_url('jenisSurat'); ?>" class="btn btn-secondary btn-sm">
                        <i class="fas fa-fw fa-arrow-left"></i> Kembali
                    </a>
                </div>

                <!-- Page Heading -->
                <div class="card o-hidden border-0 shadow-lg my-3">
                    <div class="card-header text-white bg-success">
                        <h3 class="card-title mt-2">Edit Data Jenis Surat</h3>
                    </div>
                    <!-- /.card-header -->

                    <!-- form start -->
                    <form class="user" action="<?= base_url('editAksiJenisSurat/' . $jenis_surat['id']); ?>" method="post">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg">
                                    <div class="px-4 mt-4">
                                        <div class="form-group">
                                            <label for="kode_surat">Kode Surat</label>
                                            <input type="text" class="form-control" name="kode_surat" id="kode_surat" autofocus autocomplete="off" value="<?= $jenis_surat['kode_surat']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="nomor_surat">Nomor Surat</label>
                                            <input type="text" class="form-control" name="nomor_surat" id="nomor_surat" autocomplete="off" value="<?= $jenis_surat['nomor_surat']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="px-4 mt-4">
                                        <div class="form-group">
                                            <label for="nama_surat">Nama Surat</label>
                                            <input type="text" class="form-control" name="nama_surat" id="nama_surat" autocomplete="off" value="<?= $jenis_surat['nama_surat'] ?>">
                                            <?= form_error('nama_surat'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_jenis_surat">Nama Jenis Surat</label>
                                            <input type="text" class="form-control" name="nama_jenis_surat" id="nama_jenis_surat" autocomplete="off" value="<?= $jenis_surat['nama_jenis_surat'] ?>">
                                            <?= form_error('nama_jenis_surat'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg">
                                    <div class="px-4">
                                        <div class="form-group">
                                            <label for="role_access">Role Access</label>
                                            <div class="row">
                                                <?php foreach ($role_access as $ra) : ?>
                                                    <div class="col-md-2">
                                                        <div class="form-check">
                                                            <input
                                                                class="form-check-input"
                                                                type="checkbox"
                                                                name="role_access[]"
                                                                value="<?= $ra; ?>"
                                                                <?= in_array($ra, explode(',', $jenis_surat['role_access'])) ? 'checked' : ''; ?>>
                                                            <label class="form-check-label" for="role_access<?= $ra; ?>">
                                                                <?= $ra; ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                            <?= form_error('role_access[]'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" name="edit" class="btn btn-success btn-sm">
                                <i class="fas fa-fw fa-save"></i> Submit
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->