<?php 
   $host = 'localhost';
   $username = 'root';
   $password = 'liezel11';
   $database = 'MetroMedClinic';

   $conn = new mysqli($host,$username,$password,$database);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Add Patient</title>
  <link rel="stylesheet" href="css/addPatient.css">
</head>
<body>

<!-- MAIN CONTAINER -->
<div class="container">
  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="logo">
        <img src="images/logo.png" alt="MetroMed Clinic">
        <h2>MetroMed Clinic</h2>
    </div>
    <!-- LIST OF MENUS -->
    <ul class="sub-menu">
       <li><a href="#"><i class="fa-solid fa-house"></i>DASHBOARD</a></li>
       <li><a href="#"><i class="fa-solid fa-hospital-user"></i>PATIENTS</a></li>
       <li><a href="#"><i class="fa-solid fa-book"></i>SOAP NOTES</a></li>
       <li><a href="#"><i class="fa-solid fa-calendar-check"></i>APPOINTMENTS</a></li>
       <li><a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i>LOG OUT</a></li>
    </ul>
  </aside>

  <!-- HEADERS AND MAIN CONTENT -->
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
          <h1>ADD PATIENT</h1>

          <!-- Updated form -->
          <form action="" method="post">
            <div class="row">
              <div class="input-group">
                <label for="first-name">First Name:</label>
                <input type="text" id="first-name" name="firstName" placeholder="Enter First Name" required>
              </div>
              <div class="input-group">
                <label for="last-name">Last Name:</label>
                <input type="text" id="last-name" name="lastName" placeholder="Enter Last Name" required>
              </div>
            </div>

            <div class="row">
              <div class="input-group">
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" placeholder="Enter Age" required>
              </div>
              <div class="input-group">
                <label for="birthdate">Birthdate:</label>
                <input type="date" name="dateOfBirth" required>
              </div>
              <div class="gender-box">
                <label>Gender:</label>
                <select id="gender" name="gender" required>
                  <option value="" disabled selected>Select Gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                  <option value="Other">Other</option>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="input-group">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phoneNumber" placeholder="Enter Phone Number" required>
              </div>
            </div>

            <div class="row">
              <div class="input-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" placeholder="Enter Address" required>
              </div>
            </div>

            <button type="submit" name="save" class="save-btn" >
              <span class="material-symbols-outlined">save</span>
              <label>SAVE</label>
            </button> 

          </form>
        </div>

        <?php 
   if (isset($_POST['save'])) {
    $firstName = isset($_POST['firstName']) ? mysqli_real_escape_string($conn, trim($_POST['firstName'])) : '';
    $lastName = isset($_POST['lastName']) ? mysqli_real_escape_string($conn, trim($_POST['lastName'])) : '';
    $age = isset($_POST['age']) ? intval($_POST['age']) : 0;
    $dateOfBirth = isset($_POST['dateOfBirth']) && !empty(trim($_POST['dateOfBirth'])) ? mysqli_real_escape_string($conn, trim($_POST['dateOfBirth'])) : null;
    $gender = isset($_POST['gender']) ? mysqli_real_escape_string($conn, trim($_POST['gender'])) : '';
    $phoneNumber = isset($_POST['phoneNumber']) ? mysqli_real_escape_string($conn, trim($_POST['phoneNumber'])) : '';
    $address = isset($_POST['address']) ? mysqli_real_escape_string($conn, trim($_POST['address'])) : '';
    $registrationDate = date('Y-m-d'); // Current date

    if (is_null($dateOfBirth)) {
        echo '<script>alert("Date of Birth is required!");</script>';
      } elseif (!preg_match("/^09\d{9}$/", $phoneNumber)) {
        echo '<script>alert("Invalid phone number! It must start with 09 and be 11 digits long.");</script>';
    } else {
        $stmt = $conn->prepare("INSERT INTO Patients (firstName, lastName, age, dateOfBirth, gender, phoneNumber, address, registrationDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisssss", $firstName, $lastName, $age, $dateOfBirth, $gender, $phoneNumber, $address, $registrationDate);
        
        if ($stmt->execute()) {
            echo '<script>
                    alert("Patient added successfully!");
                    setTimeout(function() { window.location.href = "patientinfo.php"; }, 2000);
                  </script>';
            exit();
        } else {
            echo '<script>alert("Error: ' . $stmt->error . '");</script>';
        }
        
        $stmt->close();
    }
}

  
      ?>
        

      </section>
    </header>
  </main>
</div>

<script src="https://kit.fontawesome.com/b6f472161d.js" crossorigin="anonymous"></script>
</body>
</html>
