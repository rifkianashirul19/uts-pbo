<?php
include('connection.php');
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Mengambil data dari form
  $nama_obat = $_POST["nama_obat"];
  $harga = $_POST["harga"];
  $keterangan = $_POST["keterangan"];

  $nama_obat = mysqli_real_escape_string($koneksi, $nama_obat);
  $harga = mysqli_real_escape_string($koneksi, $harga);
  $keterangan = mysqli_real_escape_string($koneksi, $keterangan);
  // Query INSERT
  $sql = "INSERT INTO obat (nama_obat, kelamin, harga, keterangan) VALUES ('$nama_obat', '$kelamin', '$harga' , '$keterangan')";

  if ($koneksi->query($sql) === TRUE) {
    echo '<script>alert("Data Berhasil ditambahkan."); document.location="dashboard.php?page=tampil_obat";</script>';
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
  <form method="POST" action="dashboard.php?page=tambah_obat" class="m-4">
    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="form-outline">
          <label class="form-label" for="Name">
            <h6>Nama Obat</h6>
          </label>
          <input type="text" id="Name" class="form-control form-control-lg" name="nama_obat" />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-4 pb-2">
        <div class="form-outline">

          <label class="form-label" for="harga">Harga</label>

          <div class="input-group mb-3">
            <span class="input-group-text">Rp</span>
            <input type="text" id="harga" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="harga">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-4 pb-2">
        <div class="form-outline">
          <label class="form-label" for="keterangan">Keterangan</label>
          <input type="text" id="keterangan" class="form-control form-control-lg" name="keterangan" />
        </div>
      </div>
    </div>
    <div class="mt-4 pt-2 text-end">
      <a href="dashboard.php?page=tampil_obat" class="btn btn-danger">Kembali</a>
      <input class="btn btn-primary" type="submit" value="Tambah">
    </div>
  </form>
</div>