<!-- PHP database code  -->
<?php
// Database connection
$conn = new mysqli("localhost", "root", "liezel11", "MetroMedClinic");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Fetch SOAP notes with patient names
$query = "SELECT SOAPNotes.noteId, Patients.firstName, Patients.lastName 
          FROM SOAPNotes 
          INNER JOIN Patients ON SOAPNotes.patientsId = Patients.patientsId";
$result = $conn->query($query);
?>
<!-- Html -->
<!DOCTYPE html>
<html lang="en">
// Head
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <title>SOAP Notes</title>
  <link rel="stylesheet" href="css/SoapNotes.css">
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <div class="logo">
          <img src="images/logo.png" alt="MetroMed Clinic">
          <h2>MetroMed Clinic</h2>
      </div>
      <ul class="sub-menu">
         <li><a href="dashboard.php"><i class="fa-solid fa-house"></i>DASHBOARD</a></li>
         <li><a href="patientinfo.php"><i class="fa-solid fa-hospital-user"></i>PATIENTS</a></li>
         <li><a href="#"><i class="fa-solid fa-book"></i>SOAP NOTES</a></li>
         <li><a href="appointment.php"><i class="fa-solid fa-calendar-check"></i>APPOINTMENTS</a></li>
         <li><a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>LOG OUT</a></li>
      </ul>
    </aside>
    <main class="main-content">
      <header class="header">
        <div class="search-container">
            <input type="text" placeholder="Search" id="searchInput" onkeyup="filterNotes()">
        </div>
        <div class="profile">
            <span>AD</span>
        </div>
      </header>

      <!-- soapnotes title and container -->
      <section class="soap-notes-container">
        <div class="title">
          <h2>SOAP NOTES</h2>
          <button class="add-btn" onclick="addNote()">+ Add Notes</button>
        </div>

        <!-- (add, create, view and delete) -->
        <div class="soap-notes" id="notesContainer">
          <?php while ($row = $result->fetch_assoc()): ?>
            <div class="note-item">
              <span class="note-name"><?php echo $row['firstName'] . ' ' . $row['lastName']; ?></span>
              <div class="note-buttons">
                <button class="view-btn" onclick="viewPage(<?php echo $row['noteId']; ?>)">
                    <i class="fa-solid fa-eye"></i> View 
                </button>
                <button class="edit-btn" onclick="editNote(<?php echo $row['noteId']; ?>)">
                    <i class="fa-solid fa-pencil"></i> Edit
                </button>
                <button class="delete-btn" onclick="openDeleteModal(<?php echo $row['noteId']; ?>)">
                    <i class="fa-solid fa-trash"></i> Delete
                </button>
              </div>
            </div>
          <?php endwhile; ?>
          <p id="noResultsMessage">No records found.</p>
        </div>
      </section>
    </main>
  </div>

  <!-- Delete Modal -->
  <div id="deleteModal" class="modal">
      <div class="modal-content">
          <h3>Confirm Deletion</h3>
          <p>Are you sure you want to delete this note?</p>
          <div class="modal-buttons">
              <button class="close-btn" onclick="toggleModal('deleteModal', false)">Cancel</button>
              <button class="delete-confirm-btn" id="confirmDeleteBtn">Delete</button>
          </div>
      </div>
  </div>

  <script>
    let deleteNoteId = null; // variable for deleting 

    function toggleModal(modalId, show) {
        document.getElementById(modalId).style.display = show ? "block" : "none";  // toggle for modal
    }

    function addNote() {
        window.location.href = "SoapNotesAdd.php"; // add note soap
    }

    function editNote(noteId) {
        window.location.href = `SoapNotesAdd.php?noteId=${noteId}`; // edit note soap
    }

    function viewPage(noteId) {
        window.location.href = `SoapNotesView.php?noteId=${noteId}`; // viewpage note soap 
    }

    function openDeleteModal(noteId) {
        deleteNoteId = noteId;   // delete modal
        toggleModal("deleteModal", true);
    }

    document.getElementById("confirmDeleteBtn").addEventListener("click", function() {
        if (deleteNoteId) {
            window.location.href = `deleteNote.php?noteId=${deleteNoteId}`;
        }
    });
    
    // for search function
    function filterNotes() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let notes = document.querySelectorAll(".note-item");
        let found = false;

        notes.forEach(note => {
            let name = note.querySelector(".note-name").textContent.toLowerCase();
            if (name.includes(input)) {
                note.style.display = "flex";
                found = true;
            } else {
                note.style.display = "none";
            }
        });

        document.getElementById("noResultsMessage").style.display = found ? "none" : "block";
    }
  </script>
</body>
</html>

<?php $conn->close(); ?>
