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
            <a class="nav-link" href="<?= base_url('Kaprodi'); ?>">
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
            <a class="nav-link" href="<?= base_url('suratKaprodi'); ?>">
                <i class='fas fa-fw fa-envelope'></i>
                <span>Surat Masuk</span></a>
        </li>

        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('arsipSuratKaprodi'); ?>">
                <i class='fas fa-fw fa-folder-open'></i>
                <span>Arsip Surat Masuk</span></a>
        </li>

        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('suratpengajuanKaprodi'); ?>">
                <i class='fas fa-fw fa-file'></i>
                <span>Pengajuan</span></a>
        </li>

        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('arsipSuratPengajuanKaprodi'); ?>">
                <i class='fas fa-fw fa-archive'></i>
                <span>Arsip Pengajuan</span></a>
        </li>

        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('profileKaprodi'); ?>">
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

                <!-- Button -->
                <div>
                    <a href="<?= base_url('suratKaprodi'); ?>" class="btn btn-secondary btn-sm">
                        <i class="fas fa-fw fa-arrow-left"></i> Kembali
                    </a>
                </div>

                <!-- Page Heading -->
                <div class="card o-hidden border-0 shadow-lg my-3">
                    <div class="card-header text-white bg-success">
                        <h3 class="card-title mt-2">Edit Data Pengajuan</h3>
                    </div>
                    <!-- /.card-header -->

                    <!-- form start -->
                    <form class="user" action="<?= base_url('editAksiPengajuanKaprodi/' . $kelola_pengajuan['id']); ?>" method="post">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg">
                                    <div class="px-4 mt-4">
                                        <div class="form-group">
                                            <label for="perihal">Perihal</label>
                                            <input type="text" class="form-control" name="perihal" autofocus autocomplete="off" value="<?= $kelola_pengajuan['perihal']; ?>">
                                            <?= form_error('perihal'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg">
                                    <div class="px-4">
                                        <div class="form-group">
                                            <label for="tempat_pelaksanaan">Tempat Pelaksanaan</label>
                                            <input type="text" class="form-control" name="tempat_pelaksanaan" autocomplete="off" value="<?= $kelola_pengajuan['tempat_pelaksanaan']; ?>">
                                            <?= form_error('tempat_pelaksanaan'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="px-4">
                                        <div class="form-group">
                                            <label for="tanggal_pelaksanaan">Tanggal Pelaksanaan</label>
                                            <input type="date" class="form-control" name="tanggal_pelaksanaan" id="tanggal_pelaksanaan" value="<?= $kelola_pengajuan['tanggal_pelaksanaan'] ?>">
                                            <?= form_error('tanggal_pelaksanaan'); ?>
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