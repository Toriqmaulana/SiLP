<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Masuk</title>
    <style>
        @page {
            size: A4;
            margin: 20mm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
        }

        table {
            width: 100%;
        }

        header,
        footer {
            position: absolute;
            left: 0;
            right: 0;
            padding-right: 1.5cm;
            padding-left: 1.5cm;
        }

        header {
            top: 0;
            padding-top: 5mm;
            padding-bottom: 3mm;
        }

        footer {
            bottom: 0;
            padding-top: 3mm;
            padding-bottom: 5mm;
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

        @media print {
            body {
                margin: 0;
                box-shadow: 0;
            }

            header,
            footer {
                position: fixed;
                left: 0;
                right: 0;
                padding-right: 1.5cm;
                padding-left: 1.5cm;
            }
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <td>
                <div class="container">
                    <header>
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
                    </header>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
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

                    <footer>
                        <table class="text-center">
                            <tr class="gambar">
                                <td>
                                    <img src="<?= base_url('assets/'); ?>img/footer_sm.png" alt="Footer Surat">
                                </td>
                            </tr>
                        </table>
                    </footer>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>