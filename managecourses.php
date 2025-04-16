<?php
session_start();
include "dbconnect.php";

// Check if admin is logged in
if (!isset($_SESSION["username"])) {
    header("Location: adminlogin.php");
    exit();
}

// Delete Course
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $sql = "DELETE FROM course WHERE courseid = $id";
    if ($conn->query($sql)) {
        echo "Course Deleted!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch Courses
$result = $conn->query("SELECT * FROM course");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses</title>
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
        <h2>Manage Courses</h2>

        <!-- Add Course Button -->
        <a href="addcourse.php" class="btn">Add New Course</a>

        <!-- Courses List -->
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Course Name</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row["courseid"]; ?></td>
                    <td><?php echo $row["coursename"]; ?></td>
                    <td>
                        <a href="managecourses.php?delete=<?php echo $row['courseid']; ?>" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <br><a href="managestudents.php">Back to Dashboard</a>
    </div>
   
</body>
</html>
