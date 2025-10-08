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
                        <h3 class="card-title mt-2">Edit Data Pengajuan</h3>
                    </div>
                    <!-- /.card-header -->

                    <!-- form start -->
                    <form class="user" action="<?= base_url('editAksiPengajuan/' . $kelola_pengajuan['id']); ?>" method="post" enctype="multipart/form-data">
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
                            <div class="row">
                                <div class="col-lg">
                                    <div class="px-4">
                                        <div class="form-group">
                                            <label for="berkas_file">Berkas File Lampiran (PDF)</label>
                                            <input type="file" class="form-control" name="berkas_file[]" id="berkas_file" multiple accept=".pdf">
                                            <small class="text-muted">Max ukuran file: 5 MB.</small>
                                            <div id="file-error" class="text-danger" style="display: none;"></div>
                                            <?= form_error('berkas_file[]'); ?>

                                            <?php if ($kelola_pengajuan['berkas_file']): ?>
                                                <div class="existing-files">
                                                    <label for="berkas_file">Berkas Terupload:</label>
                                                    <input type="hidden" name="existing_files" value="<?= $kelola_pengajuan['berkas_file'] ?>">
                                                    <?php foreach (explode(',', $kelola_pengajuan['berkas_file']) as $file): ?>
                                                        <div class="file-item">
                                                            <div class="file-name">
                                                                <i class="fas fa-fw fa-file-pdf"></i> <?= $file ?>
                                                            </div>
                                                            <div class="file-actions">
                                                                <a href="<?= base_url('uploads/berkas/' . $file) ?>" target="_blank" class="btn btn-sm btn-info" title="Lihat File">
                                                                    <i class="fas fa-fw fa-eye"></i>
                                                                </a>
                                                                <button type="button" class="btn btn-sm btn-danger" title="Hapus File" onclick="removeExistingFile('<?= $file ?>', this)">
                                                                    <i class="fas fa-fw fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>

                                            <div id="file-preview" class="file-preview"></div>
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
                                                                    <?= in_array($js['id'], explode(',', $kelola_pengajuan['jenis_surat'])) ? 'checked' : ''; ?>>
                                                                <label class="form-check-label" for="js<?= $js['id']; ?>">
                                                                    <?= $js['nama_surat']; ?>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                            <?= form_error('jenis_surat[]'); ?>
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

        <script>
            // Fungsi untuk preview file baru
            document.getElementById('berkas_file').addEventListener('change', function(e) {
                const filePreview = document.getElementById('file-preview');
                const fileError = document.getElementById('file-error');
                filePreview.innerHTML = '';
                fileError.style.display = 'none';

                Array.from(e.target.files).forEach(file => {
                    // Cek ukuran file (5 MB = 5 * 1024 * 1024 bytes)
                    if (file.size > 5 * 1024 * 1024) {
                        fileError.textContent = `File "${file.name}" melebihi batas ukuran maksimal 5 MB!`;
                        fileError.style.display = 'block';
                        this.value = ''; // Reset input file
                        return;
                    }

                    const fileItem = document.createElement('div');
                    fileItem.className = 'file-item';

                    const fileName = document.createElement('div');
                    fileName.className = 'file-name';
                    fileName.innerHTML = `<i class="fas fa-fw fa-file-pdf"></i> ${file.name}`;

                    const fileActions = document.createElement('div');
                    fileActions.className = 'file-actions';

                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'btn btn-sm btn-danger';
                    removeBtn.innerHTML = '<i class="fas fa-fw fa-times"></i>';
                    removeBtn.onclick = function() {
                        fileItem.remove();
                        // Hapus file dari input
                        const dt = new DataTransfer();
                        const input = document.getElementById('berkas_file');
                        const {
                            files
                        } = input;

                        for (let i = 0; i < files.length; i++) {
                            if (files[i] !== file) {
                                dt.items.add(files[i]);
                            }
                        }

                        input.files = dt.files;
                    };

                    fileActions.appendChild(removeBtn);
                    fileItem.appendChild(fileName);
                    fileItem.appendChild(fileActions);
                    filePreview.appendChild(fileItem);
                });
            });

            // Fungsi untuk menghapus file yang sudah ada
            function removeExistingFile(filename, button) {
                if (confirm('Apakah Anda yakin ingin menghapus file ini?')) {
                    fetch('<?= base_url('removeFile/') ?>' + filename, {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                surat_id: '<?= $kelola_pengajuan['id'] ?>'
                            })
                        })
                        .then(response => response.text())
                        .then(text => {
                            try {
                                const data = JSON.parse(text);
                                if (data.success) {
                                    button.closest('.file-item').remove();

                                    // Update hidden input untuk existing files
                                    const existingFilesInput = document.querySelector('input[name="existing_files"]');
                                    if (existingFilesInput) {
                                        const currentFiles = existingFilesInput.value.split(',');
                                        const updatedFiles = currentFiles.filter(file => file.trim() !== filename);
                                        existingFilesInput.value = updatedFiles.join(',');

                                        // Jika tidak ada file tersisa, hapus hidden input
                                        if (updatedFiles.length === 0 || (updatedFiles.length === 1 && updatedFiles[0] === '')) {
                                            existingFilesInput.remove();
                                        }
                                    }

                                    alert('File berhasil dihapus');
                                } else {
                                    alert(data.message || 'Gagal menghapus file');
                                }
                            } catch (e) {
                                console.error('Response text:', text);
                                alert('Terjadi kesalahan pada server');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat menghapus file. Silakan coba lagi.');
                        });
                }
            }
        </script>