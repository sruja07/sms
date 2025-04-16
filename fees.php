<?php
include('dbconnect.php');

if (isset($_POST['submit'])) {
    $studentid = $_POST['studentid'];
    $total_fees = $_POST['total_fees'];
    $amount_paid = $_POST['amount_paid'];
    $date = date('Y-m-d'); // Current date

    // Calculate the remaining balance
    $query = "SELECT SUM(Feespaid) AS total_paid FROM fees WHERE studentid = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $studentid);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    $previously_paid = ($row['total_paid']) ? $row['total_paid'] : 0;
    $new_total_paid = $previously_paid + $amount_paid;
    $remaining_balance = $total_fees - $new_total_paid;

    // Insert payment details into the database
    $sql = "INSERT INTO fees (studentid, amount, date, Feespaid) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisi", $studentid, $total_fees, $date, $amount_paid);

    if ($stmt->execute()) {
        echo "<script>alert('Payment recorded successfully! Remaining balance: $remaining_balance');</script>";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fee Collection</title>
    <link rel="stylesheet" href="style.css">
</head>
<div class="navbar">
        <h1>Fee payment</h1>
        <ul>
            <li><a href="teacherdashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
<body>
    <h2>Student Fees Portal</h2>
    <form method="post" action="">
        <label>Student ID:</label>
        <input type="text" name="studentid" required><br><br>

        <label>Total Fees:</label>
        <input type="number" name="total_fees" required><br><br>

        <label>Amount Paid:</label>
        <input type="number" name="amount_paid" required><br><br>

        <button type="submit" name="submit">Submit Payment</button>
    </form>
</body>
</html>
