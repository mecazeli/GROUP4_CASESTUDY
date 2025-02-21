<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>SoapNotesAdd </title>
  <link rel="stylesheet" href="css/SoapNotesAdd.css">
</head>
<body>
  <!-- MAIN CONTAINER -->
    <div class="container">
      <!-- SIDEBAR  -->
      <aside class="sidebar">
        <div class="logo">
            <img src="logo.png" alt="MetroMed Clinic">
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
    <!-- SOAP NOTES SECTION -->
    <section>

      <div class="content">
        <h2>SOAP NOTES</h2>
      </div>
      <!-- SOAP FORM -->
      <div class="soap-form">
        <div class="patient-id-row">
          <label for="patient-id" class="patient-id-label">Enter Patient ID:</label>
          <input type="text" id="patient-id" class="patient-id-input" placeholder="e.g., 12345">
        </div>

        <div class="soap-grid">
          <!-- Subjective -->
          <div class="soap-box">
            <h4>Subjective Symptoms</h4>
            <textarea placeholder="Onset, Location, Frequency, Aggravating Factors"></textarea>
          </div>

          <!-- Objective -->
          <div class="soap-box">
            <h4>Objective Findings</h4>
            <textarea placeholder="Vitals, Objective/Test Results"></textarea>
          </div>

          <!-- Assessment -->
          <div class="soap-box">
            <h4>Assessments Goals</h4>
            <textarea placeholder="Long Term/Short Term"></textarea>
          </div>

          <!-- Plan -->
          <div class="soap-box">
            <h4>Plan of Treatment</h4>
            <textarea placeholder="Future Treatments, Frequency, Self Care"></textarea>
          </div>
        </div>
        <!-- Save button with icon -->
        <button class="save-btn">
        <i class="fa-solid fa-floppy-disk"></i> SAVE
        </button>
      </div>
    </div>
  </div>
</body>
</html>
