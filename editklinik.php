<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_klinik"])) {
  // Mengambil data dari form
  $klinikid = $_POST["klinikid"]; // Unique identifier for the clinic's record
  $nama_poliklinik = $_POST["nama_poliklinik"];
  $ruang = $_POST["ruang"];
  $lantai = $_POST["lantai"];

  $nama_poliklinik = mysqli_real_escape_string($koneksi, $nama_poliklinik);
  $ruang = mysqli_real_escape_string($koneksi, $ruang);
  $lantai = mysqli_real_escape_string($koneksi, $lantai);

  $ruang = preg_replace("/[^0-9]/", "", $ruang);

  // Menambahkan kode negara +62 jika tidak ada
  if (!preg_match("/^\+62/", $ruang)) {
    $ruang = "+62" . ltrim($ruang, "0"); // Menghilangkan nol awal jika ada
  }

  // Query UPDATE
  $sql = "UPDATE poliklinik SET nama_poliklinik = '$nama_poliklinik', ruang = '$ruang', lantai = '$lantai' WHERE klinikid = $klinikid";

  if ($koneksi->query($sql) === TRUE) {
    echo '<script>alert("Data Berhasil diubah."); document.location="dashboard.php?page=tampil_poliklinik";</script>';
  } else {
    echo "Error: " . $koneksi->error;
  }
}

// Retrieve the clinic's data to populate the form for editing
if (isset($_GET["klinikid"])) {
  $klinikid = $_GET["klinikid"];
  $sql = "SELECT * FROM poliklinik WHERE klinikid = $klinikid";
  $result = $koneksi->query($sql);

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $nama_poliklinik = $row["nama_poliklinik"];
    $ruang = $row["ruang"];
    $lantai = $row["lantai"];
  } else {
    echo "Data Poli Klinik Tidak Ditemukan.";
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
  <form method="POST" action="dashboard.php?page=edit_poliklinik" class="m-4">
    <input type="hidden" name="klinikid" value="<?php echo $klinikid; ?>">
    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="form-outline">
          <label class="form-label" for="Name">
            <h6>Nama</h6>
          </label>
          <input type="text" id="Name" class="form-control form-control-lg" name="nama_poliklinik" value="<?php echo $nama_poliklinik; ?>" />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="form-outline">
          <label class="form-label" for="ruang">
            <h6>Ruang</h6>
          </label>
          <input type="text" id="ruang" class="form-control form-control-lg" name="ruang" value="<?php echo $ruang; ?>" />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-4 pb-2">
        <div class="form-outline">
          <label class="form-label" for="lantai">Lantai</label>
          <input type="text" id="lantai" class="form-control form-control-lg" name="lantai" value="<?php echo $lantai; ?>" />
        </div>
      </div>
    </div>
    <div class="mt-4 pt-2 text-end">
      <a href="dashboard.php?page=tampil_poliklinik" class="btn btn-danger">Kembali</a>
      <input class="btn btn-primary" type="submit" name="edit_klinik" value="Simpan Perubahan">
    </div>
  </form>
</div>