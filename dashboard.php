<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>MetroMed Clinic Dashboard </title>
  <link rel="stylesheet" href="css/dashboard.css">
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
          <div class="search-container">
              <input type="text" placeholder="Search" class="search-box">
          </div>
          <div class="profile">
              <span>AD</span>
          </div>
      </header>

      <div class="stats">
            <div class="card patients">
                <div class="card-header">
                    <div class="icon-container">
                        <i class="fas fa-user-injured"></i>
                    </div>
                    <h4>Patients</h4>
                </div>
                <div class="card-body">
                    <h1><b>100</b></h1>
                    <p>No. of Patients</p>
                </div>
            </div>
        
            <div class="card doctors">
                <div class="card-header">
                    <div class="icon-container">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <h4>Doctors</h4>
                </div>
                <div class="card-body">
                    <h1><b>02</b></h1>
                    <p>No. of Available Doctors</p>
                </div>
            </div>

            <div class="card appointments">
                <div class="card-header">
                    <div class="icon-container">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h4>Appointments</h4>
                </div>
                <div class="card-body">
                    <h1><b>05</b></h1>
                    <p>No. of Appointments</p>
                </div>
            </div>
        </div>

        <!-- Bottom Section -->
        <section class="bottom-section">
            <section class="soap-notes">
                <h3>Soap Notes</h3>
                <div class="note">
                    <span>Liezel Patiente</span>
                    <button class="view-btn">View</button>
                </div>
                <div class="note">
                    <span>Almer Pogi</span>
                    <button class="view-btn">View</button>
                </div>
                <div class="note">
                    <span>Sheena Mae</span>
                    <button class="view-btn">View</button>
                </div>
           
        </section>
            
            <section class="calendar-container">
                    <h3>Calendar</h3>
                    <div class="calendar">
                        <div class="calendar-header">
                            <button id="prevMonth">&lt;</button>
                            <span id="currentMonthYear">Month Year</span>
                            <button id="nextMonth">&gt;</button>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Sun</th>
                                    <th>Mon</th>
                                    <th>Tue</th>
                                    <th>Wed</th>
                                    <th>Thu</th>
                                    <th>Fri</th>
                                    <th>Sat</th>
                                </tr>
                            </thead>
                            <tbody id="calendarBody">
                                <!-- Calendar dates will be dynamically generated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </section>
    </main>
    <script src="dashboard.js"></script>
       </main>
    </div>

    <script src="https://kit.fontawesome.com/b6f472161d.js" crossorigin="anonymous"></script>
</body>
</html>
