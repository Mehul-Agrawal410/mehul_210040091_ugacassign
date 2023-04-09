<?php
    include('connection.php');

    $user_id = $_SESSION['user_id'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $title = $_POST['title'];
        $content = $_POST['content'];
        $sql = "INSERT INTO posts (user_id, title, content) VALUES ('$user_id','$title','$content')";
        mysqli_query($conn, $sql);
        $last_id = $conn->insert_id;
        header("Location: post.php?id=$last_id");
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Create post </title>
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
                <a class="nav-link active" href="make_post.php">Create Post</a>
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
                <h3 class="mt-3">Create your Post here:</h3>
                <form action="make_post.php" method="POST">
                    <div class="form-group">
                        <label for="title" class="form-label mt-4 fw-bold">Title of your Post:</label>
                        <input type="text" class="form-control bg-secondary" id="title" name="title" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="content" class="form-label mt-4 fw-bold">Your content:</label>
                        <textarea class="form-control bg-secondary" id="content" name="content" rows="3" placeholder="Content of your post"></textarea>
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