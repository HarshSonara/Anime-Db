<?php
include 'db.php'; 
$result = mysqli_query($conn, "SELECT * FROM anime");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Info Database</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Anime Info Database</h1>
        <form method="GET" action="index.php" class="search-form">
            <input type="text" name="search" placeholder="Search anime...">
            <button type="submit">Search</button>
        </form>
    </header>

    <section class="anime-list">
        <?php
        // Search functionality
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $result = mysqli_query($conn, "SELECT * FROM anime WHERE name LIKE '%$search%'");
        }
        
        // Display anime list
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='anime-card'>";
            echo "<img src='uploads/".$row['image']."' alt='".$row['name']."' class='anime-image'>";
            echo "<h3>".$row['name']."</h3>";
            echo "<a href='anime.php?id=".$row['id']."' class='view-details-btn'>View Details</a>";
            echo "</div>";
        }
        ?>
    </section>
</body>
</html>
