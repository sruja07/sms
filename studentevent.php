<?php
include 'dbconfig.php';

// Fetch events added by teachers
$result = $conn->query("SELECT * FROM event ORDER BY eventdate DESC");
$events = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Events</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <h1>Upcoming Events</h1>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <h3> Events</h3>
    <table border="1">
        <tr>
            <th>Event ID</th>
            <th>Event Name</th>
            <th>Event Date</th>
            <th>Description</th>
        </tr>
        <?php foreach ($events as $event): ?>
        <tr>
            <td><?= htmlspecialchars($event['eventid']); ?></td>
            <td><?= htmlspecialchars($event['eventname']); ?></td>
            <td><?= htmlspecialchars($event['eventdate']); ?></td>
            <td><?= htmlspecialchars($event['description']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
