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
            <a class="nav-link" href="<?= base_url('Staf'); ?>">
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
            <a class="nav-link" href="<?= base_url('disposisiStaf'); ?>">
                <i class='fas fa-fw fa-inbox'></i>
                <span>Disposisi</span></a>
        </li>

        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('arsipDisposisiStaf'); ?>">
                <i class='fas fa-fw fa-folder-open'></i>
                <span>Arsip Disposisi</span></a>
        </li>

        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('suratStaf'); ?>">
                <i class='fas fa-fw fa-envelope'></i>
                <span>Surat Keluar</span></a>
        </li>

        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('arsipSuratKeluarStaf'); ?>">
                <i class='fas fa-fw fa-folder'></i>
                <span>Arsip Surat Keluar</span></a>
        </li>

        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('profileStaf'); ?>">
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
                    <a href="<?= base_url('suratStaf'); ?>" class="btn btn-secondary btn-sm">
                        <i class="fas fa-fw fa-arrow-left"></i> Kembali
                    </a>
                </div>

                <!-- Page Heading -->
                <div class="card o-hidden border-0 shadow-lg my-3">
                    <div class="card-header text-white bg-success">
                        <h3 class="card-title mt-2">Upload File Surat Keluar</h3>
                    </div>
                    <!-- /.card-header -->

                    <!-- form start -->
                    <form class="user" action="<?= base_url('tambahAksiSuratKeluarStaf/' . $kelola_sk['id']); ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg">
                                    <div class="p-4">
                                        <div class="form-group">
                                            <div class="row">
                                                <?php foreach ($jenis_surat as $js) : ?>
                                                    <?php if (in_array($js['id'], explode(',', $kelola_sk['jenis_surat']))) : ?>
                                                        <div class="col-md-12">
                                                            <label for="file_<?= strtolower($js['nama_jenis_surat']) ?>">Upload File <?= $js['nama_surat'] ?> (PDF) *</label>
                                                            <input type="file" class="form-control file-input" name="file_<?= strtolower($js['nama_jenis_surat']) ?>" id="file_<?= strtolower($js['nama_jenis_surat']) ?>" accept=".pdf">
                                                            <small class="text-muted">Max size: 5 MB.</small>
                                                            <div class="file-error text-danger" style="display: none;"></div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status *</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="">- Pilih Status -</option>
                                                <option value="Surat Selesai">Surat Selesai</option>
                                            </select>
                                            <?= form_error('status'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" name="tambah" class="btn btn-success btn-sm">
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

        <script>
            document.querySelectorAll('.file-input').forEach(function(inputFile) {
                inputFile.addEventListener('change', function(e) {
                    const fileError = e.target.closest('.col-md-12').querySelector('.file-error');
                    fileError.style.display = 'none'; // Reset error message

                    Array.from(e.target.files).forEach(file => {
                        // Cek ukuran file (5 MB = 5 * 1024 * 1024 bytes)
                        if (file.size > 5 * 1024 * 1024) {
                            fileError.textContent = `File "${file.name}" melebihi batas ukuran maksimal 5 MB!`;
                            fileError.style.display = 'block';
                            e.target.value = ''; // Reset input file
                            return;
                        }
                    });
                });
            });
        </script>