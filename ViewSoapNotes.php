<?php
include 'config.php';

$noteId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT s.*, p.firstName, p.lastName FROM SOAPNotes s
        JOIN Patients p ON s.patientsId = p.patientsId
        WHERE s.noteId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $noteId);
$stmt->execute();
$result = $stmt->get_result();
$note = $result->fetch_assoc();

if (!$note) {
?>
  <div class="left-section">
          <!-- Return button from your template -->
          <button class="back" onclick="window.location.href='SoapNotes.php'">
            <span class="material-symbols-outlined">Back to Soap Notes page</span>
          </button>
        </div>
<?php
    die("Note not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Font and Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Use your existing CSS template -->
  <link rel="stylesheet" href="SoapNotesAdd.css">
  <title>View SOAP Note</title>
</head>
<body>
  <!-- MAIN CONTAINER -->
  <div class="container">
    <!-- SIDEBAR -->
    <aside class="sidebar">
      <div class="logo">
        <img src="logo.png" alt="MetroMed Clinic">
        <h2>MetroMed Clinic</h2>
      </div>
      <!-- LIST OF MENUS -->
      <ul class="sub-menu">
         <li><a href="#"><i class="fa-solid fa-house"></i>DASHBOARD</a></li>
         <li><a href="#"><i class="fa-solid fa-hospital-user"></i>PATIENTS</a></li>
         <li><a href="#"><i class="fa-solid fa-book"></i>SOAP NOTES</a></li>
         <li><a href="#"><i class="fa-solid fa-calendar-check"></i>APPOINTMENTS</a></li>
         <li><a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>LOG OUT</a></li>
      </ul>
    </aside>
    <!-- HEADERS AND MAIN CONTENT -->
    <main class="main-content">
      <header class="header">
        <div class="left-section">
          <!-- Return button from your template -->
          <button class="back" onclick="window.location.href='SoapNotes.php'">
            <span class="material-symbols-outlined">arrow_back_ios</span>
          </button>
          <p>RETURN</p>
        </div>
        <div class="search-container">
          <input type="text" placeholder="Search" class="search-box" disabled>
        </div>
        <div class="profile">
          <span>AD</span>
        </div>
      </header>
      <!-- SOAP NOTES SECTION -->
      <section>
        <div class="content">
          <h2>SOAP NOTES</h2>
        </div>
        <!-- SOAP FORM in view mode -->
        <div class="soap-form">
          <div class="patient-id-row">
            <!-- Patient ID (Newly Added) -->
            <label for="patient-id" class="patient-id-label">Patient ID:</label>
            <input type="text" id="patient-id" class="patient-id-input" 
              value="<?= htmlspecialchars($note['patientsId']) ?>" disabled>
          </div>

          <div class="patient-id-row">
            <!-- Patient Name -->
            <label for="patient-name" class="patient-id-label">Patient:</label>
            <input type="text" id="patient-name" class="patient-id-input" 
              value="<?= htmlspecialchars($note['firstName'] . ' ' . $note['lastName']) ?>" disabled>
          </div>

          

          <div class="soap-grid">
            <!-- Subjective -->
            <div class="soap-box">
              <h4>Subjective Symptoms</h4>
              <textarea placeholder="Onset, Location, Frequency, Aggravating Factors" disabled><?= htmlspecialchars($note['subjective']) ?></textarea>
            </div>
            <!-- Objective -->
            <div class="soap-box">
              <h4>Objective Findings</h4>
              <textarea placeholder="Vitals, Objective/Test Results" disabled><?= htmlspecialchars($note['objective']) ?></textarea>
            </div>
            <!-- Assessment -->
            <div class="soap-box">
              <h4>Assessments Goals</h4>
              <textarea placeholder="Long Term/Short Term" disabled><?= htmlspecialchars($note['assessment']) ?></textarea>
            </div>
            <!-- Plan -->
            <div class="soap-box">
              <h4>Plan of Treatment</h4>
              <textarea placeholder="Future Treatments, Frequency, Self Care" disabled><?= htmlspecialchars($note['plan']) ?></textarea>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</body>
</html>
<?php $conn->close(); ?>
