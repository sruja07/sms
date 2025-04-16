<?php
session_start();

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$database = "sms";

// Connect to MySQL
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the student is logged in
if (!isset($_SESSION['studentid'])) {
    header("Location: login.php");
    exit();
}

// Get student ID from session
$studentid = $_SESSION['studentid'];

// Fetch student details
$studentQuery = "SELECT name FROM student WHERE studentid = '$studentid'";
$studentResult = mysqli_query($conn, $studentQuery);
$studentRow = mysqli_fetch_assoc($studentResult);
$studentName = $studentRow['name'];

// Fetch student marks and grades
$reportQuery = "SELECT subjectname, marks, grade FROM report WHERE studentid = '$studentid'";
$reportResult = mysqli_query($conn, $reportQuery);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Progress Report - SMS</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <!-- Navbar -->
    <div class="navbar">
        <h1>Student Dashboard</h1>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Page Heading -->
    <h2>Progress Report for <?php echo $studentName; ?></h2>

    <!-- Report Table -->
    <div class="report-container">
        <table>
            <thead>
                <tr>
                    <th>Subject Name</th>
                    <th>Marks</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($reportResult) > 0) {
                    while ($row = mysqli_fetch_assoc($reportResult)) {
                        echo "<tr>";
                        echo "<td>" . $row['subjectname'] . "</td>";
                        echo "<td>" . $row['marks'] . "</td>";
                        echo "<td>" . $row['grade'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No marks available yet.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; <?php echo date("Y"); ?> Student Management System</p>
    </div>
</body>
</html>
