<?php
session_start();
include "dbconnect.php";

// Check if admin is logged in
if (!isset($_SESSION["username"])) {
    header("Location: adminlogin.php");
    exit();
}

// Get Teacher ID
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $result = $conn->query("SELECT * FROM teachers WHERE id = $id");

    // Check if teacher exists
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('Teacher not found!'); window.location.href='manageteachers.php';</script>";
        exit();
    }
}

// Update Teacher
if (isset($_POST["update"])) {
    $name = $_POST["name"];
    $qualification = $_POST["qualification"];
    $subject = $_POST["subject"];

    $sql = "UPDATE teachers SET name='$name', qualification='$qualification', subject='$subject' WHERE id=$id";

    if ($conn->query($sql)) {
        echo "<script>alert('Teacher Updated Successfully!'); window.location.href='manageteachers.php';</script>";
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
    <title>Edit Teacher</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Teacher</h2>
        <form method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $row['name']; ?>" required>

            <label for="qualification">Qualification:</label>
            <input type="text" name="qualification" value="<?php echo $row['qualification']; ?>" required>

            <label for="subject">Subject:</label>
            <input type="text" name="subject" value="<?php echo $row['subject']; ?>" required>

            <button type="submit" name="update" class="btn">Update Teacher</button>
        </form>
        <br>
        <a href="manageteachers.php" class="btn">Back to Manage Teachers</a>
    </div>
</body>
</html>
