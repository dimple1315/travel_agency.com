<?php
session_start(); // Start session to manage user login state

// Include the file with your database connection details
include 'connect.php';

$error = ""; // Initialize error variable

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['LPassword'];

    // Prepare SQL statement to fetch user from database
    $sql = "SELECT * FROM `admin` WHERE Username = ? AND LPassword = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if($result->num_rows == 1) {
        // User exists, set session variables and redirect to homepage
        $_SESSION['username'] = $username;
        header('location: home.php'); // Change 'home.php' to your homepage
        exit();
    } else {
        // Set error message
        $error = "Invalid username or password";
        // JavaScript to show popup
        echo "<script>alert('$error');</script>";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <h1>TRAVEL AGENCY</h1>
    <p><span class="caption">TRAVEL</span> With No Regrets...</p>
    <form method="post" action="login.php" class="login-form">
        <h3>Login Here</h3>
        <label for="username">Username</label>
        <input type="text" placeholder="Email or Phone" id="username" name="username">
        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="LPassword">
        <button type="submit" class="btn-primary" name="submit">Log In</button>
    </form>
</body>
</html>
