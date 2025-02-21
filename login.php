<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prepared statement to check credentials in Admin table.
    $stmt = $conn->prepare("SELECT * FROM Admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        // If credentials are invalid, display an alert and reload the page.
        echo "<script>alert('Invalid username or password.'); window.location.href='login.php';</script>";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MetroMed Clinic Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
         <div class="login-info">
             <div class="logo">
                <img src="images/logo.png" alt="MetroMed Clinic">
                <h2>MetroMed Clinic</h2>
             </div>
         </div>
 
        <div class="intro-login">
           <h2>Welcome Back</h2>
           <h3>SIGN IN</h3>
        </div>

        <form id="loginForm" method="POST" action="login.php">
            <label class="username-label" for="username">Username</label>
            <input class="username-input" type="text" id="username" name="username" placeholder="Enter your username" required>
            
            <label class="password-label" for="password">Password</label>
            <input class="password-input" type="password" id="password" name="password" placeholder="Enter your password" required>
            
            <button class="sign-in-button" type="submit">SIGN IN</button>
        </form>

         <div class="login-image">
             <img src="images/clinic.png" class="login-picture" alt="Clinic Image">
         </div>
    </div>
</body>
</html>
