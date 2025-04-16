<?php
session_start();
include("dbconnect.php");

// Check if admin is logged in
if (!isset($_SESSION["username"])) {
    header("Location: adminlogin.php");
    exit();
}

// Fetch students from the database
$studentsQuery = $conn->query("SELECT studentid, courseid, name, email FROM student");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
    <link rel="stylesheet" href="style.css">
</head>

<!-- Added class 'manage-students' to body -->
<body class="manage-students">
    <div class="navbar">
        <ul class="menu">
            <li><a href="managestudents.php">Manage Students</a></li>
            <li><a href="manageteachers.php">Manage Teachers</a></li>
            <li><a href="managecourses.php">Manage Courses</a></li>
            <li><a href="index.php">Logout</a></li>
        </ul>
    </div>

    <div class="container">
        <h2>Student List</h2>
        <a href="addstudent.php" class="btn">Add New Student</a>

        <div class="table-container">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Action</th>
                </tr>

                <?php
                if ($studentsQuery->num_rows > 0) {
                    while ($row = $studentsQuery->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['studentid']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['courseid']}</td>
                                <td>
                                    <a href='editstudent.php?id={$row['studentid']}' class='edit-btn'>Edit</a>
                                    <a href='delete.php?id={$row['studentid']}' class='delete-btn' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No students found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
    
</body>
</html>
