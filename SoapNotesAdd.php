<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "MetroMedClinic");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$noteId = isset($_GET['noteId']) ? intval($_GET['noteId']) : 0;
$subjective = $objective = $assessment = $plan = "";
$patientName = "";

// Fetch existing data if editing
if ($noteId > 0) {
    $stmt = $conn->prepare("SELECT Patients.firstName, Patients.lastName, SOAPNotes.subjective, SOAPNotes.objective, SOAPNotes.assessment, SOAPNotes.plan 
                            FROM SOAPNotes 
                            INNER JOIN Patients ON SOAPNotes.patientsId = Patients.patientsId 
                            WHERE SOAPNotes.noteId = ?");
    $stmt->bind_param("i", $noteId);
    $stmt->execute();
    $stmt->bind_result($firstName, $lastName, $subjective, $objective, $assessment, $plan);
    $stmt->fetch();
    $patientName = $firstName . ' ' . $lastName;
    $stmt->close();
}

// Handle saving (edit or add)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
    $noteId = intval($_POST['noteId']);
    $patientName = $_POST['patientName'];
    $subjective = $_POST['subjective'];
    $objective = $_POST['objective'];
    $assessment = $_POST['assessment'];
    $plan = $_POST['plan'];

    // Get patient ID
    $stmt = $conn->prepare("SELECT patientsId FROM Patients WHERE CONCAT(firstName, ' ', lastName) = ?");
    $stmt->bind_param("s", $patientName);
    $stmt->execute();
    $stmt->bind_result($patientsId);
    $stmt->fetch();
    $stmt->close();

    if ($patientsId) {
        if ($noteId > 0) {
            // UPDATE existing note
            $stmt = $conn->prepare("UPDATE SOAPNotes SET subjective = ?, objective = ?, assessment = ?, plan = ? WHERE noteId = ?");
            $stmt->bind_param("ssssi", $subjective, $objective, $assessment, $plan, $noteId);
        } else {
            // Check if patient already has a SOAP note
            $checkStmt = $conn->prepare("SELECT noteId FROM SOAPNotes WHERE patientsId = ?");
            $checkStmt->bind_param("i", $patientsId);
            $checkStmt->execute();
            $checkStmt->store_result();

            if ($checkStmt->num_rows > 0) {
                echo "<script>alert('Error: This patient already has a SOAP note!'); window.location.href='SoapNotesAdd.php';</script>";
                exit;
            }
            $checkStmt->close();

            // INSERT new note
            $stmt = $conn->prepare("INSERT INTO SOAPNotes (patientsId, subjective, objective, assessment, plan) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $patientsId, $subjective, $objective, $assessment, $plan);
        }

        if ($stmt->execute()) {
            echo "<script>alert('SOAP Note saved successfully!'); window.location.href='SoapNotes.php';</script>";
        } else {
            echo "<script>alert('Error saving SOAP Note.'); window.location.href='SoapNotesAdd.php';</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Patient not found. Please enter a valid name.'); window.location.href='SoapNotesAdd.php';</script>";
    }
}

// Handle delete request
if (isset($_GET['deleteId'])) {
    $deleteId = intval($_GET['deleteId']);
    $stmt = $conn->prepare("DELETE FROM SOAPNotes WHERE noteId = ?");
    $stmt->bind_param("i", $deleteId);

    if ($stmt->execute()) {
        echo "<script>alert('SOAP Note deleted successfully!'); window.location.href='SoapNotes.php';</script>";
    } else {
        echo "<script>alert('Error deleting SOAP Note.'); window.location.href='SoapNotes.php';</script>";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <title>SoapNotesAdd</title>
  <link rel="stylesheet" href="css/SoapNotesAdd.css">
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <div class="logo">
          <img src="images/logo.png" alt="MetroMed Clinic">
          <h2>MetroMed Clinic</h2>
      </div>
      <ul class="sub-menu">
         <li><a href="#"><i class="fa-solid fa-house"></i>DASHBOARD</a></li>
         <li><a href="#"><i class="fa-solid fa-hospital-user"></i>PATIENTS</a></li>
         <li><a href="#"><i class="fa-solid fa-book"></i>SOAP NOTES</a></li>
         <li><a href="#"><i class="fa-solid fa-calendar-check"></i>APPOINTMENTS</a></li>
         <li><a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i>LOG OUT</a></li>
      </ul>
    </aside>
    <main class="main-content">
      <header class="header">
          <button class="back" onclick="goBack()">
              <i class="fa-solid fa-arrow-left"></i> RETURN
          </button>
      </header>

      <section class="soap-notes-container">
        <div class="content">
          <h2>SOAP NOTES</h2>
        </div>

        <div class="soap-form">
          <form method="POST">
            <input type="hidden" name="noteId" value="<?php echo $noteId; ?>">

            <div class="patient-id-row">
              <label for="patient-id">Enter Patient Name:</label>
              <input type="text" id="patient-id" class="patient-id-input" name="patientName" value="<?php echo htmlspecialchars($patientName); ?>" placeholder="Patient Name" required>
            </div>

            <div class="soap-grid">
              <div class="soap-box">
                <h4>Subjective Symptoms</h4>
                <textarea id="subjective" name="subjective"><?php echo htmlspecialchars($subjective); ?></textarea>
              </div>
              <div class="soap-box">
                <h4>Objective Findings</h4>
                <textarea id="objective" name="objective"><?php echo htmlspecialchars($objective); ?></textarea>
              </div>
              <div class="soap-box">
                <h4>Assessments Goals</h4>
                <textarea id="assessment" name="assessment"><?php echo htmlspecialchars($assessment); ?></textarea>
              </div>
              <div class="soap-box">
                <h4>Plan of Treatment</h4>
                <textarea id="plan" name="plan"><?php echo htmlspecialchars($plan); ?></textarea>
              </div>
            </div>

            <div class="save-container">
              <button type="submit" name="save" class="save-btn">
                <i class="fa-solid fa-floppy-disk"></i> SAVE
              </button>
           </div>
          </form>
        </div>
      </section>
    </main>
  </div>

  <script>
    function goBack() {
      window.location.href = "SoapNotes.php";
    }
  </script>
</body>
</html>
