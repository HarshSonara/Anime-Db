<?php
include '../db.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
}

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM anime WHERE id=$id");

header('Location: dashboard.php');
?>
