<?php
  // Start the session and check if the user is logged in
  session_start();
  if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
  }

  // Connect to the database
  $conn = mysqli_connect('localhost', 'root', '', 'mysql');

  // Get the post and the user who wrote it
  $post_id = $_GET['id'];
  $query = "SELECT posts.title, posts.content, DATE_FORMAT(posts.created_at, '%M %e, %Y at %h:%i %p') AS created_at, users.name
            FROM posts
            INNER JOIN users ON posts.user_id = users.id
            WHERE posts.id = $post_id";
  $result = mysqli_query($conn, $query);
  $post = mysqli_fetch_assoc($result);

  // Get all the comments and the users who wrote them
  $query = "SELECT comments.content, DATE_FORMAT(comments.created_at, '%M %e, %Y at %h:%i %p') AS created_at, users.name         
            FROM comments
            INNER JOIN users ON comments.user_id = users.id
            WHERE comments.post_id = $post_id
            ORDER BY comments.created_at ASC";
  $result = mysqli_query($conn, $query);
  $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

  // Close the database connection
  mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title><?php echo $post['title']; ?></title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>

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
        </ul>
        <form class="d-flex" action="logout.php">
          <button class="btn btn-success ms-2 my-sm-0" type="submit"><i class="fa-solid fa-right-from-bracket"></i></button>
        </form>
      </div>
    </div>
  </nav>

  
    <div class="post-container">
    <div class="post">
      <h2><?php echo $post['title']; ?></h2>
      <p class="post-info">Posted by <?php echo $post['name']; ?> on <?php echo $post['created_at']; ?></p>
      <p><?php echo $post['content']; ?></p>
    </div>
    <div class="comments-container">
      <div class="d-flex justify-content-between">
        <h3>Comments</h3>
        <div>
          <a href="add_comment.php?id=<?php echo $post_id; ?>"><i class="fa-solid fa-circle-plus fa-2xl"></i></a>
          <p class="text-success mt-2 add-btn">Add</p>
        </div>
      </div>
      <?php foreach ($comments as $comment): ?>
        <div class="comment">
          <p class="comment-info">Comment by <?php echo $comment['name']; ?> on <?php echo $comment['created_at']; ?></p>
          <p><?php echo $comment['content']; ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <script src="https://kit.fontawesome.com/71649ebe6c.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>