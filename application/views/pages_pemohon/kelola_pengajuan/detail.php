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
            <a class="nav-link" href="<?= base_url('Pemohon'); ?>">
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
        <li class="nav-item">
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

                <!-- Button -->
                <div>
                    <a href="<?= base_url('pengajuan'); ?>" class="btn btn-secondary btn-sm">
                        <i class="fas fa-fw fa-arrow-left"></i> Kembali
                    </a>
                </div>

                <!-- Page Heading -->
                <div class="card o-hidden border-0 shadow-lg my-3">
                    <div class="card-header text-white bg-success">
                        <h3 class="card-title mt-2">Detail Data Pengajuan</h3>
                    </div>
                    <!-- /.card-header -->

                    <!-- form start -->
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg">
                                <div class="px-4 mt-4">
                                    <div class="form-group">
                                        <label for="perihal">Perihal</label>
                                        <input type="text" class="form-control" name="perihal" readonly value="<?= $kelola_pengajuan['perihal']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg">
                                <div class="px-4">
                                    <div class="form-group">
                                        <label for="tempat_pelaksanaan">Tempat Pelaksanaan</label>
                                        <input type="text" class="form-control" name="tempat_pelaksanaan" readonly value="<?= $kelola_pengajuan['tempat_pelaksanaan']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="px-4">
                                    <div class="form-group">
                                        <label for="tanggal_pelaksanaan">Tanggal Pelaksanaan</label>
                                        <input type="date" class="form-control" name="tanggal_pelaksanaan" value="<?= $kelola_pengajuan['tanggal_pelaksanaan'] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg">
                                <div class="px-4">
                                    <div class="form-group">
                                        <label for="berkas_file">Berkas File Lampiran (PDF)</label>
                                        <?php if ($kelola_pengajuan['berkas_file']): ?>
                                            <div class="existing-files">
                                                <?php foreach (explode(',', $kelola_pengajuan['berkas_file']) as $file): ?>
                                                    <div class="file-item">
                                                        <div class="file-name">
                                                            <i class="fas fa-fw fa-file-pdf"></i> <?= $file ?>
                                                        </div>
                                                        <div class="file-actions">
                                                            <a href="<?= base_url('uploads/berkas/' . $file) ?>" target="_blank" class="btn btn-sm btn-info" title="Lihat File">
                                                                <i class="fas fa-fw fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_surat">Jenis Surat</label>
                                        <div class="row">
                                            <?php foreach ($jenis_surat as $js) : ?>
                                                <?php if (in_array($user->role, explode(',', $js['role_access']))) : ?>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input
                                                                class="form-check-input"
                                                                type="checkbox"
                                                                name="jenis_surat[]"
                                                                id="js<?= $js['id']; ?>"
                                                                value="<?= $js['id']; ?>"
                                                                <?= in_array($js['id'], explode(',', $kelola_pengajuan['jenis_surat'])) ? 'checked' : ''; ?>
                                                                disabled>
                                                            <label class="form-check-label" for="js<?= $js['id']; ?>">
                                                                <?= $js['nama_surat']; ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php if ($kelola_pengajuan['status'] == 'Ditolak Kaprodi') : ?>
                                        <div class="form-group">
                                            <label for="alasan_kaprodi">Alasan Ditolak</label>
                                            <input type="text" class="form-control text-danger" name="alasan_kaprodi" value="<?= $kelola_pengajuan['alasan_kaprodi']; ?>" readonly>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($kelola_pengajuan['status'] == 'Ditolak Kajur') : ?>
                                        <div class="form-group">
                                            <label for="alasan_kajur">Alasan Ditolak</label>
                                            <input type="text" class="form-control text-danger" name="alasan_kajur" value="<?= $kelola_pengajuan['alasan_kajur']; ?>" readonly>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->