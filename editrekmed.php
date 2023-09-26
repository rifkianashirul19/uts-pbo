<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_rekmed"])) {
  // Mengambil data dari form
  $rekmedid = $_POST["rekmedid"]; // Unique identifier for the medical record's record
  $Tanggal_Periksa = $_POST["Tanggal_Periksa"];
  $Keluhan = $_POST["Keluhan"];
  $Diagnosa = $_POST["Diagnosa"];

  $Tanggal_Periksa = mysqli_real_escape_string($koneksi, $Tanggal_Periksa);
  $Keluhan = mysqli_real_escape_string($koneksi, $Keluhan);
  $Diagnosa = mysqli_real_escape_string($koneksi, $Diagnosa);

  // Query UPDATE
  $sql = "UPDATE rekmed SET Tanggal_Periksa = '$Tanggal_Periksa', Keluhan = '$Keluhan', Diagnosa = '$Diagnosa' WHERE rekmedid = $rekmedid";

  if ($koneksi->query($sql) === TRUE) {
    echo '<script>alert("Data Berhasil diubah."); document.location="dashboard.php?page=tampil_rekmed";</script>';
  } else {
    echo "Error: " . $koneksi->error;
  }
}

// Retrieve the medical record's data to populate the form for editing
if (isset($_GET["id"])) {
  $rekmedid = $_GET["id"];
  $sql = "SELECT * FROM rekmed WHERE rekmedid = $rekmedid";
  $result = $koneksi->query($sql);

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $Tanggal_Periksa = $row["Tanggal_Periksa"];
    $Keluhan = $row["Keluhan"];
    $Diagnosa = $row["Diagnosa"];
  } else {
    echo "Medical record not found.";
    exit;
  }
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
  <div class="d-flex align-items-center">
    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
    <h2 class="fs-2 m-0">Edit Data</h2>
  </div>
</nav>
<div class="container-fluid">
  <form method="POST" action="dashboard.php?page=edit_rekmed" class="m-4">
    <input type="hidden" name="rekmedid" value="<?php echo $rekmedid; ?>">
    <div class="row">
      <div class="col-md-6 mb-4">
        <h6 class="mb-2 pb-1">Tanggal Periksa: </h6>
        <input type="datetime-local" name="Tanggal_Periksa" value="<?php echo date("Y-m-d\TH:i", strtotime($Tanggal_Periksa)); ?>" />
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-4 pb-2">
        <div class="form-outline">
          <label class="form-label" for="Keluhan">Keluhan</label>
          <input type="text" id="Keluhan" class="form-control form-control-lg" name="Keluhan" value="<?php echo $Keluhan; ?>" />
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-4 pb-2">
        <div class="form-outline">
          <label class="form-label" for="Diagnosa">Diagnosa</label>
          <input type="text" id="Diagnosa" class="form-control form-control-lg" name="Diagnosa" value="<?php echo $Diagnosa; ?>" />
        </div>
      </div>
    </div>

    <div class="mt-4 pt-2 text-end">
      <a href="dashboard.php?page=tampil_rekmed" class="btn btn-danger">Kembali</a>
      <input class="btn btn-primary" type="submit" name="edit_rekmed" value="Simpan Perubahan">
    </div>
  </form>
</div>