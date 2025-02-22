<?php
include 'config.php';

// Corrected SQL query
$sql = "SELECT s.noteId, p.firstName, p.lastName, s.subjective, s.objective, s.assessment, s.plan, s.dateCreated 
        FROM SOAPNotes s 
        JOIN Patients p ON s.patientsId = p.patientsId 
        ORDER BY s.dateCreated DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypA9T/TbSg9FjI6tUOvoXGV9XxfD9AFk6pGx4h9Lg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <!-- Dashboard Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>SoapNotes</title>
  <link rel="stylesheet" href="SoapNotes.css">
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <div class="logo">
          <img src="logo.png" alt="MetroMed Clinic">
          <h2>MetroMed Clinic</h2>
      </div>
      <ul class="sub-menu">
         <li><a href="#"><i class="fa-solid fa-house"></i>DASHBOARD</a></li>
         <li><a href="#"><i class="fa-solid fa-hospital-user"></i>PATIENTS</a></li>
         <li><a href="#"><i class="fa-solid fa-book"></i>SOAP NOTES</a></li>
         <li><a href="#"><i class="fa-solid fa-calendar-check"></i>APPOINTMENTS</a></li>
         <li><a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>LOG OUT</a></li>
      </ul>
    </aside>

    <main class="main-content">
      <header class="header">
          <div class="search-container">
              <input type="text" placeholder="Search" class="search-box">
          </div>
          <div class="profile">
              <span>AD</span>
          </div>
      </header>

      <section class="soap-notes-container">
        <div class="title">
          <h2>SOAP NOTES</h2>
          <button class="add-btn" onclick="window.location.href='SoapNotesAdd.php'">+ Add Notes</button>
        </div>

        <div class="soap-notes">
          <?php
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<div class='note-item'>";
                  echo "<span>" . htmlspecialchars($row['firstName']) . " " . htmlspecialchars($row['lastName']) . "</span>";
                  echo "<div class='note-buttons'>";
                  echo "<button class='view-btn' onclick=\"viewNote(" . $row['noteId'] . ")\">👁 View</button>";
                  echo "<button class='edit-btn'>✏ Edit</button>";
                  echo "<button class='delete-btn' onclick=\"deleteNote(" . $row['noteId'] . ")\">❌ Delete</button>";
                  echo "</div>";
                  echo "</div>";
              }
          } else {
              echo "<p>No SOAP Notes found.</p>";
          }
          ?>
        </div>
      </section>
    </main>
  </div>

  <!-- Include SweetAlert2 Library -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function viewNote(noteId) {
        window.location.href = "ViewSoapNotes.php?id=" + noteId;
    }

    function deleteNote(noteId) {
      // SweetAlert2 confirmation modal
      Swal.fire({
          title: 'Are you sure?',
          text: "Do you want to delete this note?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = "delete_note.php?id=" + noteId;
          }
      });
    }
  </script>
</body>
</html>

<?php
$conn->close();
?>
