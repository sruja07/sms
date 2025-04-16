<?php
session_start();
include "dbconnect.php";

// Check if admin is logged in
if (!isset($_SESSION["username"])) {
    header("Location: adminlogin.php");
    exit();
}

// Delete student
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM student WHERE studentid = '$id'";

    if ($conn->query($sql)) {
        header("Location: managestudents.php?delete_success=1");
        exit();
    } else {
        echo "Error deleting student: " . $conn->error;
    }
}
?>
