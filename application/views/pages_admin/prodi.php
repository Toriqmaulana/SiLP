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

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-2">
                    <h1 class="h3 mb-2 text-gray-800">Data Prodi</h1>
                </div>

                <?php if ($this->session->flashdata('message')) : ?>
                    <div class="alert alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('message'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <a href="<?= base_url('tambahProdi'); ?>" class="btn btn-success btn-sm">
                            <i class="fas fa-fw fa-plus"></i> Tambah
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Prodi</th>
                                        <th>Nama Prodi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $no = 1;
                                    foreach ($kelola_prodi as $kp) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $kp['kode_prodi']; ?></td>
                                            <td><?= $kp['nama_prodi']; ?></td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="<?= base_url('editProdi/' . $kp['id']); ?>" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-fw fa-edit"></i>
                                                    </a>

                                                    <a href="<?= base_url('hapusProdi/' . $kp['id']); ?>" class="btn btn-danger btn-sm ml-2" onclick="return confirm('Hapus data ini?');">
                                                        <i class="fas fa-fw fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->