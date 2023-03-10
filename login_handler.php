<?php
session_start();

// retrieve inputs from form
$username = $_POST['username'];
$password = $_POST['password'];

// sanitize inputs
$username = mysqli_real_escape_string($conn, $username);

// query database for user with matching username
$query = "SELECT * FROM Users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

// verify password
if (mysqli_num_rows($result) == 1) {
  $row = mysqli_fetch_assoc($result);
  if (password_verify($password, $row['password'])) {
    // add user object to session
    $_SESSION['user'] = $row;
    header("Location: user_list.php");
    exit();
  }
}

// if authentication fails, redirect to login page
header("Location: login.php");
exit();
?>
