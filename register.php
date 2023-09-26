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
    $email = $_POST['email'];
    $Password = $_POST['password'];


    $email = mysqli_real_escape_string($koneksi, $email);
    $Lastname = mysqli_real_escape_string($koneksi, $Lastname);
    $Username = mysqli_real_escape_string($koneksi, $Username);
    $Password = mysqli_real_escape_string($koneksi, $Password);


    $check_query = "SELECT * FROM user WHERE username='$Username'";
    $check_result = $koneksi->query($check_query);
    $insert_query = "INSERT INTO user (email, lastname, username, password) VALUES ('$email','$Lastname','$Username', '$Password')";

    if ($check_result->num_rows > 0) {
      echo "Username sudah digunakan. Silakan pilih username lain.";
    } else {
      if ($koneksi->query($insert_query) === TRUE) {
        header("Location: login.php");
      } else {
        echo "Error: " . $insert_query . "<br>" . $koneksi->error;
      }
    }
    $koneksi->close();
  }
}

?>

<!-- Section: Design Block -->
<title>Sign Up</title>
<style>
  .gradient-custom {
    background: #DEFFDB;
  }
</style>
<section class="vh-100 gradient-custom">
  <form action="signup.php" method="POST">
    <div class="container py-5 h-80">
      <div class="row d-flex justify-content-center align-items-center h-80">
        <div class="col-10 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
              <div class="mb-md-1 mt-md-1">
                <h2 class="fw-bold mb-4">Sign up</h2>
                <form>
                  <div class="row">
                    <!-- Username input -->
                    <div class="form-outline mb-2">
                      <label class="form-label" for="form3Example3">Username</label>
                      <input id="form3Example3" class="form-control" name="username" placeholder="Masukkan Username" />
                    </div>

                    <div class="form-outline mb-2">
                      <label class="form-label" for="form3Example1">Email</label>
                      <input type="email" id="form3Example1" class="form-control" name="email" placeholder="Masukkan Email" />
                    </div>
                    <!-- Password input -->
                    <div class="form-outline mb-2">
                      <label class="form-label" for="form3Example4">Password</label>
                      <input type="password" id="form3Example4" class="form-control" name="password" placeholder="Masukkan Password" />
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-block mt-4" style="background-color : #92A091">
                      Daftar
                    </button>

                  </div>

                  <div>
                    <p class="mt-2 mb-0">Have an account? <a href="login.php" class="text-white-50 fw-bold">Log in</a>
                    </p>
                  </div>

              </div>
            </div>
          </div>
        </div>
      </div>
  </form>
</section>