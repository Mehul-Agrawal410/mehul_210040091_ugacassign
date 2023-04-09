<?php
  // Start the session and check if the user is logged in
  include('connection.php');

  $post_id = $_GET['id'];
  // Get the user who submitted the comment
  $user_id = $_SESSION['user_id'];
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the post ID and the comment content from the form
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    // Insert the comment into the database
    $query = "INSERT INTO comments (post_id, user_id, content) VALUES ('$post_id', '$user_id', '$content')";
    mysqli_query($conn, $query);
    header("Location: post.php?id=$post_id");
    // Close the database connection
    mysqli_close($conn);
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Comment</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.min.css">
  </head>
  <body class="overflow-hidden">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container-fluid ps-4 pe-4">
        <div class="d-flex justify-content-between">
          <div class="d-flex align-items-center justify-content-center rounded-circle border border-success">
            <a class="navbar-brand icon-space" href="index.php"><i class="fa-regular fa-user fa-lg"></i></a>
          </div>  
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item me-3">
              <a class="nav-link" href="index.php">Home
                <span class="visually-hidden">(current)</span>
              </a>
            </li>
            <li class="nav-item me-3">
              <a class="nav-link" href="make_post.php">Create Post</a>
            </li>
            <li>
              <a class="nav-link me-3" href="post.php?id=<?php echo $post_id ?>">See post</a>
            </li>
          </ul>
          <form class="d-flex" action="logout.php">
            <button class="btn btn-success ms-2 my-sm-0" type="submit"><i class="fa-solid fa-right-from-bracket"></i></button>
          </form>
        </div>
      </div>
    </nav>

    <div class="bg-image-create">
      <div class="overlay-create text-light">
        <div class="px-3">
          <h4 class="my-3">Add a comment:</h4>
          <form action="add_comment.php?id=<?php echo $post_id; ?>" method="POST">
            <div class="form-group">
              <textarea class="form-control bg-secondary" id="content" name="content" rows="5" placeholder="Your reply"></textarea>
            </div>
            <button type="submit" class="btn btn-success mt-3">Save</button>
          </form>
        </div>
      </div>
    </div>

    <script src="https://kit.fontawesome.com/71649ebe6c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>