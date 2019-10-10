<?php
function salam($jam)
{
    if ($jam >= '05:00:00' && $jam <= '11:59:00') {
        $data = 'Selamat Pagi';
    } elseif ($jam >= '12:00:00' && $jam <= '15:59:00') {
        $data = 'Selamat Siang';
    } elseif ($jam >= '16:00:00' && $jam <= '18:59:00') {
        $data = 'Selamat Sore';
    } elseif ($jam >= '19:00:00') {
        $data = 'Selamat Malam';
    } elseif ($jam >= '00:00:00') {
        $data = 'Selamat Malam';
    }
    return $data;
}
