<?php

use Illuminate\Support\Str;
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

if (!function_exists('indoToEnglishDay')) {
  function indoToEnglishDay($keyword)
  {
    $map = [
      'senin' => 'monday',
      'selasa' => 'tuesday',
      'rabu' => 'wednesday',
      'kamis' => 'thursday',
      'jumat' => 'friday',
      'sabtu' => 'saturday',
      'minggu' => 'sunday',
    ];

    $keyword = strtolower($keyword);
    $results = [];

    foreach ($map as $indo => $english) {
      if (Str::contains($indo, $keyword)) {
        $results[] = $english;
      }
    }

    return $results;
  }
}

if (!function_exists('indoToEnglishMonth')) {
  function indoToEnglishMonth($keyword)
  {
    $map = [
      'januari' => 'january',
      'februari' => 'february',
      'maret' => 'march',
      'april' => 'april',
      'mei' => 'may',
      'juni' => 'june',
      'juli' => 'july',
      'agustus' => 'august',
      'september' => 'september',
      'oktober' => 'october',
      'november' => 'november',
      'desember' => 'december',
    ];

    $keyword = strtolower($keyword);
    $results = [];

    foreach ($map as $indo => $english) {
      if (Str::contains($indo, $keyword)) {
        $results[] = $english;
      }
    }

    return $results;
  }
}
