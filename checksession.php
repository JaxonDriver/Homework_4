<?php
session_start();

// check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: loginformw.php");
    exit();
}

// connect to database
require_once 'loginw.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

// get user's role
$username = $_SESSION['username'];
$query = "SELECT role_name FROM users JOIN roles ON users.role_id = roles.id WHERE username='$username'";
$result = $conn->query($query);
if (!$result) die($conn->error);
$row = $result->fetch_array(MYSQLI_ASSOC);
$role = $row['role_name'];

// check if user has appropriate role for this page
if ($role !== 'admin' && basename($_SERVER['PHP_SELF']) !== 'user-list.php') {
    header("Location: unauthorized.php");
    exit();
}
?>
