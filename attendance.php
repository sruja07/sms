<?php
session_start();
include "dbconnect.php";

$message = ""; // Initialize message variable

// Determine active tab
$active_tab = 'mark';
if ($_SERVER["REQUEST_METHOD"] == "GET" && (isset($_GET["studentid"]) || isset($_GET["date"]))) {
    $active_tab = 'report';
}

// Handle Attendance Submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_attendance"])) {
    $studentid = mysqli_real_escape_string($conn, $_POST["studentid"]);
    $date      = date("Y-m-d");
    $status    = mysqli_real_escape_string($conn, $_POST["status"]);

    // Check if attendance already exists for the student on the same date
    $check_sql = "SELECT * FROM attendance WHERE studentid = '$studentid' AND date = '$date'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        $message = "⚠ Attendance already marked for this student today!";
    } else {
        // Insert attendance if not already marked
        $sql = "INSERT INTO attendance (studentid, date, status) VALUES ('$studentid', '$date', '$status')";
        if (mysqli_query($conn, $sql)) {
            $message = "✅ Attendance marked successfully!";
        } else {
            $message = "❌ Error: " . mysqli_error($conn);
        }
    }
}

// Fetch Attendance Records for Viewing
$attendance_records = mysqli_query($conn, "SELECT * FROM attendance ORDER BY date DESC");

// Handle Attendance Report Generation
$report_result = null;
if ($_SERVER["REQUEST_METHOD"] == "GET" && (isset($_GET["studentid"]) || isset($_GET["date"]))) {
    $query = "SELECT * FROM attendance WHERE 1=1";

    if (!empty($_GET["studentid"])) {
        $studentid = mysqli_real_escape_string($conn, $_GET["studentid"]);
        $query .= " AND studentid = '$studentid'";
    }

    if (!empty($_GET["date"])) {
        $date = mysqli_real_escape_string($conn, $_GET["date"]);
        $query .= " AND date = '$date'";
    }

    $report_result = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="navbar">
        <h1>Attendance Section</h1>
        <ul>
            <li><a href="teacherdashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="attendance-container">
        <div class="tabs">
            <button class="tablink <?php echo $active_tab === 'mark' ? 'active' : ''; ?>" onclick="openTab(event, 'mark')">Mark Attendance</button>
            <button class="tablink <?php echo $active_tab === 'view' ? 'active' : ''; ?>" onclick="openTab(event, 'view')">View Attendance</button>
            <button class="tablink <?php echo $active_tab === 'report' ? 'active' : ''; ?>" onclick="openTab(event, 'report')">Attendance Report</button>
        </div>

        <div id="mark" class="tabcontent" style="<?php echo $active_tab === 'mark' ? '' : 'display:none;'; ?>">
            <h2>Mark Attendance</h2>
            <?php if (!empty($message)) echo "<p style='color: green;'>$message</p>"; ?>
            <form action="attendance.php" method="POST">
                <label for="studentid">Student ID:</label>
                <input type="text" name="studentid" required>
                <label for="status">Status:</label>
                <select name="status">
                    <option value="Present">Present</option>
                    <option value="Absent">Absent</option>
                </select>
                <button type="submit" name="submit_attendance">Submit</button>
            </form>
        </div>

        <div id="view" class="tabcontent" style="<?php echo $active_tab === 'view' ? '' : 'display:none;'; ?>">
            <h2>View Attendance</h2>
            <table border="1">
                <tr>
                    <th>Attendance ID</th>
                    <th>Student ID</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($attendance_records)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['attendanceid']); ?></td>
                        <td><?php echo htmlspecialchars($row['studentid']); ?></td>
                        <td><?php echo htmlspecialchars($row['date']); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <div id="report" class="tabcontent" style="<?php echo $active_tab === 'report' ? '' : 'display:none;'; ?>">
            <h2>Attendance Report</h2>
            <form action="attendance.php" method="GET">
                <label for="studentid">Student ID:</label>
                <input type="text" name="studentid">
                <label for="date">Date:</label>
                <input type="date" name="date">
                <button type="submit">Generate Report</button>
            </form>

            <?php if ($report_result && mysqli_num_rows($report_result) > 0): ?>
                <h3>Report Results:</h3>
                <table border="1">
                    <tr>
                        <th>Attendance ID</th>
                        <th>Student ID</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($report_result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['attendanceid']); ?></td>
                            <td><?php echo htmlspecialchars($row['studentid']); ?></td>
                            <td><?php echo htmlspecialchars($row['date']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>No attendance records found.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.classList.add("active");
        }
    </script>

</body>
</html>
