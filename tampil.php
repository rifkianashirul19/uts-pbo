<?php
// Query untuk mengambil jumlah data dari tabel tertentu
$sql = "SELECT COUNT(*) AS pasienid FROM pasien";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $jumlah_pasien = $row["pasienid"];
} else {
  $jumlah_pasien = 0;
}

$sql = "SELECT COUNT(*) AS dokterid FROM dokter";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $jumlah_dokter = $row["dokterid"];
} else {
  $jumlah_dokter = 0;
}


$sql = "SELECT COUNT(*) AS obatid FROM obat";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $jumlah_obat = $row["obatid"];
} else {
  $jumlah_obat = 0;
}

$sql = "SELECT COUNT(*) AS klinikid FROM poliklinik";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $jumlah_klinik = $row["klinikid"];
} else {
  $jumlah_klinik = 0;
}

$sql = "SELECT COUNT(*) AS rekmedid FROM rekmed";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $jumlah_rekmed = $row["rekmedid"];
} else {
  $jumlah_rekmed = 0;
}
