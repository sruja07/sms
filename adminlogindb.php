<?php
session_start();
include("dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Fetch admin details securely
    $sql = "SELECT * FROM admin WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Direct comparison (No Hashing)
        if ($password === $row["password"]) { 
            $_SESSION["username"] = $row["username"];
            header("Location: managestudents.php");
            exit();
        } else {
            header("Location: adminlogin.php?error=Invalid password");
            exit();
        }
    } else {
        header("Location: adminlogin.php?error=User not found");
        exit();
    }

    $stmt->close();
}
$conn->close();
?>
