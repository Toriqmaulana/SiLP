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

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-2">
                    <h1 class="h3 mb-2 text-gray-800">Daftar Arsip Surat Masuk</h1>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex">
                                <form class="form-inline" method="get" action="<?= base_url('arsipSuratKaprodi'); ?>">
                                    <div class="form-group mr-2">
                                        <label for="jenis_surat" class="mr-2">Jenis Surat:</label>
                                        <select class="form-control form-control-sm" id="jenis_surat" name="jenis_surat">
                                            <option value="">Semua Jenis Surat</option>
                                            <?php foreach ($jenis_surat as $js) : ?>
                                                <?php if (in_array('Dosen', explode(',', $js['role_access']))) : ?>
                                                    <option value="<?= $js['id']; ?>"
                                                        <?= isset($_GET['jenis_surat']) && $_GET['jenis_surat'] == $js['id'] ? 'selected' : ''; ?>>
                                                        <?= $js['nama_surat']; ?>
                                                    </option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group mr-2">
                                        <label for="start_date" class="mr-2">Dari:</label>
                                        <input type="date" class="form-control form-control-sm" id="start_date" name="start_date" value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>">
                                    </div>
                                    <div class="form-group mr-2">
                                        <label for="end_date" class="mr-2">Sampai:</label>
                                        <input type="date" class="form-control form-control-sm" id="end_date" name="end_date" value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm mr-2">
                                        <i class="fas fa-fw fa-filter"></i> Filter
                                    </button>
                                    <a href="<?= base_url('arsipSuratKaprodi'); ?>" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-fw fa-sync"></i> Reset
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tgl. Pengajuan</th>
                                        <th>Data Pengajuan</th>
                                        <th>Perihal</th>
                                        <th>Jenis Surat</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $no = 1;
                                    foreach ($kelola_pengajuan as $kp) : ?>
                                        <?php if ($user->id_prodi == $kp['id_prodi'] && $user->id_jurusan == $kp['id_jurusan'] && $kp['status'] == 'Surat Selesai') : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= format_tanggal_waktu($kp['tanggal_pengajuan']); ?></td>
                                                <td>
                                                    Nama: <?= $kp['pengajuan']['nama']; ?><br>
                                                    NIP: <?= $kp['pengajuan']['nip']; ?><br>
                                                    Pangkat / Golongan: <?= $kp['pengajuan']['pangkat']; ?> / <?= $kp['pengajuan']['golongan']; ?>
                                                </td>
                                                <td><?= $kp['perihal']; ?></td>
                                                <td><?= $kp['pengajuan']['nama_surat']; ?></td>
                                                <td>
                                                    <?php
                                                    $stt_ajukan = $stt_kaprodi = $stt_sm = $stt_kajur = $stt_staf = $stt_dekan = $stt_wadek1 = $stt_wadek2 = $stt_wadek3 = $stt_kabagtu = $stt_ttd = $stt_selesai = $kp_ajukan = $kp_kaprodi = $kp_sm = $kp_kajur = $kp_staf = $kp_dekan = $kp_wadek1 = $kp_wadek2 = $kp_wadek3 = $kp_kabagtu = $kp_ttd = $kp_selesai = null;
                                                    foreach ($status as $stt) : ?>
                                                        <?php if ($kp['id'] == $stt['id_pengajuan_surat']) : ?>
                                                            <?php
                                                            if ($stt['status'] == 'Diajukan Ke Prodi') : ?>
                                                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#progressModal<?= $kp['id']; ?>" title="Detail Status">
                                                                    <i class="fas fa-fw fa-info"></i>
                                                                </button>
                                                                <?php
                                                                $kp_ajukan = $stt['status'];
                                                                $stt_ajukan = $stt['update_status'];
                                                                ?>
                                                            <?php
                                                            elseif ($stt['status'] == 'Disetujui Kaprodi') :
                                                                $kp_kaprodi = $stt['status'];
                                                                $stt_kaprodi = $stt['update_status'];

                                                            elseif ($stt['status'] == 'Surat Pengantar Selesai Dibuat Kaprodi') :
                                                                $kp_sm = $stt['status'];
                                                                $stt_sm = $stt['update_status'];

                                                            elseif ($stt['status'] == 'Disetujui Kajur') :
                                                                $kp_kajur = $stt['status'];
                                                                $stt_kajur = $stt['update_status'];

                                                            elseif ($stt['status'] == 'Lembar Disposisi Diteruskan Ke Dekan') :
                                                                $kp_staf = $stt['status'];
                                                                $stt_staf = $stt['update_status'];

                                                            elseif ($stt['status'] == $kp['status_wadek']['nama_status']) :
                                                                $kp_dekan = $stt['status'];
                                                                $stt_dekan = $stt['update_status'];

                                                            elseif ($stt['status'] == 'Lembar Disposisi Diteruskan Ke Kabag TU' && $stt['id_user'] == '5') :
                                                                $kp_wadek1 = $stt['status'];
                                                                $stt_wadek1 = $stt['update_status'];

                                                            elseif ($stt['status'] == 'Lembar Disposisi Diteruskan Ke Kabag TU' && $stt['id_user'] == '9') :
                                                                $kp_wadek2 = $stt['status'];
                                                                $stt_wadek2 = $stt['update_status'];

                                                            elseif ($stt['status'] == 'Lembar Disposisi Diteruskan Ke Kabag TU' && $stt['id_user'] == '19') :
                                                                $kp_wadek3 = $stt['status'];
                                                                $stt_wadek3 = $stt['update_status'];

                                                            elseif ($stt['status'] == 'Surat Masih Dicetak Staf') :
                                                                $kp_kabagtu = $stt['status'];
                                                                $stt_kabagtu = $stt['update_status'];

                                                            elseif ($stt['status'] == 'Surat Masih Ditandatangani Dekan') :
                                                                $kp_ttd = $stt['status'];
                                                                $stt_ttd = $stt['update_status'];

                                                            elseif ($stt['status'] == 'Surat Selesai') :
                                                                $kp_selesai = $stt['status'];
                                                                $stt_selesai = $stt['update_status'];
                                                            endif; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                    <?= $kp['status']; ?>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" onclick="printSuratPengantarKaprodi('<?= base_url('printSuratPengantarKaprodi/' . $kp['id']); ?>')" class="btn btn-dark btn-sm" title="Cetak Surat Pengantar">
                                                        <i class="fas fa-fw fa-print"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                            <!-- Modal Progress -->
                                            <div class="modal fade" id="progressModal<?= $kp['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="progressModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="progressModalLabel">Progress Status Surat</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="timeline">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <h6 style="padding-left: 10px; font-weight: bold;">Prodi</h6>
                                                                        <li class="timeline-item completed">
                                                                            <i class="fas fa-file-alt"></i>
                                                                            <small style="display: inline; font-size: 15px;"><?= $kp_ajukan; ?></small>
                                                                            <small style="padding-left: 40px;"><?= $kp_ajukan == 'Diajukan Ke Prodi' ? format_tanggal_waktu($stt_ajukan) : ''; ?></small>
                                                                        </li>
                                                                        <li class="timeline-item completed">
                                                                            <i class="fas fa-user-check"></i>
                                                                            <small style="display: inline; font-size: 15px;"><?= $kp_kaprodi; ?></small>
                                                                            <small style="padding-left: 40px;"><?= $kp_kaprodi == 'Disetujui Kaprodi' ? format_tanggal_waktu($stt_kaprodi) : ''; ?></small>
                                                                        </li>
                                                                        <li class="timeline-item completed">
                                                                            <i class="fas fa-envelope-open-text"></i>
                                                                            <small style="display: inline; font-size: 15px;"><?= $kp_sm; ?></small>
                                                                            <small style="padding-left: 40px;"><?= $kp_sm == 'Surat Pengantar Selesai Dibuat Kaprodi' ? format_tanggal_waktu($stt_sm) : ''; ?></small>
                                                                        </li>
                                                                        <li class="timeline-item completed">
                                                                            <i class="fas fa-user-check"></i>
                                                                            <small style="display: inline; font-size: 15px;"><?= $kp_kajur; ?></small>
                                                                            <small style="padding-left: 40px;"><?= $kp_kajur == 'Disetujui Kajur' ? format_tanggal_waktu($stt_kajur) : ''; ?></small>
                                                                        </li>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <h6 style="padding-left: 10px; font-weight: bold;">Fakultas</h6>
                                                                        <li class="timeline-item completed">
                                                                            <i class="fas fa-inbox"></i>
                                                                            <small style="display: inline; font-size: 15px;"><?= $kp_staf; ?></small>
                                                                            <small style="padding-left: 40px;"><?= $kp_staf == 'Lembar Disposisi Diteruskan Ke Dekan' ? format_tanggal_waktu($stt_staf) : ''; ?></small>
                                                                        </li>
                                                                        <li class="timeline-item completed">
                                                                            <i class="fas fa-inbox"></i>
                                                                            <small style="display: inline; font-size: 15px;"><?= $kp['status_wadek']['nama_status']; ?></small>
                                                                            <small style="padding-left: 40px;"><?= ($kp_dekan == $kp['status_wadek']['nama_status'] && !empty($kp_dekan)) ? format_tanggal_waktu($stt_dekan) : ''; ?></small>
                                                                        </li>
                                                                        <li class="timeline-item completed">
                                                                            <i class="fas fa-inbox"></i>
                                                                            <small style="display: inline; font-size: 15px;"><?= $kp_wadek1 == 'Lembar Disposisi Diteruskan Ke Kabag TU' || $kp_wadek2 == 'Lembar Disposisi Diteruskan Ke Kabag TU' || $kp_wadek3 == 'Lembar Disposisi Diteruskan Ke Kabag TU' ? 'Lembar Disposisi Diteruskan Ke Kabag TU' : ''; ?></small>
                                                                            <small style="padding-left: 40px;"><b><?= $kp['diteruskan_kepada_wadek1'] ? $kp['diteruskan_kepada_wadek1'] : ''; ?></b></small>
                                                                            <small style="padding-left: 40px;"><?= $kp_wadek1 == 'Lembar Disposisi Diteruskan Ke Kabag TU' ? format_tanggal_waktu($stt_wadek1) : ''; ?></small>
                                                                            <small style="padding-left: 40px;"><b><?= $kp['diteruskan_kepada_wadek2'] ? $kp['diteruskan_kepada_wadek2'] : ''; ?></b></small>
                                                                            <small style="padding-left: 40px;"><?= $kp_wadek2 == 'Lembar Disposisi Diteruskan Ke Kabag TU' ? format_tanggal_waktu($stt_wadek2) : ''; ?></small>
                                                                            <small style="padding-left: 40px;"><b><?= $kp['diteruskan_kepada_wadek3'] ? $kp['diteruskan_kepada_wadek3'] : ''; ?></b></small>
                                                                            <small style="padding-left: 40px;"><?= $kp_wadek3 == 'Lembar Disposisi Diteruskan Ke Kabag TU' ? format_tanggal_waktu($stt_wadek3) : ''; ?></small>
                                                                        </li>
                                                                        <li class="timeline-item completed">
                                                                            <i class="fas fa-print"></i>
                                                                            <small style="display: inline; font-size: 15px;"><?= $kp_kabagtu; ?></small>
                                                                            <small style="padding-left: 40px;"><?= $kp_kabagtu == 'Surat Masih Dicetak Staf' ? format_tanggal_waktu($stt_kabagtu) : ''; ?></small>
                                                                        </li>
                                                                        <li class="timeline-item completed">
                                                                            <i class="fas fa-file-signature"></i>
                                                                            <small style="display: inline; font-size: 15px;"><?= $kp_ttd; ?></small>
                                                                            <small style="padding-left: 40px;"><?= $kp_ttd == 'Surat Masih Ditandatangani Dekan' ? format_tanggal_waktu($stt_ttd) : ''; ?></small>
                                                                        </li>
                                                                        <li class="timeline-item completed">
                                                                            <i class="fas fa-file-download"></i>
                                                                            <small style="display: inline; font-size: 15px;"><?= $kp_selesai; ?></small>
                                                                            <small style="padding-left: 40px;"><?= $kp_selesai == 'Surat Selesai' ? format_tanggal_waktu($stt_selesai) : ''; ?></small>
                                                                        </li>
                                                                    </div>
                                                                </div>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
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

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Ambil semua elemen <li> dengan class "timeline-item"
                const timelineItems = document.querySelectorAll('.timeline-item');

                // Loop untuk memeriksa setiap <li>
                timelineItems.forEach(function(li) {
                    // Ambil elemen <small> di dalam <li>
                    const smallElement = li.querySelector('small');

                    // Jika <small> kosong (tidak ada data), sembunyikan kelas 'completed'
                    if (smallElement.textContent.trim() === '') {
                        li.classList.remove('completed');
                    }
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Ambil semua modal
                const modals = document.querySelectorAll('.modal');

                modals.forEach(modal => {
                    // Ambil semua <small> yang berisi status
                    const allStatus = modal.querySelectorAll('small[style*="font-size: 15px"]');

                    // Temukan index terakhir yang memiliki teks bukan kosong
                    let lastIndex = -1;
                    allStatus.forEach((el, index) => {
                        if (el.textContent.trim() !== '') {
                            lastIndex = index;
                        }
                    });

                    // Jika ditemukan, beri bold hanya pada elemen terakhir
                    if (lastIndex !== -1) {
                        allStatus[lastIndex].style.fontWeight = 'bold';
                    }
                });
            });
        </script>

        <script>
            function printSuratPengantarKaprodi(url) {
                const printWindow = window.open(url, '_blank', 'width=800,height=600');
                printWindow.onload = function() {
                    printWindow.print();
                    // Optional: Close the window after printing
                    printWindow.onafterprint = function() {
                        printWindow.close();
                    };
                };
            }
        </script>