<?php
include('connection.php');
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Mengambil data dari form
  $nama_poliklinik = $_POST["nama_poliklinik"];
  $ruang = $_POST["ruang"];
  $lantai = $_POST["lantai"];

  $nama_poliklinik = mysqli_real_escape_string($koneksi, $nama_poliklinik);
  $ruang = mysqli_real_escape_string($koneksi, $ruang);
  $lantai = mysqli_real_escape_string($koneksi, $lantai);
  // Query INSERT
  $sql = "INSERT INTO poliklinik (nama_poliklinik, ruang, lantai) VALUES ('$nama_poliklinik', '$ruang' , '$lantai')";

  if ($koneksi->query($sql) === TRUE) {
    echo '<script>alert("Data Berhasil ditambahkan."); document.location="dashboard.php?page=tampil_poliklinik";</script>';
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
  <form method="POST" action="dashboard.php?page=tambah_poliklinik" class="m-4">
    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="form-outline">
          <label class="form-label" for="Name">
            <h6>Nama</h6>
          </label>
          <input type="text" id="Name" class="form-control form-control-lg" name="nama_poliklinik" />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="form-outline">
          <label class="form-label" for="ruang">
            <h6>Ruang</h6>
          </label>
          <input type="text" id="ruang" class="form-control form-control-lg" name="ruang" />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-4 pb-2">
        <div class="form-outline">
          <label class="form-label" for="lantai">Lantai</label>
          <input type="text" id="lantai" class="form-control form-control-lg" name="lantai" />
        </div>
      </div>
    </div>
    <div class="mt-4 pt-2 text-end">
      <a href="dashboard.php?page=tampil_poliklinik" class="btn btn-danger">Kembali</a>
      <input class="btn btn-primary" type="submit" value="Tambah">
    </div>
  </form>
</div>