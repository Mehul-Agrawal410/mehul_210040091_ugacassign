<?php
// Start the session and check if the user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'mysql');
if(mysqli_connect_errno()) {  
    die("Failed to connect with MySQL ". mysqli_connect_error());  
}
?>