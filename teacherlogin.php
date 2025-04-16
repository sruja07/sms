<?php
session_start();
include "dbconnect.php";

if (isset($_POST["login"])) {
    $name = $_POST["name"];
    $password = $_POST["password"];

    $query = "SELECT * FROM teachers WHERE name='$name' AND password='$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["teacherid"] = $row["teacherid"];  // ✅ Correct session
        $_SESSION["teacher_name"] = $row["name"];    // Optional, for displaying name
        header("Location: teacherdashboard.php");
        exit();
    } else {
        echo "<p style='color:red;'>Invalid Name or Password!</p>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login</title>
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
    <div class="container" style="margin-top: 200px;">
        <h2>Teacher Login</h2>
     
            <form method="POST">
                <label for="name">Teacher Name</label>
                <input type="text" name="name">
                <label for="password">Password</label>
                <input type="password" name="password">
                <button type="submit" name="login" class="btn">Login</button>
            </form>
        </div>
</body>
</html>
