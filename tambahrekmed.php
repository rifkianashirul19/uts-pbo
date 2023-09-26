<?php
include('connection.php');
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Mengambil data dari form
  $Tanggal_Periksa = $_POST["Tanggal_Periksa"];
  $Keluhan = $_POST["Keluhan"];
  $Diagnosa = $_POST["Diagnosa"];

  $Tanggal_Periksa = mysqli_real_escape_string($koneksi, $Tanggal_Periksa);
  $Keluhan = mysqli_real_escape_string($koneksi, $Keluhan);
  $Diagnosa = mysqli_real_escape_string($koneksi, $Diagnosa);

  // Query INSERT
  $sql = "INSERT INTO rekmed (Tanggal_Periksa, Keluhan, Diagnosa) VALUES ('$Tanggal_Periksa', '$Keluhan' , '$Diagnosa')";

  if ($koneksi->query($sql) === TRUE) {
    echo '<script>alert("Data Berhasil ditambahkan."); document.location="dashboard.php?page=tampil_rekmed";</script>';
  } else {
    echo "Error: " . $koneksi->error;
  }
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
  <div class="d-flex align-items-center">
    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
    <h2 class="fs-2 m-0">Tambah Data</h2>
  </div>
</nav>
<div class="container-fluid">
  <form method="POST" action="dashboard.php?page=tambah_rekmed" class="m-4">
    <div class="row">
      <div class="col-md-6 mb-4">
        <h6 class="mb-2 pb-1">Tanggal Periksa: </h6>
        <input type="datetime-local" name="Tanggal_Periksa" />
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-4 pb-2">
        <div class="form-outline">
          <label class="form-label" for="keluhan">Keluhan</label>
          <input type="tel" id="keluhan" class="form-control form-control-lg" name="Keluhan" />
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-4 pb-2">
        <div class="form-outline">
          <label class="form-label" for="Diagnosa">Diagnosa</label>
          <input type="text" id="Diagnosa" class="form-control form-control-lg" name="Diagnosa" />
        </div>
      </div>
    </div>

    <div class="mt-4 pt-2 text-end">
      <a href="dashboard.php?page=tampil_rekmed" class="btn btn-danger">Kembali</a>
      <input class="btn btn-primary" type="submit" value="Tambah">
    </div>

  </form>
</div>