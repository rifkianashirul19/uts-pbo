<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_obat"])) {
  // Mengambil data dari form
  $obatid = $_POST["obatid"]; // Unique identifier for the medication's record
  $nama_obat = $_POST["nama_obat"];
  $harga = $_POST["harga"];
  $keterangan = $_POST["keterangan"];

  $nama_obat = mysqli_real_escape_string($koneksi, $nama_obat);
  $harga = mysqli_real_escape_string($koneksi, $harga);
  $keterangan = mysqli_real_escape_string($koneksi, $keterangan);

  // Query UPDATE
  $sql = "UPDATE obat SET nama_obat = '$nama_obat', harga = '$harga', keterangan = '$keterangan' WHERE obatid = $obatid";

  if ($koneksi->query($sql) === TRUE) {
    echo '<script>alert("Data Berhasil diubah."); document.location="dashboard.php?page=tampil_obat";</script>';
  } else {
    echo "Error: " . $koneksi->error;
  }
}

// Retrieve the medication's data to populate the form for editing
if (isset($_GET["obatid"])) {
  $obatid = $_GET["obatid"];
  $sql = "SELECT * FROM obat WHERE obatid = $obatid";
  $result = $koneksi->query($sql);

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $nama_obat = $row["nama_obat"];
    $harga = $row["harga"];
    $keterangan = $row["keterangan"];
  } else {
    echo "Data Obat Tidak Ditemukan.";
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
  <form method="POST" action="dashboard.php?page=edit_obat" class="m-4">
    <input type="hidden" name="obatid" value="<?php echo $obatid; ?>">
    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="form-outline">
          <label class="form-label" for="Name">
            <h6>Nama Obat</h6>
          </label>
          <input type="text" id="Name" class="form-control form-control-lg" name="nama_obat" value="<?php echo $nama_obat; ?>" />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-4 pb-2">
        <div class="form-outline">
          <label class="form-label" for="harga">Harga</label>
          <div class="input-group mb-3">
            <span class="input-group-text">Rp</span>
            <input type="text" id="harga" class="form-control" aria-label="Rupiah dengan dua koma di belakang" name="harga" value="<?php echo $harga; ?>" />
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-4 pb-2">
        <div class="form-outline">
          <label class="form-label" for="keterangan">Keterangan</label>
          <input type="text" id="keterangan" class="form-control form-control-lg" name="keterangan" value="<?php echo $keterangan; ?>" />
        </div>
      </div>
    </div>
    <div class="mt-4 pt-2 text-end">
      <a href="dashboard.php?page=tampil_obat" class="btn btn-danger">Kembali</a>
      <input class="btn btn-primary" type="submit" name="edit_obat" value="Simpan Perubahan">
    </div>
  </form>
</div>