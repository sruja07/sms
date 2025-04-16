<?php
include 'dbconfig.php';

// Add new event
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_event'])) {
    $eventname = $_POST['eventname'];
    $eventdate = $_POST['eventdate'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO event (eventname, eventdate, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $eventname, $eventdate, $description);
    $stmt->execute();
    $stmt->close();

    // Redirect to prevent form resubmission
    header("Location: event.php");
    exit();
}

// Delete event
if (isset($_GET['delete'])) {
    $eventid = $_GET['delete'];
    $query = "DELETE FROM event WHERE eventid = ?"; // Corrected table name
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $eventid);

    if ($stmt->execute()) {
        // Redirect after deletion
        header("Location: event.php");
        exit();
    } else {
        echo "Error deleting record.";
    }
}

// Fetch events
$stmt = $conn->query("SELECT * FROM event ORDER BY eventdate DESC");
$events = [];
while ($row = $stmt->fetch_assoc()) {
    $events[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <h1>Manage Events</h1>
        <ul>
            <li><a href="teacherdashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
   
    <form method="POST">
        <input type="text" name="eventname" placeholder="Event Name" required>
        <input type="date" name="eventdate" required>
        <input type="text" name="description" placeholder="Description" required>
        <button type="submit" name="add_event">Add Event</button>
    </form>

    <h3>Event List</h3>
    <table border="1">
        <tr>
            <th>Event ID</th>
            <th>Event Name</th>
            <th>Event Date</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        <?php foreach ($events as $event): ?>
        <tr>
            <td><?= htmlspecialchars($event['eventid']); ?></td>
            <td><?= htmlspecialchars($event['eventname']); ?></td>
            <td><?= htmlspecialchars($event['eventdate']); ?></td>
            <td><?= htmlspecialchars($event['description']); ?></td>
            <td>
               <a href="event.php?delete=<?= htmlspecialchars($event['eventid']); ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
