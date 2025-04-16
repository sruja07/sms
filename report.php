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

// Fetch subjects for the dropdown
$subjectQuery = "SELECT subjectid, subjectname FROM subject";
$subjectResult = mysqli_query($conn, $subjectQuery);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentid = $_POST["studentid"];
    $subjectid = $_POST["subjectid"];
    $marks = $_POST["marks"];
    $grade = $_POST["grade"];

    // Get subject name from subjectid
    $subjectNameQuery = "SELECT subjectname FROM subject WHERE subjectid = '$subjectid'";
    $subjectNameResult = mysqli_query($conn, $subjectNameQuery);
    $row = mysqli_fetch_assoc($subjectNameResult);
    $subjectname = $row['subjectname'];

    $sql = "INSERT INTO report (studentid, subjectid, subjectname, grade, marks)
            VALUES ('$studentid', '$subjectid', '$subjectname', '$grade', '$marks')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Marks added successfully!'); window.location.href='report.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enter Marks - SMS</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="navbar">
        <h1>Progress Report</h1>
        <ul>
            <li><a href="teacherdashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <h2>Enter Student Marks</h2>
    <form action="" method="POST">
        <label for="studentid">Student ID:</label>
        <input type="text" name="studentid" required>

        <label for="subjectid">Select Subject:</label>
        <select name="subjectid" required>
            <option value="">Select Subject</option>
            <?php
            if (mysqli_num_rows($subjectResult) > 0) {
                while ($row = mysqli_fetch_assoc($subjectResult)) {
                    echo "<option value='" . $row['subjectid'] . "'>" . $row['subjectname'] . "</option>";
                }
            }
            ?>
        </select>

        <label for="marks">Marks:</label>
        <input type="number" name="marks" required>

        <label for="grade">Grade:</label>
        <input type="text" name="grade" required>

        <input type="submit" name="submit" value="Save Marks">
    </form>
</body>
</html>
