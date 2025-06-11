<?php
include 'db.php';

if (!isset($_GET['id'])) {
    echo "Anime ID not provided!";
    exit;
}

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM anime WHERE id = $id");
$anime = mysqli_fetch_assoc($result);

// Get suggestions
$suggestions = mysqli_query($conn, "SELECT * FROM anime WHERE id != $id ORDER BY RAND() LIMIT 3");
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $anime['name']; ?> - Anime Info</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3e5f5;
            margin: 0;
            padding: 0;
        }

        .back-home {
            display: inline-block;
            margin: 20px;
            text-decoration: none;
            background-color: #7e57c2;
            color: white;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .back-home:hover {
            background-color: #5a3e93;
        }

        .anime-detail {
            max-width: 700px;
            margin: 20px auto;
            background-color: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
        }

        .anime-detail img {
            width: 220px;
            height: 320px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .anime-detail h2 {
            color: #7e57c2;
            margin-bottom: 10px;
        }

        .anime-detail p {
            font-size: 16px;
            color: #444;
            line-height: 1.6;
        }

        .suggestions {
            max-width: 900px;
            margin: 40px auto;
            padding: 10px;
        }

        .suggestions h3 {
            color: #7e57c2;
            margin-bottom: 20px;
            text-align: center;
        }

        .suggestion-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .suggestion-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            transition: 0.3s;
        }

        .suggestion-card:hover {
            transform: scale(1.05);
        }

        .suggestion-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .suggestion-card h4 {
            margin: 10px 0;
            color: #6a4ca3;
        }

        .suggestion-card a {
            display: block;
            background-color: #7e57c2;
            color: white;
            text-decoration: none;
            padding: 8px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .suggestion-card a:hover {
            background-color: #5a3e93;
        }
    </style>
</head>
<body>

<a href="index.php" class="back-home">⬅️ Back to Home</a>

<div class="anime-detail">
    <img src="uploads/<?php echo $anime['image']; ?>" alt="<?php echo $anime['name']; ?>">
    <h2><?php echo $anime['name']; ?></h2>
    <p><strong>Genre:</strong> <?php echo $anime['genre']; ?></p>
    <p><strong>Episodes:</strong> <?php echo $anime['episodes']; ?></p>
    <p><strong>Rating:</strong> <?php echo $anime['rating']; ?>/10</p>
    <p><?php echo $anime['description']; ?></p>
</div>

<div class="suggestions">
    <h3>More You May Like</h3>
    <div class="suggestion-list">
        <?php while ($sug = mysqli_fetch_assoc($suggestions)) { ?>
            <div class="suggestion-card">
                <img src="uploads/<?php echo $sug['image']; ?>" alt="<?php echo $sug['name']; ?>">
                <h4><?php echo $sug['name']; ?></h4>
                <a href="anime.php?id=<?php echo $sug['id']; ?>">View Details</a>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
