<?php
include "dbconnect.php"; // Connecting to the database

if (isset($_POST['submit'])) {
    $studentid = $_POST['studentid'];
    $courseid = $_POST['courseid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Encrypt password for security

    // SQL query to insert data into student table
    $sql = "INSERT INTO student (studentid, courseid, name, email, password) 
            VALUES ('$studentid', '$courseid', '$name', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Student added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Student</title>
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
    <h2>Add New Student</h2>
    <form method="post">
        <label>Student ID:</label>
        <input type="text" name="studentid" required><br>
        <label>Course ID:</label>
        <input type="number" name="courseid" required><br>
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit" name="submit">Add Student</button>
    </form>
</body>
</html>
 