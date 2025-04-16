<?php
session_start();
if (!isset($_SESSION["teacher_name"])) {  
    header("Location: teacherlogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <h1>Teacher Dashboard</h1>
        <ul>
            <li><a href="teacherdashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="dashboard-menu">
        <a href="attendance.php">Mark Attendance</a>
     
        <a href="addsubject.php">Manage Subjects</a>
        <a href="event.php">Manage Events</a>
        <a href="fees.php">Student Fees</a>
        <a href="report.php">Generate Reports</a>
    </div>
    
    <div class="dashboard-container">
    <h2>Welcome, Respected Teacher!</h2>
    <p>Please select an option above to manage your academic responsibilities.</p>
</div>

</div>


    
</body>
</html>
