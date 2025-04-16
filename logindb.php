<?php
session_start();
include("dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentid = trim($_POST["studentid"]);
    $password = trim($_POST["password"]);

    if (empty($studentid) || empty($password)) {
        echo "<script>alert('Please enter both Student ID and Password.'); window.location.href='login.php';</script>";
        exit();
    }

    // Prepare SQL query to prevent SQL injection
    $sql = "SELECT studentid, name, password FROM student WHERE studentid = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $studentid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        // Verify the hashed password
        if (password_verify($password, $row["password"])) {
            $_SESSION["studentid"] = $row["studentid"];
            $_SESSION["name"] = $row["name"];
            
            // Redirect to dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Invalid password. Please try again.'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Student ID not found. Please check your credentials.'); window.location.href='login.php';</script>";
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();
?>
