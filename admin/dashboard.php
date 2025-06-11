<?php
include '../db.php';
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
}

$result = mysqli_query($conn, "SELECT * FROM anime");
?>
<a href="add_anime.php">Add New Anime</a><br><br>
<h2>Anime List</h2>
<table border="1" cellpadding="10">
<tr>
<th>Name</th><th>Genre</th><th>Episodes</th><th>Actions</th>
</tr>
<?php
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".$row['genre']."</td>";
    echo "<td>".$row['episodes']."</td>";
    echo "<td>
        <a href='edit_anime.php?id=".$row['id']."'>Edit</a> | 
        <a href='delete_anime.php?id=".$row['id']."'>Delete</a>
        </td>";
    echo "</tr>";
}
?>
</table>
