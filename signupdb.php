<?php
include("dbconnect.php");

// Retrieve form data safely
$studentid = trim($_POST['studentid']);
$courseid = trim($_POST['courseid']);
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$confirm_password = trim($_POST['confirm_password']);

// Check if passwords match
if ($password !== $confirm_password) {
    echo "<script>alert('Passwords do not match.'); window.location.href='signup.php';</script>";
    exit();
}

// Hash password before storing
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert data into the database
$sql = "INSERT INTO student (studentid, courseid, name, email, password) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $studentid, $courseid, $name, $email, $hashed_password);

if ($stmt->execute()) {
    echo "<script>alert('Registration successful. Please login.'); window.location.href='login.php';</script>";
} else {
    echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='signup.php';</script>";
}

// Close connections
$stmt->close();
$conn->close();
?>
