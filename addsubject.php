<?php
include 'dbconfig.php';

// Add subject
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_subject'])) {
    $subjectname = trim($_POST['subjectname']);

    if (!empty($subjectname)) {
        // Check if subject already exists
        $check_query = $conn->prepare("SELECT * FROM subject WHERE subjectname = ?");
        $check_query->bind_param("s", $subjectname);
        $check_query->execute();
        $result = $check_query->get_result();

        if ($result->num_rows > 0) {
            echo "<script>alert('Subject already exists!');</script>";
        } else {
            // Insert new subject
            $stmt = $conn->prepare("INSERT INTO subject (subjectname) VALUES (?)");
            $stmt->bind_param("s", $subjectname);
            if ($stmt->execute()) {
                echo "<script>alert('Subject added successfully!'); window.location.href='addsubject.php';</script>";
                exit();
            } else {
                echo "<script>alert('Error adding subject.');</script>";
            }
            $stmt->close();
        }
        $check_query->close();
    } else {
        echo "<script>alert('Please enter a subject name.');</script>";
    }
}

// Fetch subjects
$query = "SELECT * FROM subject ORDER BY subjectid DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Subjects</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <h1>Manage Subjects</h1>
        <ul>
            <li><a href="teacherdashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="container">
        <h2>Add Subject</h2>
        <form method="POST">
            <input type="text" name="subjectname" placeholder="Enter Subject Name" required>
            <button type="submit" name="add_subject">Add Subject</button>
        </form>

        <h3>Subject List</h3>
        <table border="1">
            <tr>
                <th>Subject ID</th>
                <th>Subject Name</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['subjectid']); ?></td>
                <td><?= htmlspecialchars($row['subjectname']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
