<?php
include('connection.php');

// Get all the posts and the users who wrote them
$query = "SELECT posts.id, posts.title, posts.content, DATE_FORMAT(posts.created_at, '%M %e, %Y at %h:%i %p') AS created_at, users.name
          FROM posts
          INNER JOIN users ON posts.user_id = users.id
          ORDER BY posts.created_at DESC";
$result = mysqli_query($conn, $query);
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Forum</title>
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
            <a class="nav-link active" href="index.php">Home
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

    <div class="posts-container">
      <?php foreach ($posts as $post): ?>
      <div class="post">
        <h2><a href="post.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
        <p class="post-info">Posted by <?php echo $post['name']; ?> on <?php echo $post['created_at']; ?></p>
        <p><?php echo $post['content']; ?></p>
      </div>
      <?php endforeach; ?>
    </div>

    <script src="https://kit.fontawesome.com/71649ebe6c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
  </html>
  