<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Add Patient</title>
  <link rel="stylesheet" href="css/addPatient.css">
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
           <li><a href="#"><i class="fa-solid fa-house"></i>DASHBOARD</a></li>
           <li><a href="#"><i class="fa-solid fa-hospital-user"></i></i>PATIENTS</a></li>
           <li><a href="#"><i class="fa-solid fa-book"></i></i>SOAP NOTES</a></li>
           <li><a href="#"><i class="fa-solid fa-calendar-check"></i></i>APPOINTMENTS</a></li>
           <li><a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i>LOG OUT</a></li>
        </ul>
      </aside>
       <!-- HEADERS  AND MAIN CONTENT -->
       <main class="main-content">
        <header class="header">

            <div class="left-section">
                <button class="back">
                    <span class="material-symbols-outlined">arrow_back_ios</span>
                </button>
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
            
                    <!-- First Name & Last Name in one row -->
                    <div class="row">
                        <div class="input-group">
                            <label for="first-name">First Name:</label>
                            <input type="text" id="first-name" placeholder="Enter First Name">
                        </div>
                        <div class="input-group">
                            <label for="last-name">Last Name:</label>
                            <input type="text" id="last-name" placeholder="Enter Last Name">
                        </div>
                    </div>
            
                    <!-- Age, Birthdate, Gender in one row -->
                    <div class="row">
                        <div class="input-group">
                            <label for="age">Age:</label>
                            <input type="text" id="age" placeholder="Enter Age">
                        </div>
                        <div class="input-group">
                            <label for="birthdate">Birthdate:</label>
                            <input type="date" id="birthdate">
                        </div>
                        <div class="gender-box">
                            <label>Gender:</label>
                             <select id="gender">
                                 <option value="" disabled selected>Select Gender</option>
                                 <option value="Male">Male</option>
                                 <option value="Female">Female</option>
                                 <option value="Other">Other</option>
                             </select>
                        </div>
                        
                    </div>
            
                    <!-- Phone Number in one row -->
                    <div class="row">
                        <div class="input-group">
                            <label for="phone">Phone Number:</label>
                            <input type="text" id="phone" placeholder="Enter Phone Number">
                        </div>
                    </div>
            
                    <!-- Address in one row -->
                    <div class="row">
                        <div class="input-group">
                            <label for="address">Address:</label>
                            <input type="text" id="address" placeholder="Enter Address">
                        </div>
                    </div>
                    
                    <div class="save-btn">
                        <span class="material-symbols-outlined">save</span>
                        <label>SAVE</label>
                    </div>
        
                 </div>
            </section>


      </header>
       </main>
    </div>

    <script src="https://kit.fontawesome.com/b6f472161d.js" crossorigin="anonymous"></script>
</body>
</html>