<?php
session_start();
if (isset($_SESSION["studentid"])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Student Management System</h1>
        <nav class="button-container"> 
            <a href="index.php">Home</a>
            <a href="login.php">Student Login</a>
            <a href="signup.php">Sign Up</a>
            <a href="adminlogin.php">Admin Login</a>
            <a href="teacherlogin.php">Teacher Login</a>
        </nav>
    </header>
    <h1>Student Management System</h1>
    <div class="content">
        <h2>Login</h2>
        <form action="logindb.php" method="post">
            <label for="studentid">Student ID:</label>
            <input type="text" id="studentid" name="studentid" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="login">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Register here</a></p>
    </div>
</body>
</html>
