<?php
function format_tanggal($waktu)
{
    //tanggal 1-31, tanpa leading zero
    $tanggal = date('j', strtotime($waktu) );

    //bulan, januari dst
    $bulan_array = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    );
    $bl = date('n', strtotime($waktu) );
    $bulan = $bulan_array[$bl];

    //tahun
    $tahun = date('Y', strtotime($waktu) );

    //24 juli 2019
    return "$tanggal $bulan $tahun";
}