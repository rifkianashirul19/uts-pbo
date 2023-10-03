<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_pasien"])) {
  // Mengambil data dari form
  $pasienid = $_POST["pasienid"]; // Unique pasienidentifier for the patient's record
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

  // Query UPDATE
  $sql = "UPDATE pasien SET nama_pasien = '$nama_pasien', kelamin = '$kelamin', notelp = '$notelp', alamat = '$alamat' WHERE pasienid = $pasienid";

  if ($koneksi->query($sql) === TRUE) {
    echo '<script>alert("Data Berhasil diubah."); document.location="dashboard.php?page=tampil_pasien";</script>';
  } else {
    echo "Error: " . $koneksi->error;
  }
}

// Retrieve the patient's data to populate the form for editing
if (isset($_GET["pasienid"])) {
  $pasienid = $_GET["pasienid"];
  $sql = "SELECT * FROM pasien WHERE pasienid = $pasienid";
  $result = $koneksi->query($sql);

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $nama_pasien = $row["nama_pasien"];
    $kelamin = $row["kelamin"];
    $notelp = $row["notelp"];
    $alamat = $row["alamat"];
  } else {
    echo "Data Pasien Tidak Ditemukan.";
    exit;
  }
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
  <div class="d-flex align-items-center">
    <i class="fas fa-align-left primary-text fs-4 me-3" pasienid="menu-toggle"></i>
    <h2 class="fs-2 m-0">Edit Data</h2>
  </div>
</nav>
<div class="container-fluid">
  <form method="POST" action="dashboard.php?page=edit_pasien" class="m-4">
    <input type="hidden" name="pasienid" value="<?php echo $pasienid; ?>">
    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="form-outline">
          <label class="form-label" for="Name">
            <h6>Nama</h6>
          </label>
          <input type="text" id="Name" class="form-control form-control-lg" name="nama_pasien" value="<?php echo $nama_pasien; ?>" />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-4">

        <h6 class="mb-2 pb-1">Jenis Kelamin: </h6>

        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="kelamin" id="laki_laki" value="Laki-laki" <?php if ($kelamin == 'Laki-laki') echo 'checked'; ?> />
          <label class="form-check-label" for="laki_laki">Laki-laki</label>
        </div>

        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="kelamin" id="perempuan" value="Perempuan" <?php if ($kelamin == 'Perempuan') echo 'checked'; ?> />
          <label class="form-check-label" for="perempuan">Perempuan</label>
        </div>

        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="kelamin" id="otherGender" value="Lainnya" <?php if ($kelamin == 'Lainnya') echo 'checked'; ?> />
          <label class="form-check-label" for="otherGender">Lainnya</label>
        </div>

      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-4 pb-2">
        <div class="form-outline">
          <label class="form-label" for="harga">Nomor Telepon</label>
          <div class="input-group mb-3">
            <span class="input-group-text">+62</span>
            <input type="text" id="harga" class="form-control" aria-label="Nomor Telepon dengan +62" name="notelp" value="<?php echo $notelp; ?>">
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-4 pb-2">
        <div class="form-outline">
          <label class="form-label" for="alamat">Alamat</label>
          <input type="text" id="alamat" class="form-control form-control-lg" name="alamat" value="<?php echo $alamat; ?>" />
        </div>
      </div>
    </div>

    <div class="mt-4 pt-2 text-end">
      <a href="dashboard.php?page=tampil_pasien" class="btn btn-danger">Kembali</a>
      <input class="btn btn-primary" type="submit" name="edit_pasien" value="Simpan Perubahan">
    </div>

  </form>
</div>