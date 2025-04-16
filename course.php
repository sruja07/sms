<?php
include 'dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Module</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <div class="navbar">
        <h1>Course Module</h1>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    
    <h3>Course List</h3>
    
    <?php
    // Fetch & Display Courses
    $query = "SELECT * FROM course";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<table>
                <tr>
                    <th>Course ID</th>
                    <th>Course Name</th>
                </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['courseid']}</td>
                    <td>{$row['coursename']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No courses available.</p>";
    }
    ?>

</body>
</html>

<?php mysqli_close($conn); ?>
