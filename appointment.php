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
    <title>Appointment</title>
    <link rel="stylesheet" href="css/appointment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
</head>
<body>

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
           <li><a href="SoapNotesView.php"><i class="fa-solid fa-book"></i></i>SOAP NOTES</a></li>
           <li><a href="#"><i class="fa-solid fa-calendar-check"></i></i>APPOINTMENTS</a></li>
           <li><a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i>LOG OUT</a></li>
        </ul>
      </aside>
       <!-- HEADERS  AND MAIN CONTENT -->
       <main class="main-content">
        <header class="header">
          <div class="search-container">
              <input type="text" placeholder="Search" class="search-box">
          </div>
          <div class="profile">
              <span>AD</span>
          </div>
      </header>
          
      <div class="appointments-container">
    <h2>APPOINTMENTS</h2>
    <div class="appointments-table">
        <div class="table-header">
            <p>Id</p>
            <p>Patient Name</p>
            <p>Age</p>
            <p>Contact Number</p>
            <p>Appointment Date</p>
            <p>Status</p>
        </div>
        
        <div class="table-row">
            <div class="row-item"></div>
            <div class="row-item"></div>
            <div class="row-item"></div>
            <div class="row-item"></div>
            <div class="row-item"></div>
            <button class="edit-btn"><i class="fa-solid fa-pen"></i> Edit</button>
        </div>

        <div class="table-row">
            <div class="row-item"></div>
            <div class="row-item"></div>
            <div class="row-item"></div>
            <div class="row-item"></div>
            <div class="row-item"></div>
            <button class="edit-btn"><i class="fa-solid fa-pen"></i> Edit</button>
        </div>

        <div class="table-row">
            <div class="row-item"></div>
            <div class="row-item"></div>
            <div class="row-item"></div>
            <div class="row-item"></div>
            <div class="row-item"></div>
            <button class="edit-btn"><i class="fa-solid fa-pen"></i> Edit</button>
        </div>
        
        <div class="table-row">
            <div class="row-item"></div>
            <div class="row-item"></div>
            <div class="row-item"></div>
            <div class="row-item"></div>
            <div class="row-item"></div>
            <button class="edit-btn"><i class="fa-solid fa-pen"></i> Edit</button>
        </div>

        <div class="table-row">
            <div class="row-item"></div>
            <div class="row-item"></div>
            <div class="row-item"></div>
            <div class="row-item"></div>
            <div class="row-item"></div>
            <button class="edit-btn"><i class="fa-solid fa-pen"></i> Edit</button>
        </div>
        
    </div>
    </div>
       </main>
    </div>
    <script src="https://kit.fontawesome.com/b6f472161d.js" crossorigin="anonymous"></script>

</body>
</html>  