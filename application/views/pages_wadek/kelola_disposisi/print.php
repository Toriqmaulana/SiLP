<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lembar Disposisi</title>
    <style>
        @page {
            size: A4;
            margin: 10mm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
        }

        table {
            width: 100%;
        }

        td {
            border: 1px solid black;
            padding: 10px;
        }

        .kop-surat img {
            width: 100%;
            max-width: 100%;
        }

        .no-border {
            border: none;
        }

        .center-text {
            text-align: center;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <td class="no-border">
                <div class="container">
                    <table>
                        <tr class="kop-surat">
                            <td class="no-border center-text">
                                <img src="<?= base_url('assets/'); ?>img/kop_surat.jpg" alt="Kop Surat">
                            </td>
                        </tr>
                        <tr>
                            <td class="no-border center-text">
                                <h5>LEMBAR DISPOSISI</h5>
                            </td>
                        </tr>
                    </table>

                    <table>
                        <tr>
                            <td width="25%">Indeks</td>
                            <td>: <?= $kelola_disposisi['nomor_urut_disposisi']; ?></td>
                            <td>Kode</td>
                            <td>: </td>
                        </tr>
                        <tr>
                            <td>Berkas</td>
                            <?php
                            $berkasFile = $kelola_disposisi['berkas_file'];
                            $files = count(explode(',', $berkasFile));
                            ?>
                            <td colspan="3">: <?= $files ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal / Nomor</td>
                            <td colspan="3">: <?= format_tanggal_bulan($kelola_disposisi['tanggal_buat_sm']); ?> - <?= $kelola_disposisi['nomor_sm']; ?></td>
                        </tr>
                        <tr>
                            <td>Asal</td>
                            <td colspan="3">: Program Studi <?= $prodi; ?></td>
                        </tr>
                        <tr>
                            <td>Isi Ringkas</td>
                            <td colspan="3">: <?= $kelola_disposisi['isi_ringkas']; ?></td>
                        </tr>
                        <tr>
                            <td>Diterima Tanggal</td>
                            <td colspan="3">: <?= format_tanggal_bulan($kelola_disposisi['tanggal_terima_sm']); ?></td>
                        </tr>

                        <?php
                        $stt_dekan = $stt_wadek1 = $stt_wadek2 = $stt_wadek3 = $stt_kabagtu = $kp_dekan = $kp_wadek1 = $kp_wadek2 = $kp_wadek3 = $kp_kabagtu = null;
                        foreach ($status as $stt) : ?>
                            <?php if ($kelola_disposisi['id'] == $stt['id_pengajuan_surat']) : ?>
                                <?php
                                if ($stt['status'] == $status_wadek) :
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
                                endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <tr>
                            <td style="width: 70%;" colspan="3">Isi Disposisi:</td>
                            <td>Diteruskan Kepada:</td>
                        </tr>
                        <tr>
                            <td style="height: 100px;" colspan="3"><?= $kelola_disposisi['isi_disposisi_dekan']; ?></td>
                            <td>
                                <b><?= $kelola_disposisi['diteruskan_kepada_dekan']; ?></b>
                                <br>
                                <?= $kp_dekan == $status_wadek && !empty($kp_dekan) ? format_tgl_wkt($stt_dekan) : ''; ?>
                            </td>
                        </tr>

                        <?php
                        $wadek_data = [
                            [
                                'isi' => $kelola_disposisi['isi_disposisi_wadek1'],
                                'kepada' => $kelola_disposisi['diteruskan_kepada_wadek1'],
                                'kp' => $kp_wadek1,
                                'stt' => $stt_wadek1
                            ],
                            [
                                'isi' => $kelola_disposisi['isi_disposisi_wadek2'],
                                'kepada' => $kelola_disposisi['diteruskan_kepada_wadek2'],
                                'kp' => $kp_wadek2,
                                'stt' => $stt_wadek2
                            ],
                            [
                                'isi' => $kelola_disposisi['isi_disposisi_wadek3'],
                                'kepada' => $kelola_disposisi['diteruskan_kepada_wadek3'],
                                'kp' => $kp_wadek3,
                                'stt' => $stt_wadek3
                            ]
                        ];

                        foreach ($wadek_data as $data) {
                            if ($data['isi'] || $data['kepada']) {
                                echo "<tr>";
                                echo "<td style='height: 100px;' colspan='3'>";
                                if ($data['isi']) {
                                    echo htmlspecialchars($data['isi']);
                                }
                                echo "</td>";
                                echo "<td>";
                                if ($data['kepada']) {
                                    echo "<b>";
                                    echo htmlspecialchars($data['kepada']) . "<br>";
                                    echo "</b>";
                                }
                                if ($data['kp'] == 'Lembar Disposisi Diteruskan Ke Kabag TU') {
                                    echo format_tgl_wkt($data['stt']);
                                }
                                echo "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>

                        <tr>
                            <td style="height: 100px;" colspan="3"><?= $kelola_disposisi['isi_disposisi_kabagtu']; ?></td>
                            <td>
                                <b><?= $kelola_disposisi['diteruskan_kepada_kabagtu']; ?></b>
                                <br>
                                <?= $kp_kabagtu == 'Surat Masih Dicetak Staf' ? format_tgl_wkt($stt_kabagtu) : ''; ?>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="4" class="text-center">Sesudah digunakan harap segera dikembalikan:</td>
                        </tr>
                        <tr>
                            <!-- <td style="height: 50px;">Kepada:</td> -->
                            <td colspan="4">Kepada : ..............................................................</td>
                        </tr>
                        <tr>
                            <td colspan="4">Tanggal : .............................................................</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>