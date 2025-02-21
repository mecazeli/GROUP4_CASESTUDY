<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MetroMed Clinic Login</title>
    <link rel="stylesheet" href="login.css">

</head>
<body>
<div class="container">
        <div class="login-info">
            <div class="logo">
                <img src="images/logo.png" alt="Logo">
                <h2>MetroMed Clinic</h2>
            </div>
            
            <div class="intro-login">
                <h2>Welcome Back!</h2>
                <h3>SIGN IN</h3>
            </div>
            <form id="loginForm">
                <label class="username-label" for="username">Username</label>
                <input class="username-input" type="text" id="username" name="username" placeholder="Enter your username" required>

                <label class="password-label" for="password">Password</label>
                <input class="password-input" type="password" id="password" name="password" placeholder="Enter your password" required>

                <button class="sign-in-button" type="submit">SIGN IN</button>
            </form>
        </div>
        <div class="login-image">
            <img class="login-picture" src="images/clinic.png" alt="Login Illustration">
        </div>
    </div>
</body>
</html>