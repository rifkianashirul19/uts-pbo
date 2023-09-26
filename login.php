<?php
include 'connection.php';
include 'assets/template/header.php';
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST['username']) || empty($_POST['password'])) {
    echo "Isi kedua bidang username dan password.";
  } else {
    $Username = $_POST['username'];
    $Password = $_POST['password'];


    $Username = mysqli_real_escape_string($koneksi, $Username);
    $Password = mysqli_real_escape_string($koneksi, $Password);


    $sql = "SELECT * FROM user WHERE username='$Username' AND password='$Password'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
      // Pengguna ditemukan, berikan akses
      session_start();
      $_SESSION['username'] = $Username;
      header("Location: dashboard.php");
    } else {
      // Pengguna tidak ditemukan, tampilkan pesan error
      echo '<script>alert("Login gagal. Silakan cek kembali username dan password Anda.");</script>';
    }

    $koneksi->close();
  }
}

?>
<title>Log In</title>
<style>
  .gradient-custom {
    background: #DEFFDB;
  }
</style>
<section class="vh-100 gradient-custom">
  <form action="login.php" method="POST">
    <div class="container py-5 h-80">
      <div class="row d-flex justify-content-center align-items-center h-80">
        <div class="col-10 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <div class="mb-md-1 mt-md-1">

                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                <p class="text-white-50 mb-3">Please enter your username and password!</p>

                <div class="form-outline form-white mb-2">
                  <label class="form-label" for="typeEmailX">Username</label>
                  <input class="form-control form-control-lg" name="username" required />
                </div>

                <div class="form-outline form-white mb-2">
                  <label class="form-label" for="typePasswordX">Password</label>
                  <input type="password" id="typePasswordX" class="form-control form-control-lg" name="password" required />
                </div>
                <p class="small mb-2 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>
                <button class="btn btn-outline-light btn-lg px-5" type="submit" style="background-color : #10A303">Login</button>
              </div>

              <div>
                <p class="mb-0">Don't have an account? <a href="register.php" class="text-white-50 fw-bold">Sign Up</a>
                </p>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</section>