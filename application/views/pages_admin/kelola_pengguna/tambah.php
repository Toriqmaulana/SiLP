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
                    <a href="<?= base_url('pengguna'); ?>" class="btn btn-secondary btn-sm">
                        <i class="fas fa-fw fa-arrow-left"></i> Kembali
                    </a>
                </div>

                <!-- Page Heading -->
                <div class="card o-hidden border-0 shadow-lg my-3">
                    <div class="card-header text-white bg-success">
                        <h3 class="card-title mt-2">Tambah Data Pengguna</h3>
                    </div>
                    <!-- /.card-header -->

                    <!-- form start -->
                    <form class="user" action="<?= base_url('tambahAksiPengguna'); ?>" method="post">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg">
                                    <div class="px-4 mt-4">
                                        <div class="form-group">
                                            <label for="id_jurusan">Jurusan</label>
                                            <select class="form-control" name="id_jurusan" id="id_jurusan" autofocus>
                                                <option value="">- Pilih Jurusan -</option>
                                                <?php foreach ($jurusan as $j) : ?>
                                                    <option value="<?= $j['id']; ?>" <?= set_value('id_jurusan') == $j['id'] ? 'selected' : ''; ?>><?= $j['nama_jurusan']; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="id_prodi">Prodi</label>
                                            <select class="form-control" name="id_prodi" id="id_prodi">
                                                <option value="">- Pilih Prodi -</option>
                                                <?php foreach ($prodi as $p) : ?>
                                                    <option value="<?= $p['id']; ?>" <?= set_value('id_prodi') == $p['id'] ? 'selected' : ''; ?>><?= $p['nama_prodi']; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username *</label>
                                            <input type="text" class="form-control" name="username" id="username" autocomplete="off" value="<?= set_value('username'); ?>">
                                            <?= form_error('username'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password *</label>
                                            <input type="password" class="form-control" name="password" id="password">
                                            <?= form_error('password'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="passconf">Konfirmasi Password *</label>
                                            <input type="password" class="form-control" name="passconf" id="passconf">
                                            <?= form_error('passconf'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama *</label>
                                            <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" value="<?= set_value('nama'); ?>">
                                            <?= form_error('nama'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="px-4 mt-4">
                                        <div class="form-group">
                                            <label for="nip">NIP *</label>
                                            <input type="text" class="form-control" name="nip" id="nip" autocomplete="off" value="<?= set_value('nip'); ?>">
                                            <?= form_error('nip'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="pangkat">Pangkat *</label>
                                            <input type="text" class="form-control" name="pangkat" id="pangkat" autocomplete="off" value="<?= set_value('pangkat'); ?>">
                                            <?= form_error('pangkat'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="golongan">Golongan *</label>
                                            <input type="text" class="form-control" name="golongan" id="golongan" autocomplete="off" value="<?= set_value('golongan'); ?>">
                                            <?= form_error('golongan'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="jabatan">Jabatan *</label>
                                            <select class="form-control" name="jabatan" id="jabatan">
                                                <option value="">- Pilih Jabatan -</option>
                                                <option value="Dosen" <?= set_value('jabatan') == 'Dosen' ? 'selected' : ''; ?>>Dosen</option>
                                                <option value="Kaprodi" <?= set_value('jabatan') == 'Kaprodi' ? 'selected' : ''; ?>>Kaprodi</option>
                                                <option value="Kajur" <?= set_value('jabatan') == 'Kajur' ? 'selected' : ''; ?>>Kajur</option>
                                                <option value="Dekan" <?= set_value('jabatan') == 'Dekan' ? 'selected' : ''; ?>>Dekan</option>
                                                <option value="Wadek 1" <?= set_value('jabatan') == 'Wadek 1' ? 'selected' : ''; ?>>Wadek 1</option>
                                                <option value="Wadek 2" <?= set_value('jabatan') == 'Wadek 2' ? 'selected' : ''; ?>>Wadek 2</option>
                                                <option value="Wadek 3" <?= set_value('jabatan') == 'Wadek 3' ? 'selected' : ''; ?>>Wadek 3</option>
                                                <option value="Kabag TU" <?= set_value('jabatan') == 'Kabag TU' ? 'selected' : ''; ?>>Kabag TU</option>
                                                <option value="Staf" <?= set_value('jabatan') == 'Staf' ? 'selected' : ''; ?>>Staf</option>
                                            </select>
                                            <?= form_error('jabatan'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="role">Role *</label>
                                            <select class="form-control" name="role" id="role">
                                                <option value="">- Pilih Role -</option>
                                                <?php $roles = [
                                                    1 => 'Dekan',
                                                    2 => 'Wadek',
                                                    3 => 'Kabag_TU',
                                                    4 => 'Staf',
                                                    5 => 'Dosen',
                                                    6 => 'Kaprodi',
                                                    7 => 'Kajur'
                                                    // 8 => 'Admin'
                                                ];
                                                foreach ($roles as $r => $rn) : ?>
                                                    <option value="<?= $r; ?>" <?= set_value('role') == $r ? 'selected' : ''; ?>><?= $rn; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?= form_error('role'); ?>
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
                            <!-- <button type="reset" name="reset" class="btn btn-dark btn-sm float-right">
                                <i class="fas fa-fw fa-sync-alt"></i> Reset
                            </button> -->
                        </div>
                    </form>
                </div>
                <!-- /.card -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->