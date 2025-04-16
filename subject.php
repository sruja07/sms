<?php
session_start();
include "dbconnect.php";

// Fetch All Subjects
$subjects = mysqli_query($conn, "SELECT * FROM subject");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subjects</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   

    <div class="navbar">
        <h1>Subjects</h1>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="container">
        <h2>Available Subjects</h2>
        <table border="1">
            <tr>
                <th>Subject ID</th>
                <th>Subject Name</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($subjects)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['subjectid']); ?></td>
                    <td><?php echo htmlspecialchars($row['subjectname']); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

</body>
</html>
