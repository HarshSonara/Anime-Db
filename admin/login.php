<?php
include '../db.php';
session_start();

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    
    $result = mysqli_query($conn, "SELECT * FROM admin WHERE username='$user' AND password='$pass'");
    
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['admin'] = $user;
        header('Location: dashboard.php');
    } else {
        echo "Invalid credentials!";
    }
}
?>
<form method="POST">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit" name="login">Login</button>
</form>
