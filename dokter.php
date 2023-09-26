<?php
//memasukkan file connection.php
include('connection.php');

$records_per_page = 7;

if (isset($_GET['page_no'])) {
  $current_page = $_GET['page_no'];
} else {
  $current_page = 1;
}

$start_record = ($current_page - 1) * $records_per_page;

if ($current_page == 1) {
  $query = "SELECT * FROM dokter ORDER BY dokterid ASC LIMIT $records_per_page";
} else {
  $query = "SELECT * FROM dokter ORDER BY dokterid ASC LIMIT $start_record, $records_per_page";
}

$result = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

$total_records = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM dokter"));

$total_pages = ceil($total_records / $records_per_page);
?>

<title>dokter</title>
<nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
  <div class="d-flex align-items-center">
    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
    <h2 class="fs-2 m-0">Data dokter</h2>
  </div>

  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-user me-2"></i>
          <?php
          echo "" . $_SESSION['username'] . "";
          ?>
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="#">Profile</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><a class="dropdown-item" href="logout.php">Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
<div class="container" style="margin-top:20px">
  <div class="row mb-3">
    <div class="col-md-6">
      <a href="dashboard.php?page=tambah_dokter"><button class="btn btn-dark">Tambah Data</button></a>
    </div>
    <div class="col-md-6">
      <form action="dashboard.php?page=tampil_dokter" method="POST">
        <div class="input-group">
          <input type="text" name="keyword" class="form-control" placeholder="Cari dokter">
          <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
      </form>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-striped jambo_table bulk_action">
      <thead>
        <tr>
          <th>NO.</th>
          <th>ID Dokter</th>
          <th>Nama Dokter</th>
          <th>Spesialis</th>
          <th>No Telpon</th>
          <th>Alamat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        //query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
        $sql = mysqli_query($koneksi, "SELECT * FROM dokter ORDER BY dokterid ASC LIMIT $start_record, $records_per_page") or die(mysqli_error($koneksi));
        //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
        if (mysqli_num_rows($sql) > 0) {
          //membuat variabel $no untuk menyimpan nomor urut
          $no = ($current_page - 1) * $records_per_page + 1;
          //melakukan perulangan while dengan dari dari query $sql
          while ($data = mysqli_fetch_assoc($sql)) {
            //menampilkan data perulangan
            echo '
						<tr>
							<td>' . $no . '</td>
							<td>' . $data['dokterid'] . '</td>
							<td>' . $data['nama_dokter'] . '</td>
							<td>' . $data['spesialis'] . '</td>
							<td>' . $data['notelp'] . '</td>
							<td>' . $data['alamat'] . '</td>
							<td>
								<a href="dashboard.php?page=edit_dokter&dokterid=' . $data['dokterid'] . '" class="btn btn-secondary btn-sm">Edit</a>
								<a href="delete.php?dokterid=' . $data['dokterid'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
							</td>
						</tr>
						';
            $no++;
          }
          //jika query menghasilkan nilai 0
        } else {
          echo '
					<tr>
						<td colspan="6">Tidak ada data.</td>
					</tr>
					';
        }
        ?>
      <tbody>
    </table>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <ul class="pagination justify-content-center">
      <?php
      for ($i = 1; $i <= $total_pages; $i++) {
        echo '<li class="page-item ';
        if ($i == $current_page) {
          echo 'active';
        }
        echo '"><a class="page-link" href="dashboard.php?page=tampil_dokter&page_no=' . $i . '">' . $i . '</a></li>';
      }
      ?>
    </ul>
  </div>
</div>