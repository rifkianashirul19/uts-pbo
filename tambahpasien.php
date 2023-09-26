<?php
include('connection.php');
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Mengambil data dari form
  $nama_pasien = $_POST["nama_pasien"];
  $kelamin = $_POST["kelamin"];
  $notelp = $_POST["notelp"];
  $alamat = $_POST["alamat"];

  $nama_pasien = mysqli_real_escape_string($koneksi, $nama_pasien);
  $kelamin = mysqli_real_escape_string($koneksi, $kelamin);
  $notelp = mysqli_real_escape_string($koneksi, $notelp);
  $alamat = mysqli_real_escape_string($koneksi, $alamat);

  $notelp = preg_replace("/[^0-9]/", "", $notelp);

  // Menambahkan kode negara +62 jika tidak ada
  if (!preg_match("/^\+62/", $notelp)) {
    $notelp = "+62" . ltrim($notelp, "0"); // Menghilangkan nol awal jika ada
  }

  // Query INSERT
  $sql = "INSERT INTO pasien (nama_pasien, kelamin, notelp, alamat) VALUES ('$nama_pasien', '$kelamin', '$notelp' , '$alamat')";

  if ($koneksi->query($sql) === TRUE) {
    echo '<script>alert("Data Berhasil ditambahkan."); document.location="dashboard.php?page=tampil_pasien";</script>';
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
  <form method="POST" action="dashboard.php?page=tambah_pasien" class="m-4">
    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="form-outline">
          <label class="form-label" for="Name">
            <h6>Nama</h6>
          </label>
          <input type="text" id="Name" class="form-control form-control-lg" name="nama_pasien" />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-4">

        <h6 class="mb-2 pb-1">Jenis Kelamin: </h6>

        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="kelamin" id="laki_laki" value="Laki-laki" checked />
          <label class="form-check-label" for="laki_laki">Laki-laki</label>
        </div>

        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="kelamin" id="perempuan" value="Perempuan" />
          <label class="form-check-label" for="perempuan">Perempuan</label>
        </div>

        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="kelamin" id="otherGender" value="Lainnya" />
          <label class="form-check-label" for="otherGender">Lainnya</label>
        </div>

      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-4 pb-2">
        <div class="form-outline">
          <label class="form-label" for="phoneNumber">Nomor Telepon</label>
          <input type="tel" id="phoneNumber" class="form-control form-control-lg" name="notelp" />
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-4 pb-2">
        <div class="form-outline">
          <label class="form-label" for="alamat">Alamat</label>
          <input type="text" id="alamat" class="form-control form-control-lg" name="alamat" />
        </div>
      </div>
    </div>

    <div class="mt-4 pt-2 text-end">
      <a href="dashboard.php?page=tampil_pasien" class="btn btn-danger">Kembali</a>
      <input class="btn btn-primary" type="submit" value="Tambah">
    </div>

  </form>
</div>