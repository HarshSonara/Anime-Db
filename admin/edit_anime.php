<?php
include '../db.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM anime WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $genre = $_POST['genre'];
    $episodes = $_POST['episodes'];
    $description = $_POST['description'];
    $rating = $_POST['rating'];

    if (!empty($_FILES['image']['name'])) {
        $imgName = $_FILES['image']['name'];
        $imgTmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($imgTmp, "../uploads/" . $imgName);
        mysqli_query($conn, "UPDATE anime SET name='$name', genre='$genre', episodes='$episodes', description='$description', rating='$rating', image='$imgName' WHERE id=$id");
    } else {
        mysqli_query($conn, "UPDATE anime SET name='$name', genre='$genre', episodes='$episodes', description='$description', rating='$rating' WHERE id=$id");
    }

    header('Location: dashboard.php');
}
?>

<form method="POST" enctype="multipart/form-data">
    Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
    Genre: <input type="text" name="genre" value="<?php echo $row['genre']; ?>"><br>
    Episodes: <input type="number" name="episodes" value="<?php echo $row['episodes']; ?>"><br>
    Description:<br><textarea name="description"><?php echo $row['description']; ?></textarea><br>
    Rating: <input type="text" name="rating" value="<?php echo $row['rating']; ?>"><br>
    Current Image:<br><img src="../uploads/<?php echo $row['image']; ?>" height="100"><br>
    Change Image: <input type="file" name="image"><br><br>
    <button type="submit" name="update">Update Anime</button>
</form>
