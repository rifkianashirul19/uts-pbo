<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_dokter"])) {
  // Mengambil data dari form
  $dokterid = $_POST["dokterid"]; // Unique identifier for the doctor's record
  $nama_dokter = $_POST["nama_dokter"];
  $spesialis = $_POST["spesialis"];
  $notelp = $_POST["notelp"];
  $alamat = $_POST["alamat"];

  $nama_dokter = mysqli_real_escape_string($koneksi, $nama_dokter);
  $spesialis = mysqli_real_escape_string($koneksi, $spesialis);
  $notelp = mysqli_real_escape_string($koneksi, $notelp);
  $alamat = mysqli_real_escape_string($koneksi, $alamat);

  $notelp = preg_replace("/[^0-9]/", "", $notelp);

  // Menambahkan kode negara +62 jika tidak ada
  if (!preg_match("/^\+62/", $notelp)) {
    $notelp = "+62" . ltrim($notelp, "0"); // Menghilangkan nol awal jika ada
  }

  // Query UPDATE
  $sql = "UPDATE dokter SET nama_dokter = '$nama_dokter', spesialis = '$spesialis', notelp = '$notelp', alamat = '$alamat' WHERE dokterid = $dokterid";

  if ($koneksi->query($sql) === TRUE) {
    echo '<script>alert("Data Berhasil diubah."); document.location="dashboard.php?page=tampil_dokter";</script>';
  } else {
    echo "Error: " . $koneksi->error;
  }
}

// Retrieve the doctor's data to populate the form for editing
if (isset($_GET["dokterid"])) {
  $dokterid = $_GET["dokterid"];
  $sql = "SELECT * FROM dokter WHERE dokterid = $dokterid";
  $result = $koneksi->query($sql);

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $nama_dokter = $row["nama_dokter"];
    $spesialis = $row["spesialis"];
    $notelp = $row["notelp"];
    $alamat = $row["alamat"];
  } else {
    echo "Data Dokter tidak ditemukan.";
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
  <form method="POST" action="dashboard.php?page=edit_dokter" class="m-4">
    <input type="hidden" name="dokterid" value="<?php echo $dokterid; ?>">
    <div class="row">
      <div class="col-md-6 mb-2">
        <div class="form-outline">
          <label class="form-label" for="Name">
            <h6>Nama</h6>
          </label>
          <input type="text" id="Name" class="form-control form-control-lg" name="nama_dokter" value="<?php echo $nama_dokter; ?>" />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-2">
        <div class="form-outline">
          <label class="form-label" for="Name">
            <h6>Spesialis</h6>
          </label>
          <input type="text" id="Name" class="form-control form-control-lg" name="spesialis" value="<?php echo $spesialis; ?>" />
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-2 pb-2">
        <div class="form-outline">
          <label class="form-label" for="phoneNumber">Nomor Telepon</label>
          <input type="tel" id="phoneNumber" class="form-control form-control-lg" name="notelp" value="<?php echo $notelp; ?>" />
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-2 pb-2">
        <div class="form-outline">
          <label class="form-label" for="alamat">Alamat</label>
          <input type="text" id="alamat" class="form-control form-control-lg" name="alamat" value="<?php echo $alamat; ?>" />
        </div>
      </div>
    </div>

    <div class="mt-2 pt-2 text-end">
      <a href="dashboard.php?page=tampil_dokter" class="btn btn-danger">Kembali</a>
      <input class="btn btn-primary" type="submit" name="edit_dokter" value="Simpan Perubahan">
    </div>

  </form>
</div>