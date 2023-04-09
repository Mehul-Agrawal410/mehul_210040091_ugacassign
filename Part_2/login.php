<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'mysql');
    if (!$conn) {
        die('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    
    // Prepare a SQL statement
    $stmt = mysqli_prepare($conn, "SELECT id, password FROM users WHERE username = ?");
    // Bind the parameters and execute the statement
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    // echo $stmt;
    
    // Get the result
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        // Verify the password
        if ($password == $row['password']) {
            // Login successful, store the user ID in a session variable
            $_SESSION['user_id'] = $row['id'];
            header('Location: index.php');
            exit();
        } else {
            // Invalid password
            $error = 'Invalid username or password';
        }
    } else {
        // Invalid username
        $error = 'Invalid username or password.';
    }
    
    // Close the statement and the connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body class="form-bg">

<!-- <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="#">Home
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Separated link</a>
          </div>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-sm-2" type="search" placeholder="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav> -->

<!-- <div class="d-flex justify-content-center align-items-center vh-100">
  <div class="container-fluid col-4 border border-dark p-4">
    <h2 class="text-center mb-4">Login</h2>
    <?php if (isset($error)) { ?>
      <p><?php echo $error; ?></p>
    <?php } ?>
    <form name="lgn_frm" method="post">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="User name" pattern="[a-zA-Z0-9]+" required>
      </div>
      <div class="form-group mt-3">
        <label for="password1">Password</label>
        <input type="password" class="form-control" id="password1" name="password" pattern="[a-zA-Z0-9]+" placeholder="Password" required>
      </div>
      <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div> 
    </form>
    <p class="mt-2 text-center">Don't have an account? <a href="new_user.php">Create one</a>.</p>
  </div>
</div> -->

<div class="bg-image">
  <div class="overlay">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-sm-6 col-md-4">
          <div class="card bg-transparent overlay-form">
            <div class="card-body text-white">
              <h2 class="card-title text-center mb-4">Login</h2>
              <?php if (isset($error)) { ?>
                <p><?php echo $error; ?></p>
              <?php } ?>
              <form name="lgn_frm" method="post">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="User name" pattern="[a-zA-Z0-9]+" required>
                </div>
                <div class="form-group mt-3">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" pattern="[a-zA-Z0-9]+" placeholder="Password" required>
                </div>
                <div class="text-center mt-3">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div> 
              </form>
              <p class="mt-2 text-center">Don't have an account? <a href="new_user.php">Create one</a>.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
