<?php
session_start();
if (!isset($_SESSION["studentid"])) {  
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <h1>Student Dashboard</h1>
        <ul>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

   
    <div class="dashboard-menu">
        
        
        <a href="course.php">View Courses</a>
        <a href="subject.php">Subject</a>
        <a href="studentevent.php">Upcoming Events</a>
        <a href="feesreport.php">Fees</a>
        <a href="progessreport.php">Generate Reports</a>
    </div>

    <div class="dashboard-container">
        <h2>Welcome, <?php echo isset($_SESSION["name"]) ? htmlspecialchars($_SESSION["name"]) : "Student"; ?>!</h2>
        <p>Select an option above.</p>
        
    </div>
</body>
</html>
