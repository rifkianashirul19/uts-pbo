<?php
include 'connection.php';
include 'template/header.php';
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
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $_SESSION['title']; ?></title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white sidebar-menu" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-5 fw-bold text-uppercase border-bottom"><i class="fa-solid fa-hospital"></i> Rumah Sakit</div>
            <div class="list-group list-group-flush my-3">
                <a href="dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="dashboard.php?page=tampil_pasien" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-user me-2"></i>Pasien</a>
                <a href="dashboard.php?page=tampil_dokter" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-solid fa-user-doctor me-2"></i>Dokter</a>
                <a href="dashboard.php?page=tampil_obat" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-solid fa-capsules me-2"></i></i>Obat</a>
                <a href="dashboard.php?page=tampil_poliklinik" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-solid fa-house-chimney-medical me-2"></i>Poli Klinik</a>
                <a href="dashboard.php?page=tampil_rekmed" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-solid fa-file me-2"></i>Rekam Medis</a>
                <a href="logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper" role="main">
            <?php
            $queries = array();
            parse_str($_SERVER['QUERY_STRING'], $queries);
            error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
            switch ($queries['page']) {
                case 'tampil_pasien':
                    # code...
                    include 'pasien.php';
                    break;
                case 'tampil_dokter':
                    # code...
                    include 'dokter.php';
                    break;
                case 'tampil_obat':
                    # code...
                    include 'obat.php';
                    break;
                case 'tampil_poliklinik':
                    # code...
                    include 'poli.php';
                    break;
                case 'tampil_rekmed':
                    # code...
                    include 'rekmed.php';
                    break;
                default:
                    #code...
                    include 'home.php';
                    break;
            }
            ?>
        </div>
    </div>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        };
    </script>
</body>

</html>