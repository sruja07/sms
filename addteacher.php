<?php
session_start();
include "dbconnect.php";

// Check if admin is logged in
if (!isset($_SESSION["username"])) {
    header("Location: adminlogin.php");
    exit();
}

// Add Teacher
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $qualification = $_POST["qualification"];
    $subject = $_POST["subject"];
    $password = $_POST["password"]; // New password field

    $sql = "INSERT INTO teachers (name, qualification, subject, password) 
            VALUES ('$name', '$qualification', '$subject', '$password')";
    if ($conn->query($sql)) {
        echo "<script>alert('Teacher Added Successfully!'); window.location.href='manageteachers.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Teacher</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <ul class="menu">
            <li><a href="managestudents.php">Manage Students</a></li>
            <li><a href="manageteachers.php">Manage Teachers</a></li>
            <li><a href="managecourses.php">Manage Courses</a></li>
            <li><a href="index.php">Logout</a></li>
        </ul>
    </div>
    <div class="container">
        <h2>Add Teacher</h2>

        <!-- Add Teacher Form -->
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Enter Teacher Name" required>
            <input type="text" name="qualification" placeholder="Enter Qualification" required>
            <input type="text" name="subject" placeholder="Enter Subject" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit">Add Teacher</button>
        </form>

        <br><a href="manageteachers.php">Back to Manage Teachers</a>
    </div>
</body>
</html>
