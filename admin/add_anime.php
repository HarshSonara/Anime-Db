<?php
include '../db.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
}

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $genre = $_POST['genre'];
    $episodes = $_POST['episodes'];
    $description = $_POST['description'];
    $rating = $_POST['rating'];
    
    $imgName = $_FILES['image']['name'];
    $imgTmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($imgTmp, "../uploads/".$imgName);

    mysqli_query($conn, "INSERT INTO anime (name, genre, episodes, description, rating, image) 
    VALUES ('$name', '$genre', '$episodes', '$description', '$rating', '$imgName')");

    header('Location: dashboard.php');
}
?>
<form method="POST" enctype="multipart/form-data">
    Name: <input type="text" name="name"><br>
    Genre: <input type="text" name="genre"><br>
    Episodes: <input type="number" name="episodes"><br>
    Description:<br><textarea name="description"></textarea><br>
    Rating: <input type="text" name="rating"><br>
    Image: <input type="file" name="image"><br><br>
    <button type="submit" name="add">Add Anime</button>
</form>
