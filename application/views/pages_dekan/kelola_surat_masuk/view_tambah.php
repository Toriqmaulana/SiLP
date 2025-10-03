<div class="card-header">
    <a href="<?= base_url('disposisiDekan'); ?>" class="btn btn-secondary btn-sm">
        <i class="fas fa-fw fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card-body">
    <div class="row">
        <div class="col-lg">
            <div class="p-0">
                <!DOCTYPE html>
                <html lang="en">

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Surat Masuk</title>
                    <style>
                        body {
                            font-family: 'Times New Roman', Times, serif;
                        }

                        table {
                            width: 100%;
                        }

                        .a4-page {
                            width: 210mm;
                            margin: 20px auto;
                            padding: 20mm;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                            box-sizing: border-box;
                            background-color: #ffffff;
                            border: 1px solid #ddd;
                        }

                        .header {
                            text-align: center;
                            margin-bottom: 20px;
                        }

                        .content {
                            margin: 20px;
                        }

                        .footer {
                            margin-top: 40px;
                            display: flex;
                            justify-content: space-between;
                        }

                        .gambar img {
                            width: 100%;
                            max-width: 100%;
                        }
                    </style>
                </head>

                <body>
                    <table>
                        <tr>
                            <td>
                                <div class="container a4-page">
                                    <div class="header">
                                        <table>
                                            <tr class="gambar">
                                                <td>
                                                    <img src="<?= base_url('assets/'); ?>img/header_sm.png" alt="Kop Surat">
                                                </td>
                                                <td>
                                                    <?= strtoupper('Kementerian Agama Republik Indonesia') ?><br>
                                                    <?= strtoupper('Universitas Islam Negeri Sunan Ampel Surabaya') ?><br>
                                                    <?= strtoupper('Fakultas Sains dan Teknologi') ?><br>
                                                    <?= strtoupper('Program Studi ' . strtoupper($prodi)) ?><br>
                                                    Jl. Dr. Ir. H. Soekarno Nomor 682 Surabaya 60294
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="content">
                                        <hr style="height: 3px; background-color: black;">
                                        <table>
                                            <tr>
                                                <td colspan="2" align="right">
                                                    Surabaya, <?= format_tanggal_bulan($kelola_sm['tanggal_buat_sm']) ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="15%">Nomor</td>
                                                <td>: <?= $kelola_sm['nomor_sm'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Perihal</td>
                                                <td>: <?= $kelola_sm['perihal'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Lampiran</td>
                                                <?php
                                                $berkasFile = $kelola_sm['berkas_file'];
                                                $files = explode(',', $berkasFile);
                                                $fileCount = count($files);
                                                ?>
                                                <td>: <?= $fileCount ?></td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>
                                                    <br>
                                                    Kepada Yth.<br>
                                                    Dekan Fakultas Sains dan Teknologi<br>
                                                    UIN Sunan Ampel Surabaya<br>
                                                    Di Surabaya
                                                </td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>
                                                    <br>
                                                    Assalamu'alaikum Wr. Wb.
                                                </td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>
                                                    <br>
                                                    <?= $kelola_sm['isi_sm'] ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>
                                                    <br>
                                                    Wassalamu'alaikum Wr. Wb.
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="footer">
                                        <div class="col-6 text-center">
                                            <p>Mengetahui,<br>
                                                Ketua Jurusan <?= $jurusan ?><br>
                                                <?php if ($kelola_sm['status'] != 'Surat Pengantar Selesai Dibuat Kaprodi' && $kelola_sm['status'] != 'Ditolak Kajur') : ?>
                                                    <img src="<?= base_url('uploads/ttd/' . $ttd_kajur); ?>" alt="Ttd Kajur" height="100"><br>
                                                <?php endif; ?>
                                                <?= $nama_kajur ?><br>
                                                NIP. <?= $nip_kajur ?>
                                            </p>
                                        </div>
                                        <div class="col-6 text-center">
                                            <p>Ketua Program Studi<br>
                                                <?= $prodi ?><br>
                                                <img src="<?= base_url('uploads/ttd/' . $ttd_kaprodi); ?>" alt="Ttd Kaprodi" height="100"><br>
                                                <?= $nama_kaprodi ?><br>
                                                NIP. <?= $nip_kaprodi ?>
                                            </p>
                                        </div>
                                    </div>

                                    <table class="text-center">
                                        <tr class="gambar">
                                            <td>
                                                <img src="<?= base_url('assets/'); ?>img/footer_sm.png" alt="Footer Surat">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </table>
                </body>

                </html>

                <div class="form-group">
                    <label for="berkas_file">Lampiran (PDF)</label>
                    <?php if ($kelola_sm['berkas_file']): ?>
                        <div class="existing-files">
                            <?php foreach (explode(',', $kelola_sm['berkas_file']) as $file): ?>
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
            </div>
        </div>
    </div>
</div>

<div class="card-footer">
    <a href="<?= base_url('tambahDisposisiDekan/' . $kelola_sm['id']); ?>" class="btn btn-secondary btn-sm">
        <i class="fas fa-fw fa-arrow-right"></i> Next
    </a>
</div>