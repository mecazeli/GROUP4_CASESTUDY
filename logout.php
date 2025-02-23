<?php
session_start();

// Check if the user confirmed logout
if (isset($_POST['confirm_logout'])) {
    // Destroy the session and redirect to login page
    session_destroy();
    echo '<script>
    alert("Log Out Successfully!");
    setTimeout(function() { window.location.href = "login.php"; }, 2000);
  </script>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Logout</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            margin: 0;
        }
        .modal-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }
        #logoutModal {
            display: flex; 
        }
        #secondLogoutModal {
            display: none;
        }
        .modal {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .modal button {
            margin: 10px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
    </style>
</head>
<body>
    <!-- First Logout Confirmation Modal -->
    <div class="modal-container" id="logoutModal">
        <div class="modal">
            <h3>Confirm Logout</h3>
            <p>Are you sure you want to log out?</p>
            <button class="btn-secondary" onclick="closeModal('logoutModal')">Cancel</button>
            <button class="btn-danger" onclick="openModal('secondLogoutModal')">Yes, Log Out</button>
        </div>
    </div>

    <!-- Second Assurance Logout Modal -->
    <div class="modal-container" id="secondLogoutModal">
        <div class="modal">
            <h3> Confirmation</h3>
            <p>Are you absolutely sure you want to log out?</p>
            <button class="btn-secondary" onclick="closeModal('secondLogoutModal')">Cancel</button>
            <form method="POST" style="display: inline;">
                <button type="submit" name="confirm_logout" class="btn-danger">Yes, Log Me Out</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).style.display = "flex";
        }
        function closeModal(id) {
            document.getElementById(id).style.display = "none";
        }
    </script>
</body>
</html>
