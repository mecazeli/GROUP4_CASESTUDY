<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>SoapNotes </title>
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
         <li><a href="#"><i class="fa-solid fa-house"></i>DASHBOARD</a></li>
         <li><a href="#"><i class="fa-solid fa-hospital-user"></i>PATIENTS</a></li>
         <li><a href="#"><i class="fa-solid fa-book"></i>SOAP NOTES</a></li>
         <li><a href="#"><i class="fa-solid fa-calendar-check"></i>APPOINTMENTS</a></li>
         <li><a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i>LOG OUT</a></li>
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
          <button class="add-btn">+ Add Notes</button>
        </div>
        <div class="soap-notes">
          <div class="note-item">
            <span>Liezel Patiente</span>
            <div class="note-buttons">
              <button class="view-btn"><i class="fa-solid fa-eye"></i> View</button>
              <button class="edit-btn"><i class="fa-solid fa-pencil"></i> Edit</button>
              <button class="delete-btn" onclick="openModal(this)"><i class="fa-solid fa-trash"></i> Delete</button>
            </div>
          </div>
          <div class="note-item">
            <span>Almer</span>
            <div class="note-buttons">
              <button class="view-btn"><i class="fa-solid fa-eye"></i> View</button>
              <button class="edit-btn"><i class="fa-solid fa-pencil"></i> Edit</button>
              <button class="delete-btn" onclick="openModal(this)"> <i class="fa-solid fa-trash"></i>Delete</button>
            </div>
          </div>
          <div class="note-item">
            <span>Sheena Mae</span>
            <div class="note-buttons">
              <button class="view-btn"><i class="fa-solid fa-eye"></i> View</button>
              <button class="edit-btn"><i class="fa-solid fa-pencil"></i> Edit</button>
              <button class="delete-btn" onclick="openModal(this)"><i class="fa-solid fa-trash"></i> Delete</button>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>

  <!-- DELETE CONFIRMATION MODAL -->
  <div id="deleteModal" class="modal">
    <div class="modal-content">
      <div class="modal-logo">
        <i class="fa-solid fa-trash"></i>
      </div>
      <p>Are you sure to delete this note?</p>
      <div class="modal-buttons">
        <button class="cancel" onclick="closeModal()">No</button>
        <button class="confirm" onclick="confirmDelete()">Yes</button>
      </div>
    </div>
  </div>

  <script>
    let deleteTarget;

    function openModal(button) {
      deleteTarget = button.closest('.note-item');
      document.getElementById('deleteModal').style.display = 'flex';
    }

    function closeModal() {
      document.getElementById('deleteModal').style.display = 'none';
    }

    function confirmDelete() {
      if (deleteTarget) {
        deleteTarget.remove();
      }
      closeModal();
    }
  </script>
</body>
</html>
