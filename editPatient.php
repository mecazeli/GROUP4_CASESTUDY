<?php
session_start(); 

$servername = "localhost";
$username = "root"; 
$password = "liezel11";
$database = "MetroMedClinic"; 

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$patientId = $_GET['patientsId'] ?? ''; 
$patient = [];

if ($patientId) {
    $stmt = $conn->prepare("SELECT * FROM Patients WHERE patientsId = ?");
    $stmt->bind_param("i", $patientId);
    $stmt->execute();
    $result = $stmt->get_result();
    $patient = $result->fetch_assoc();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $age = $_POST['age'];
    $dateOfBirth = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $phoneNumber = $_POST['phone'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("UPDATE Patients SET firstName=?, lastName=?, age=?, dateOfBirth=?, gender=?, phoneNumber=?, address=? WHERE patientsId=?");
    $stmt->bind_param("ssissssi", $firstName, $lastName, $age, $dateOfBirth, $gender, $phoneNumber, $address, $patientId);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Patient updated successfully!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Update failed!";
        $_SESSION['message_type'] = "error";
    }

    header("Location: editPatient.php?patientsId=$patientId"); // Refresh page to show modal
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/editPatient.css">
    <title>Edit Patient</title>

 
       <style>
     .modal {
    display: none; 
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    align-items: center;
    justify-content: center;
}

.modal-content {
    background: white;
    padding: 20px;
    width: 300px;
    text-align: center;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    
}

#closeModalBtn {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 18px;
    cursor: pointer;
    border-radius: 5px;
    margin-top: 10px;
}

#closeModalBtn:hover {
    background-color: #45a049;
}
    </style>

</head>
<!-- MAIN CONTAINER -->
<div class="container">
      <!-- SIDEBAR  -->
      <aside class="sidebar">
        <div class="logo">
            <img src="images/logo.png" alt="MetroMed Clinic">
            <h2>MetroMed Clinic</h2>
        </div>
         <!-- LIST OF MENUS -->
        <ul class="sub-menu">
           <li><a href="dashboard.php"><i class="fa-solid fa-house"></i>DASHBOARD</a></li>
           <li><a href="patientinfo.php"><i class="fa-solid fa-hospital-user"></i></i>PATIENTS</a></li>
           <li><a href="SoapNotes.php"><i class="fa-solid fa-book"></i></i>SOAP NOTES</a></li>
           <li><a href="appointment.php"><i class="fa-solid fa-calendar-check"></i></i>APPOINTMENTS</a></li>
           <li><a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>LOG OUT</a></li>
        </ul>
      </aside>
       <!-- HEADERS  AND MAIN CONTENT -->
       <main class="main-content">
        <header class="header">
        <div class="left-section">
        <form action="patientinfo.php" method="post">
          <button type="submit" class="back">
            <span class="material-symbols-outlined">arrow_back_ios</span>
          </button>
        </form>
        <p>RETURN</p>
      </div>

          <div class="search-container">
              <input type="text" placeholder="Search" class="search-box">
          </div>
          <div class="profile">
              <span>AD</span>
          </div>

            <section>
                <div class="content">
                    <h1>EDIT PATIENT</h1>
                    <form method="POST">
                        <div class="row">
                            <div class="input-group">
                                <label for="first-name">First Name:</label>
                                <input type="text" name="first-name" id="first-name" value="<?= $patient['firstName'] ?? '' ?>" required>
                            </div>
                            <div class="input-group">
                                <label for="last-name">Last Name:</label>
                                <input type="text" name="last-name" id="last-name" value="<?= $patient['lastName'] ?? '' ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group">
                                <label for="age">Age:</label>
                                <input type="text" name="age" id="age" value="<?= $patient['age'] ?? '' ?>" required>
                            </div>
                            <div class="input-group">
                                <label for="birthdate">Birthdate:</label>
                                <input type="date" name="birthdate" id="birthdate" value="<?= $patient['dateOfBirth'] ?? '' ?>" required>
                            </div>
                            <div class="gender-box">
                                <label>Gender:</label>
                                <select name="gender" id="gender" required>
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="Male" <?= ($patient['gender'] ?? '') == 'Male' ? 'selected' : '' ?>>Male</option>
                                    <option value="Female" <?= ($patient['gender'] ?? '') == 'Female' ? 'selected' : '' ?>>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group">
                                <label for="phone">Phone Number:</label>
                                <input type="text" name="phone" id="phone" value="<?= $patient['phoneNumber'] ?? '' ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group">
                                <label for="address">Address:</label>
                                <input type="text" name="address" id="address" value="<?= $patient['address'] ?? '' ?>" required>
                            </div>
                        </div>
                        <button type="submit" name="save" class="save-btn" >
                          <span class="material-symbols-outlined">save</span>
                          <label>SAVE</label>
                       </button> 
                    </form>
                </div>
            </section>
        </main>
    </div>

    <!-- Modal -->
    <div id="messageModal" class="modal">
    <div class="modal-content">
        <p id="modalMessage"></p>
        <button id="closeModalBtn">OK</button>
    </div>
</div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById("messageModal");
        const closeModalBtn = document.getElementById("closeModalBtn");
        const modalMessage = document.getElementById("modalMessage");

        <?php if (isset($_SESSION['message'])): ?>
            modalMessage.textContent = "<?= $_SESSION['message'] ?>";
            modal.style.display = "flex";

            setTimeout(function () {
                window.location.href = "patientinfo.php";
            }, 2000);

            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        closeModalBtn.addEventListener("click", function () {
            modal.style.display = "none";
            window.location.href = "patientinfo.php";
        });

        window.onclick = function (event) {
            if (event.target === modal) {
                modal.style.display = "none";
                window.location.href = "patientinfo.php";
            }
        };
    });
    </script>


    <script src="https://kit.fontawesome.com/b6f472161d.js" crossorigin="anonymous"></script>
</body>
</html>
