<?php
session_start();
include "dbconnect.php";

// Check if admin is logged in
if (!isset($_SESSION["username"])) {
    header("Location: adminlogin.php");
    exit();
}

// Get student ID
if (isset($_GET["id"])) {
    $id = $_GET["id"];
 $result = $conn->query("SELECT * FROM student WHERE studentid = '$id'");



    $row = $result->fetch_assoc();
}

// Update Student
if (isset($_POST["update"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $course = $_POST["course"];

    $sql = "UPDATE student SET name='$name', email='$email', courseid='$course' WHERE studentid='$id'";


    if ($conn->query($sql)) {
        header("Location: managestudents.php?update_success=1");
        exit();
    } else {
        echo "Error updating student: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
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
        <h2>Edit Student</h2>
        <form method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $row['email']; ?>" required>

            <label for="course">Course:</label>
            <input type="text" name="course" value="<?php echo isset($row['course']) ? $row['course'] : ''; ?>" required>



            <button type="submit" name="update">Update Student</button>
        </form>
        <br>
        <a href="managestudents.php">Back to Manage Students</a>
    </div>
</body>
</html>
