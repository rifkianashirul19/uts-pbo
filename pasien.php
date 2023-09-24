<?php
//memasukkan file config.php
include('connection.php');
?>


<div class="container" style="margin-top:20px">
  <center>
    <font size="6">Data Pasien</font>
  </center>
  <hr>
  <a href="index.php?page=tambah_pasien"><button class="btn btn-dark right">Tambah Data</button></a>
  <div class="table-responsive">
    <table class="table table-striped jambo_table bulk_action">
      <thead>
        <tr>
          <th>NO.</th>
          <th>ID Pasien</th>
          <th>Nama Pasien</th>
          <th>Jenis Kelamin</th>
          <th>No Telpon</th>
          <th>Alamat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        //query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
        $sql = mysqli_query($koneksi, "SELECT * FROM pasien ORDER BY pasienid ASC") or die(mysqli_error($koneksi));
        //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
        if (mysqli_num_rows($sql) > 0) {
          //membuat variabel $no untuk menyimpan nomor urut
          $no = 1;
          //melakukan perulangan while dengan dari dari query $sql
          while ($data = mysqli_fetch_assoc($sql)) {
            //menampilkan data perulangan
            echo '
						<tr>
							<td>' . $no . '</td>
							<td>' . $data['pasienid'] . '</td>
							<td>' . $data['nama_pasien'] . '</td>
							<td>' . $data['kelamin'] . '</td>
							<td>' . $data['notelp'] . '</td>
							<td>' . $data['alamat'] . '</td>
							<td>
								<a href="index.php?page=edit_pasien&Nim=' . $data['Nim'] . '" class="btn btn-secondary btn-sm">Edit</a>
								<a href="delete.php?Nim=' . $data['Nim'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
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