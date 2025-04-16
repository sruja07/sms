<?php
session_start();
include "dbconnect.php";

// Check if admin is logged in
if (!isset($_SESSION["username"])) {
    header("Location: adminlogin.php");
    exit();
}

// Add Course Logic
if (isset($_POST["add_course"])) {
    $course_name = $_POST["course_name"];
    $sql = "INSERT INTO course (coursename) VALUES ('$course_name')";
    if ($conn->query($sql)) {
        header("Location: managecourses.php?success=1");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
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
        <h2>Add Course</h2>
        <form method="POST">
            <input type="text" name="course_name" placeholder="Enter Course Name" required>
            <button type="submit" name="add_course">Add Course</button>
        </form>
        <br><a href="managecourses.php">Back to Manage Courses</a>
    </div>
</body>
</html>
