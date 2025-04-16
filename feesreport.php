<?php
session_start();
include('dbconnect.php');

if (!isset($_SESSION["studentid"])) {
    echo "<script>alert('You must log in first!'); window.location.href='login.php';</script>";
    exit();
}

$studentid = $_SESSION["studentid"];

// Fetch the total fees for the student
$query = "SELECT amount FROM fees WHERE studentid = ? LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $studentid);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$total_fees = $row ? floatval($row['amount']) : 0; // Default to 0 if no record found

// Fetch total fees paid by the student (SUM of Feespaid)
$query2 = "SELECT SUM(Feespaid) AS total_paid FROM fees WHERE studentid = ?";
$stmt2 = $conn->prepare($query2);
$stmt2->bind_param("s", $studentid);
$stmt2->execute();
$result2 = $stmt2->get_result();
$row2 = $result2->fetch_assoc();
$amount_paid = $row2 && $row2['total_paid'] !== null ? floatval($row2['total_paid']) : 0; // Default to 0 if no record found

$balance = $total_fees - $amount_paid; // Calculate remaining balance
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fees Report</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="navbar">
        <ul>
            <h1>Fees Details</h1>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="dashboard-container">
        <h2>Fee Payment Report for Student ID: <?php echo htmlspecialchars($studentid); ?></h2>
    </div>

    <table border="1">
        <tr>
            <th>Total Fees</th>
            <th>Amount Paid</th>
            <th>Remaining Balance</th>
            <th>Status</th>
        </tr>

        <?php if ($amount_paid == 0) { ?>
            <tr>
                <td colspan="4" style="text-align: center; color: red; font-weight: bold;">
                    No payments made yet. Please make the payment to avoid penalties.
                </td>
            </tr>
        <?php } else { ?>
            <tr>
                <td><?php echo number_format($total_fees, 2); ?></td>
                <td><?php echo number_format($amount_paid, 2); ?></td>
                <td><?php echo number_format($balance, 2); ?></td>
                <td>
                    <?php
                    if ($balance <= 0) {
                        echo "<span style='color:green; font-weight:bold;'>Fully Paid</span>";
                    } else {
                        echo "<span style='color:red; font-weight:bold;'>Pending Payment</span>";
                    }
                    ?>
                </td>
            </tr>
        <?php } ?>
    </table>

</body>
</html>

<?php
$stmt->close();
$stmt2->close();
$conn->close();
?>
