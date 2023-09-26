<?php
include 'connection.php';

//Delete User
if (isset($_GET['userid'])) {
  $userid = $_GET['userid'];

  // Query DELETE
  $sql = "DELETE FROM user WHERE userid = $userid";

  if ($koneksi->query($sql) === TRUE) {
    echo "Data berhasil dihapus.";
  } else {
    echo "Error: " . $koneksi->error;
  }
}

// Delete Pasien
if (isset($_GET['pasienid'])) {
  $pasienid = $_GET['pasienid'];

  // Query DELETE
  $sql = "DELETE FROM pasien WHERE pasienid = $pasienid";

  if ($koneksi->query($sql) === TRUE) {
    echo '<script>alert("Data Berhasil dihapus."); document.location="dashboard.php?page=tampil_pasien";</script>';
  } else {
    echo "Error: " . $koneksi->error;
  }
}

// Delete dokter
if (isset($_GET['dokterid'])) {
  $dokterid = $_GET['dokterid'];

  // Query DELETE
  $sql = "DELETE FROM dokter WHERE dokterid = $dokterid";

  if ($koneksi->query($sql) === TRUE) {
    echo '<script>alert("Data Berhasil dihapus."); document.location="dashboard.php?page=tampil_dokter";</script>';
  } else {
    echo "Error: " . $koneksi->error;
  }
}

// Delete obat
if (isset($_GET['obatid'])) {
  $obatid = $_GET['obatid'];

  // Query DELETE
  $sql = "DELETE FROM obat WHERE obatid = $obatid";

  if ($koneksi->query($sql) === TRUE) {
    echo '<script>alert("Data Berhasil dihapus."); document.location="dashboard.php?page=tampil_obat";</script>';
  } else {
    echo "Error: " . $koneksi->error;
  }
}

//Delete poliklinik
if (isset($_GET['klinikid'])) {
  $klinikid = $_GET['klinikid'];

  // Query DELETE
  $sql = "DELETE FROM poliklinik WHERE klinikid = $klinikid";

  if ($koneksi->query($sql) === TRUE) {
    echo '<script>alert("Data Berhasil dihapus."); document.location="dashboard.php?page=tampil_klinik";</script>';
  } else {
    echo "Error: " . $koneksi->error;
  }
}

// Delete rekmed
if (isset($_GET['rekmedid'])) {
  $rekmedid = $_GET['rekmedid'];

  // Query DELETE
  $sql = "DELETE FROM rekmed WHERE rekmedid = $rekmedid";

  if ($koneksi->query($sql) === TRUE) {
    echo '<script>alert("Data Berhasil dihapus."); document.location="dashboard.php?page=tampil_rekmed";</script>';
  } else {
    echo "Error: " . $koneksi->error;
  }
}
