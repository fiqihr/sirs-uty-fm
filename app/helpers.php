<?php

use Carbon\Carbon;

if (!function_exists('formatTanggal')) {
  function formatTanggal($tanggal)
  {
    Carbon::setLocale('id');
    return Carbon::parse($tanggal)->translatedFormat('j F Y');
  }
}

if (!function_exists('formatHari')) {
  function formatHari($hari)
  {
    Carbon::setLocale('id');
    return Carbon::parse($hari)->translatedFormat('l, j F Y');
  }
}

if (!function_exists('formatMenit')) {
  function formatMenit($menit)
  {
    if (!$menit || strlen($menit) < 3) {
      return '-';
    }
    return substr($menit, 0, -3); // Hapus 3 karakter terakhir
  }
}
