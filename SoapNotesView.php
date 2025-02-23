<?php
// Database connection
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "MetroMedClinic"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure noteId is provided
if (isset($_GET['noteId'])) {
    $noteId = intval($_GET['noteId']);

    // Fetch SOAP note details with patient info
    $sql = "SELECT Patients.firstName, Patients.lastName, Patients.gender, Patients.dateOfBirth, Patients.phoneNumber, Patients.address, SOAPNotes.*
            FROM SOAPNotes
            INNER JOIN Patients ON SOAPNotes.patientsId = Patients.patientsId
            WHERE SOAPNotes.noteId = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $noteId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "SOAP Note not found.";
        exit;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
    exit;
}

// Function to calculate age from date of birth
function calculateAge($dob) {
    $dob = new DateTime($dob);
    $today = new DateTime();
    $age = $today->diff($dob)->y;
    return $age;
}

$patientAge = calculateAge($row['dateOfBirth']);

// Close database connection at the end
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOAP Notes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/SoapNotesView.css">
</head>
<body>
    <div class="container">
        <!-- SIDEBAR -->
        <div class="sidebar">
            <div class="logo">
                <img src="images/logo.png" alt="MetroMed Logo">
                <h2>MetroMed Clinic</h2>
            </div>
            <ul class="sub-menu">
                <li><a href="#"><i class="fas fa-home"></i>DASHBOARD</a></li>
                <li><a href="#"><i class="fas fa-user"></i>PATIENTS</a></li>
                <li><a href="#"><i class="fas fa-file-medical"></i>SOAP NOTES</a></li>
                <li><a href="#"><i class="fas fa-calendar-check"></i>APPOINTMENTS</a></li>
                <li><a href="#"><i class="fas fa-sign-out-alt"></i>LOG OUT</a></li>
            </ul>
        </div>

        <!-- MAIN CONTENT -->
        <div class="main-content">
            <section>
                <h2>SOAP Notes</h2>

                <!-- PATIENT INFORMATION -->
                <div class="patient-info">
                    <h3>Patient Information</h3>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($row['firstName'] . ' ' . $row['lastName']); ?></p>
                    <p><strong>Age:</strong> <?php echo $patientAge; ?> years old</p>
                    <p><strong>Gender:</strong> <?php echo htmlspecialchars($row['gender']); ?></p>
                    <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($row['dateOfBirth']); ?></p>
                    <p><strong>Contact:</strong> <?php echo htmlspecialchars($row['phoneNumber']); ?></p>
                    <p><strong>Address:</strong> <?php echo htmlspecialchars($row['address']); ?></p>
                </div>

                <!-- SOAP NOTES GRID -->
                <div class="soap-grid">
                    <div class="soap-box">
                        <h4>Subjective Symptoms</h4>
                        <textarea readonly><?php echo htmlspecialchars($row['subjective']); ?></textarea>
                    </div>

                    <div class="soap-box">
                        <h4>Objective Findings</h4>
                        <textarea readonly><?php echo htmlspecialchars($row['objective']); ?></textarea>
                    </div>

                    <div class="soap-box">
                        <h4>Assessments Goals</h4>
                        <textarea readonly><?php echo htmlspecialchars($row['assessment']); ?></textarea>
                    </div>

                    <div class="soap-box">
                        <h4>Plan of Treatment</h4>
                        <textarea readonly><?php echo htmlspecialchars($row['plan']); ?></textarea>
                    </div>
                </div>

                <!-- RETURN BUTTON -->
                <button class="back-btn" onclick="goBack()">RETURN</button>
            </section>
        </div>
    </div>

    <script>
        function goBack() {
            window.location.href = "SoapNotes.php";
        }
    </script>
</body>
</html>
