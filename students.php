<?php
include 'dbconfig.php';

// Add new student
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_student'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $courseid = $_POST['courseid']; 

    $stmt = $conn->prepare("INSERT INTO student (name, email, password, courseid) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $name, $email, $password, $courseid);
    $stmt->execute();
}

// Fetch students
$stmt = $conn->query("SELECT * FROM student");
$students = [];
while ($row = $stmt->fetch_assoc()) {
    $students[] = $row;
}

// Delete student
if (isset($_GET['delete'])) {
    $studentid = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM student WHERE studentid = ?");
    $stmt->bind_param("s", $studentid);
    $stmt->execute();
    header("Location: students.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Manage Students</h2>

    <form method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="courseid" placeholder="Course ID" required>
        <button type="submit" name="add_student">Add Student</button>
    </form>

    <h3>Student List</h3>
    <table border="1">
        <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Course ID</th>
            <th>Action</th>
        </tr>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?= $student['studentid']; ?></td>
            <td><?= $student['name']; ?></td>
            <td><?= $student['email']; ?></td>
            <td><?= $student['courseid']; ?></td>
            <td>
                <a href="students.php?delete=<?= $student['studentid']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
