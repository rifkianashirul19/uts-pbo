<?php
include 'connection.php';
include 'assets/template/header.php';
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST['username']) || empty($_POST['password'])) {
    echo "Isi kedua bidang username dan password.";
  } else {
    $Firstname = $_POST['firstname'];
    $Lastname = $_POST['lastname'];
    $Username = $_POST['username'];
    $Password = $_POST['password'];


    $Firstname = mysqli_real_escape_string($koneksi, $Firstname);
    $Lastname = mysqli_real_escape_string($koneksi, $Lastname);
    $Username = mysqli_real_escape_string($koneksi, $Username);
    $Password = mysqli_real_escape_string($koneksi, $Password);


    $check_query = "SELECT * FROM user WHERE username='$Username'";
    $check_result = $koneksi->query($check_query);
    $insert_query = "INSERT INTO user (firstname, lastname, username, password) VALUES ('$Firstname','$Lastname','$Username', '$Password')";

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
    /* fallback for old browsers */
    background: #6a11cb;

    /* Chrome 10-25, Safari 5.1-6 */
    background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
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
                <h2 class="fw-bold mb-5">Sign up</h2>
                <form>
                  <!-- 2 column grid layout with text inputs for the first and last names -->
                  <div class="row">
                    <div class="col-md-6 mb-2">
                      <div class="form-outline">
                        <label class="form-label" for="form3Example1">First name</label>
                        <input type="text" id="form3Example1" class="form-control" name="firstname" />
                      </div>
                    </div>
                    <div class="col-md-6 mb-2">
                      <div class="form-outline">
                        <label class="form-label" for="form3Example2">Last name</label>
                        <input type="text" id="form3Example2" class="form-control" name="lastname" />
                      </div>
                    </div>
                  </div>

                  <!-- Username input -->
                  <div class="form-outline mb-2">
                    <label class="form-label" for="form3Example3">Username</label>
                    <input id="form3Example3" class="form-control" name="username" />
                  </div>

                  <!-- Password input -->
                  <div class="form-outline mb-2">
                    <label class="form-label" for="form3Example4">Password</label>
                    <input type="password" id="form3Example4" class="form-control" name="password" />
                  </div>

                  <!-- Submit button -->
                  <button type="submit" class="btn btn-primary btn-block mt-2">
                    Sign up
                  </button>

              </div>

              <div>
                <p class="mb-0">Have an account? <a href="login.php" class="text-white-50 fw-bold">Log in</a>
                </p>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</section>