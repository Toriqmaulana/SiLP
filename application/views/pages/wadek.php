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
            <a class="nav-link" href="<?= base_url('Wadek'); ?>">
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
            <a class="nav-link" href="<?= base_url('disposisiWadek'); ?>">
                <i class='fas fa-fw fa-inbox'></i>
                <span>Disposisi</span></a>
        </li>

        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('arsipDisposisiWadek'); ?>">
                <i class='fas fa-fw fa-folder-open'></i>
                <span>Arsip Disposisi</span></a>
        </li>

        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('profileWadek'); ?>">
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
                    <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>
                </div>

                <div class="row">

                    <!-- Card Statistik -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_disposisi; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-file-contract fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Terbaru</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_terbaru; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-inbox fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Diproses</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_diproses; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-spinner fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Selesai</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_selesai; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-check-double fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!-- Area Chart -->
                    <div class="col-xl-8 col-lg-7">
                        <div class="card shadow mb-4">
                            <!-- Card Header -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-success">Grafik Disposisi</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="myAreaChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pie Chart -->
                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">
                            <!-- Card Header -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-success">Status Disposisi</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-pie pt-4 pb-2">
                                    <canvas id="myPieChart"></canvas>
                                </div>
                                <div class="mt-4 text-center small">
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-success"></i> Terbaru
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-warning"></i> Diproses
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-info"></i> Selesai
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <!-- Pengajuan Terbaru -->
                    <div class="col-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-success">Disposisi Terbaru</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tgl. Disposisi</th>
                                                <th>Data Pengajuan</th>
                                                <th>Isi Ringkas</th>
                                                <th>Jenis Surat</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($disposisi_terbaru)) : ?>
                                                <?php $no = 1;
                                                foreach ($disposisi_terbaru as $d): ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= format_tanggal_waktu($d['tanggal_terima_sm']); ?></td>
                                                        <td>
                                                            Nama: <?= $d['pengajuan']['nama']; ?><br>
                                                            NIP: <?= $d['pengajuan']['nip']; ?><br>
                                                            Pangkat / Golongan: <?= $d['pengajuan']['pangkat']; ?> / <?= $d['pengajuan']['golongan']; ?><br>
                                                            Jabatan: <?= $d['pengajuan']['jabatan']; ?><br>
                                                            Prodi: <?= $d['pengajuan']['nama_prodi']; ?>
                                                        </td>
                                                        <td><?= $d['isi_ringkas']; ?></td>
                                                        <td>
                                                            <?php
                                                            $jenis_surat_list = [];
                                                            $jenis_surat_ids = explode(',', $d['jenis_surat']); // Mengambil ID jenis surat yang dipisahkan koma
                                                            foreach ($jenis_surat as $js) : ?>
                                                                <?php
                                                                if (in_array($js['id'], $jenis_surat_ids)) : // Memeriksa apakah ID jenis surat ada di array
                                                                    $jenis_surat_list[] = $js['nama_surat']; // Menambahkan nama surat ke dalam array
                                                                endif;
                                                                ?>
                                                            <?php endforeach; ?>
                                                            <?= implode('<br>', $jenis_surat_list); // Menampilkan nama surat yang dipisahkan koma 
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($d['status'] == $d['status_wadek']['nama_status']): ?>
                                                                <span class="badge badge-success"><?= $d['status'] ?></span>
                                                            <?php elseif ($d['status'] != $d['status_wadek']['nama_status'] && $d['status'] != 'Surat Selesai'): ?>
                                                                <span class="badge badge-warning"><?= $d['status'] ?></span>
                                                            <?php else: ?>
                                                                <span class="badge badge-info"><?= $d['status'] ?></span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <?php if ($d['status'] == $d['status_wadek']['nama_status'] && $d['isi_disposisi_' . strtolower(str_replace(' ', '', $user->jabatan))] == '') : ?>
                                                                    <a href="<?= base_url('detailSuratMasukWadek/' . $d['id']); ?>" class="btn btn-primary btn-sm" title="Tambah Isi Disposisi">
                                                                        <i class="fas fa-fw fa-plus-square"></i>
                                                                    </a>
                                                                <?php endif; ?>

                                                                <?php
                                                                if (
                                                                    ($d['status'] == $d['status_wadek']['nama_status'] && $d['isi_disposisi_' . strtolower(str_replace(' ', '', $user->jabatan))] != '') || ($d['status'] == 'Lembar Disposisi Diteruskan Ke Kabag TU')
                                                                ) :
                                                                ?>
                                                                    <a href="<?= base_url('lihatSuratMasukWadek/' . $d['id']); ?>" class="btn btn-warning btn-sm" title="Edit Isi Disposisi">
                                                                        <i class="fas fa-fw fa-pen"></i>
                                                                    </a>
                                                                <?php endif; ?>

                                                                <?php if ($d['buat_disposisi'] == '1' && $d['status'] != 'Lembar Disposisi Diteruskan Ke Dekan' && $d['isi_disposisi_' . strtolower(str_replace(' ', '', $user->jabatan))] != '') : ?>
                                                                    <a href="<?= base_url('detailDisposisiWadek/' . $d['id']); ?>" class="btn btn-success btn-sm ml-2" title="Detail Disposisi">
                                                                        <i class="fas fa-fw fa-inbox"></i>
                                                                    </a>
                                                                <?php endif; ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Script untuk Grafik -->
        <script src="<?= base_url('assets/'); ?>vendor/chart.js/Chart.min.js"></script>
        <script>
            // Area Chart
            var ctx = document.getElementById("myAreaChart");
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?= json_encode($labels_grafik); ?>,
                    datasets: [{
                        label: "Jumlah Disposisi",
                        lineTension: 0.3,
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointBorderColor: "rgba(78, 115, 223, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: <?= json_encode($data_grafik); ?>,
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0
                        }
                    },
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                maxTicksLimit: 5,
                                padding: 10,
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }],
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                        caretPadding: 10,
                    }
                }
            });

            // Pie Chart
            var ctx = document.getElementById("myPieChart");
            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ["Selesai", "Diproses", "Terbaru"],
                    datasets: [{
                        data: [<?= $jumlah_selesai; ?>, <?= $jumlah_diproses; ?>, <?= $jumlah_terbaru; ?>],
                        backgroundColor: ['#33b5e5', '#ffc107', '#2ecc71'],
                        hoverBackgroundColor: ['#33b5e5', '#ffc107', '#2ecc71'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 80,
                },
            });
        </script>