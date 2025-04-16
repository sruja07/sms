<?php
session_start();
include "dbconnect.php";

// Check if admin is logged in
if (!isset($_SESSION["username"])) {
    header("Location: adminlogin.php");
    exit();
}

// Delete Teacher
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $sql = "DELETE FROM teachers WHERE id = $id";
    if ($conn->query($sql)) {
        echo "<script>alert('Teacher Deleted!'); window.location.href='manageteachers.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

// Fetch Teachers
$result = $conn->query("SELECT * FROM teachers");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Teachers</title>
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
        <h2>Manage Teachers</h2>

        <!-- Add Teacher Button (Redirect to Add Teacher Page) -->
        <a href="addteacher.php" class="btn">Add New Teacher</a>

        <!-- Teachers List -->
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Qualification</th>
                <th>Subject</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["qualification"]; ?></td>
                    <td><?php echo $row["subject"]; ?></td>
                    <td>
    <a href="editteacher.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
    <a href="manageteachers.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
</td>

                </tr>
            <?php } ?>
        </table>

        <br><a href="managestudents.php">Back to Dashboard</a>
    </div>
    
</body>
</html>
