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
                        <h3 class="card-title mt-2">Edit Data Pengguna</h3>
                    </div>
                    <!-- /.card-header -->

                    <!-- form start -->
                    <form class="user" action="<?= base_url('editAksiPengguna/' . $kelola_user['id']); ?>" method="post">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg">
                                    <div class="px-4 mt-4">
                                        <div class="form-group">
                                            <label for="id_jurusan">Jurusan</label>
                                            <select class="form-control" id="id_jurusan" name="id_jurusan" autofocus>
                                                <option value=""></option>
                                                <?php foreach ($jurusan as $j) : ?>
                                                    <?php if ($j['id'] == $kelola_user['id_jurusan']) : ?>
                                                        <option value="<?= $j['id']; ?>" selected><?= $j['nama_jurusan']; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $j['id']; ?>"><?= $j['nama_jurusan']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="id_prodi">Prodi</label>
                                            <select class="form-control" id="id_prodi" name="id_prodi">
                                                <option value=""></option>
                                                <?php foreach ($prodi as $p) : ?>
                                                    <?php if ($p['id'] == $kelola_user['id_prodi']) : ?>
                                                        <option value="<?= $p['id']; ?>" selected><?= $p['nama_prodi']; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $p['id']; ?>"><?= $p['nama_prodi']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" value="<?= $kelola_user['nama'] ?>">
                                            <?= form_error('nama'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="nip">NIP</label>
                                            <input type="text" class="form-control" name="nip" id="nip" autocomplete="off" value="<?= $kelola_user['nip']; ?>">
                                            <?= form_error('nip'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="pangkat">Pangkat</label>
                                            <input type="text" class="form-control" name="pangkat" id="pangkat" autocomplete="off" value="<?= $kelola_user['pangkat']; ?>">
                                            <?= form_error('pangkat'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="px-4 mt-4">
                                        <div class="form-group">
                                            <label for="golongan">Golongan</label>
                                            <input type="text" class="form-control" name="golongan" id="golongan" autocomplete="off" value="<?= $kelola_user['golongan']; ?>">
                                            <?= form_error('golongan'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="jabatan">Jabatan</label>
                                            <select class="form-control" id="jabatan" name="jabatan">
                                                <option value="Dosen" <?= $kelola_user['jabatan'] == 'Dosen' ? 'selected' : ''; ?>>Dosen</option>
                                                <option value="Kaprodi" <?= $kelola_user['jabatan'] == 'Kaprodi' ? 'selected' : ''; ?>>Kaprodi</option>
                                                <option value="Kajur" <?= $kelola_user['jabatan'] == 'Kajur' ? 'selected' : ''; ?>>Kajur</option>
                                                <option value="Dekan" <?= $kelola_user['jabatan'] == 'Dekan' ? 'selected' : ''; ?>>Dekan</option>
                                                <option value="Wadek 1" <?= $kelola_user['jabatan'] == 'Wadek 1' ? 'selected' : ''; ?>>Wadek 1</option>
                                                <option value="Wadek 2" <?= $kelola_user['jabatan'] == 'Wadek 2' ? 'selected' : ''; ?>>Wadek 2</option>
                                                <option value="Wadek 3" <?= $kelola_user['jabatan'] == 'Wadek 3' ? 'selected' : ''; ?>>Wadek 3</option>
                                                <option value="Kabag TU" <?= $kelola_user['jabatan'] == 'Kabag TU' ? 'selected' : ''; ?>>Kabag TU</option>
                                                <option value="Staf" <?= $kelola_user['jabatan'] == 'Staf' ? 'selected' : ''; ?>>Staf</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <select class="form-control" name="role" id="role">
                                                <?php foreach ($role_user as $ru) : ?>
                                                    <?php if ($ru == $kelola_user['role']) : ?>
                                                        <option value="<?= $ru; ?>" selected><?= $ru; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $ru; ?>"><?= $ru; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
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