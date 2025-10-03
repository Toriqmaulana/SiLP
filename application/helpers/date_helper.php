<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('format_tanggal')) {
    function format_tanggal_waktu($date)
    {
        date_default_timezone_set("Asia/Jakarta");

        $date = strtotime($date);
        return date("d", $date) . '/' . date("m", $date) . '/' . date("Y", $date) . ' ' . date("H", $date) . ':' . date("i", $date);

        // $Hari = [
        //     "Minggu",
        //     "Senin",
        //     "Selasa",
        //     "Rabu",
        //     "Kamis",
        //     "Jumat",
        //     "Sabtu"
        // ];

        // $Bulan = [
        //     'Januari',
        //     'Februari',
        //     'Maret',
        //     'April',
        //     'Mei',
        //     'Juni',
        //     'Juli',
        //     'Agustus',
        //     'September',
        //     'Oktober',
        //     'November',
        //     'Desember'
        // ];

        // $tahun = substr($date, 0, 4);
        // $bulan = substr($date, 5, 2);
        // $tanggal = substr($date, 8, 2);
        // $waktu = substr($date, 11, 5);
        // $hari = date("w", strtotime($date));
        // $result = $Hari[$hari] . ", " . $tanggal . " - " . $Bulan[(int)$bulan - 1] . " - " . $tahun . " " . $waktu;

        // return $result;
    }

    function format_tanggal($date)
    {
        date_default_timezone_set("Asia/Jakarta");

        $date = strtotime($date);
        return date("d", $date) . '/' . date("m", $date) . '/' . date("Y", $date);
    }

    function format_tanggal_bulan($date)
    {
        date_default_timezone_set("Asia/Jakarta");

        $bulan = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $date = strtotime($date);
        return date("d", $date) . ' ' . $bulan[(int)date("m", $date) - 1] . ' ' . date("Y", $date);
    }

    function format_tgl_wkt($date)
    {
        date_default_timezone_set("Asia/Jakarta");

        $date = strtotime($date);
        return date("d", $date) . '-' . date("m", $date) . '-' . date("Y", $date) . ' - ' . date("H", $date) . ':' . date("i", $date);
    }
}
