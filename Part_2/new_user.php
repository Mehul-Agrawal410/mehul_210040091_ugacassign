<?php
  session_start();
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'mysql');
    if (!$conn) {
        die('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    
    // Prepare a SQL statement
    $sql = "INSERT INTO users (name, username, password) VALUES ('$name', '$username', '$password')";
    if (mysqli_query($conn, $sql)) {
      echo "<script src=\"https://code.jquery.com/jquery-3.6.0.min.js\"></script>";
      echo "<script>
            $(document).ready(function() {
              $('#modal').modal('show');
              setTimeout(function() {
                window.location.href = 'login.php';
              }, 3000);
            });
          </script>";
    }
    else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    mysqli_close($conn);
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>New User</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
  <div class="bg-image">
    <div class="overlay">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-sm-6 col-md-4">
            <div class="card bg-transparent overlay-form">
              <div class="card-body text-white">
                <h2 class="card-title text-center mb-4">New User</h2>
                <form name="lgn_frm" method="post" action="new_user.php">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" placeholder="Name" name="name" required>
                </div>
                  <div class="form-group mt-3">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="User name" pattern="[a-zA-Z0-9]+" required>
                  </div>
                  <div class="form-group mt-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" pattern="[a-zA-Z0-9]+" placeholder="Password" required>
                  </div>
                  <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                  </div> 
                </form>
                <p class="mt-2 text-center">Already have an account <a href="login.php">Login</a>.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal">Hello <?php echo $name ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Your registration was a success. You are being redirected to the login page now.
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>