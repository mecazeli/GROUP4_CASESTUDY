<?php

$host = 'localhost';
$username = 'root';
$password = 'liezel11';
$database = 'MetroMedClinic';

$conn = new mysqli($host, $username, $password, $database);

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientsId = $_POST['patientsId'];
    $appointmentDate = $_POST['appointmentDate'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("INSERT INTO Appointments (patientsId, appointmentDate, status) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $patientsId, $appointmentDate, $status);

    if ($stmt->execute()) {
        echo "<script>
            alert('Appointment successfully added!');
            window.location.href = 'appointment.php'; // Refresh the page to show the updated table
        </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch patients
$sql = "SELECT * FROM Patients";
$patientsResult = $conn->query($sql);

// Fetch appointments with patient details
$appointmentsSql = "SELECT a.appointmentId, a.patientsId, p.firstName, p.lastName, a.appointmentDate, a.status 
                    FROM Appointments a 
                    JOIN Patients p ON a.patientsId = p.patientsId 
                    ORDER BY a.appointmentDate DESC";
$appointmentsResult = $conn->query($appointmentsSql);
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
           <li><a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>LOG OUT</a></li>
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
    <h2>PATIENTS</h2>
    <div class="appointments-table">
        <div class="table-header">
            <p>ID</p>
            <p>First Name</p>
            <p>Last Name</p>
            <p>Age</p>
            <p>Phone Number</p>
            <p>Action</p>
        </div>

        <?php while ($row = $patientsResult->fetch_assoc()): ?>
            <div class="table-row">
                <div class="row-item"><?= htmlspecialchars($row["patientsId"]) ?></div>
                <div class="row-item"><?= htmlspecialchars($row["firstName"]) ?></div>
                <div class="row-item"><?= htmlspecialchars($row["lastName"]) ?></div>
                <div class="row-item"><?= htmlspecialchars($row["age"]) ?></div>
                <div class="row-item"><?= htmlspecialchars($row["phoneNumber"]) ?></div>
                <button class="edit-btn" data-id="<?= $row['patientsId'] ?>" 
                        data-name="<?= $row['firstName'] . ' ' . $row['lastName'] ?>">
                    <i class="fa-solid fa-pen"></i> 
                </button>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- APPOINTMENTS TABLE -->
<div class="appointments-container">
    <h2>Appointments</h2>
    <div class="appointments-table">
        <div class="table-header">
            <p>Appointment ID</p>
            <p>Patient Name</p>
            <p>Appointment Date</p>
            <p>Status</p>
        </div>

        <?php while ($appointment = $appointmentsResult->fetch_assoc()): ?>
            <div class="table-row">
                <div class="row-item"><?= htmlspecialchars($appointment["appointmentId"]) ?></div>
                <div class="row-item"><?= htmlspecialchars($appointment["firstName"] . ' ' . $appointment["lastName"]) ?></div>
                <div class="row-item"><?= htmlspecialchars($appointment["appointmentDate"]) ?></div>
                <div class="row-item"><?= htmlspecialchars($appointment["status"]) ?></div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
       </main>
    </div>

    <!-- MODAL FORM -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <h3>Set Appointment</h3>
        <form id="appointmentForm" method="POST">
            <input type="hidden" name="patientsId" id="patientsId">
            <p id="patientName"></p>
            <label>Appointment Date:</label>
            <input type="date" name="appointmentDate" required>
            <label>Status:</label>
            <select name="status">
                <option value="Pending">Pending</option>
                <option value="Ongoing">Ongoing</option>
                <option value="Completed">Completed</option>
            </select>
            <button type="submit" class="save-btn">Save</button>
            <button type="button" class="close-btn">Cancel</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const editBtns = document.querySelectorAll(".edit-btn");
        const modal = document.getElementById("editModal");
        const patientName = document.getElementById("patientName");
        const patientIdInput = document.getElementById("patientsId");
        const closeModalBtn = document.querySelector(".close-btn");


    editBtns.forEach(button => {
        button.addEventListener("click", function () {
            modal.style.display = "flex"; 
        });
    });

        editBtns.forEach(btn => {
            btn.addEventListener("click", function () {
                patientIdInput.value = this.getAttribute("data-id");
                patientName.textContent = "Patient: " + this.getAttribute("data-name");
                modal.style.display = "block";
            });
        });

        closeModalBtn.addEventListener("click", function () {
            modal.style.display = "none";
        });

        window.onclick = function (event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        };
    });
</script>

    <script src="https://kit.fontawesome.com/b6f472161d.js" crossorigin="anonymous"></script>

</body>
</html>  