<?php
include 'connection.php';
include 'tampil.php';
?>
<?php
session_start();

// Set title
$title = "Dashboard";

// Simpan title dalam session
$_SESSION['title'] = $title;

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
  <div class="d-flex align-items-center">
    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
    <h2 class="fs-2 m-0">Dashboard</h2>
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
<div class="container-fluid px-4">
  <div class="row g-3 my-2">
    <div class="col-md-3">
      <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
        <div>
          <h3 class="fs-2"><?php echo $jumlah_pasien; ?></h3>
          <p class="fs-5">Pasien</p>
        </div>
        <i class="fa-regular fa-user fs-1 primary-text border rounded-full secondary-bg p-3"></i>
      </div>
    </div>

    <div class="col-md-3">
      <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
        <div>
          <h3 class="fs-2"><?php echo $jumlah_dokter; ?></h3>
          <p class="fs-5">Dokter</p>
        </div>
        <i class="fas fa-solid fa-user-doctor fs-1 primary-text border rounded-full secondary-bg p-3"></i>
      </div>
    </div>

    <div class="col-md-3">
      <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
        <div>
          <h3 class="fs-2"><?php echo $jumlah_obat; ?></h3>
          <p class="fs-5">Obat</p>
        </div>
        <i class="fas fa-solid fa-capsules fs-1 primary-text border rounded-full secondary-bg p-3"></i>
      </div>
    </div>
    <div class="col-md-3">
      <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
        <div>
          <h3 class="fs-2"><?php echo $jumlah_klinik; ?></h3>
          <p class="fs-5">Poli Klinik</p>
        </div>
        <i class="fas fa-solid fa-house-chimney-medical fs-1 primary-text border rounded-full secondary-bg p-3"></i>
      </div>
    </div>
    <div class="col-md-3">
      <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
        <div>
          <h3 class="fs-2"><?php echo $jumlah_rekmed; ?></h3>
          <p class="fs-5">Rekam Medis</p>
        </div>
        <i class="fas fa-solid fa-file fs-1 primary-text border rounded-full secondary-bg p-3"></i>
      </div>
    </div>
  </div>
</div>
<script>
  var el = document.getElementById("wrapper");
  var toggleButton = document.getElementById("menu-toggle");

  toggleButton.onclick = function() {
    el.classList.toggle("toggled");
  };
</script>