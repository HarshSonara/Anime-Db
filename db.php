<?php
$host = "localhost";
$user = "root"; // default for XAMPP
$pass = "";
$db = "anime_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
