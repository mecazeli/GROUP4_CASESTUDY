<?php
       $host = 'localhost';
       $username = 'root';
       $password = 'liezel11';
       $database = 'MetroMedClinic';
    
       $conn = new mysqli($host,$username,$password,$database);
?>

<?php
session_start();
if (isset($_SESSION['success'])) {
    echo "<script>alert('" . $_SESSION['success'] . "');</script>";
    unset($_SESSION['success']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/patientinfostyle.css">
    <title>PATIENTS INFORMATION</title>

    <style>
    /* Success Modal */
        .success-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            justify-content: center;
            align-items: center;
        }

        .success-modal-content {
            background: #e3f2fd;
            padding: 20px;
            width: 350px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            border-top: 5px solid #007bff;
        }

        .success-icon {
            font-size: 50px;
            color: #007bff;
            margin-bottom: 10px;
        }

        .success-modal p {
            font-size: 16px;
            color: #333;
            margin-bottom: 15px;
        }

        .success-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .success-btn:hover {
            background-color: #0056b3;
        }


</style>
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
           <li><a href="#"><i class="fa-solid fa-hospital-user"></i></i>PATIENTS</a></li>
           <li><a href="SoapNotesView.php"><i class="fa-solid fa-book"></i></i>SOAP NOTES</a></li>
           <li><a href="appointment.php"><i class="fa-solid fa-calendar-check"></i></i>APPOINTMENTS</a></li>
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
  
            <section>
  
                <!-- table for list of patients -->
            <section class="patient-info">
                <h2>PATIENT INFORMATION</h2>
            
                <table class="patient-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Birthdate</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Registration Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php 
                      $query = "SELECT * FROM  Patients";
                      $result = $conn->query($query);

                      if($result->num_rows> 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                            <td>". htmlspecialchars($row['patientsId']) ."</td>
                            <td>". htmlspecialchars($row['firstName']) . "</td>
                            <td>" . htmlspecialchars($row['lastName']) . "</td>
                            <td>" . htmlspecialchars($row['age']) . "</td>
                            <td>" . htmlspecialchars($row['gender']) . "</td>
                            <td>" . htmlspecialchars($row['dateOfBirth']) . "</td>
                            <td>" . htmlspecialchars($row['phoneNumber']) . "</td>
                            <td>" . htmlspecialchars($row['address']) . "</td>
                            <td>" . htmlspecialchars($row['registrationDate']) . "</td>
                            <td>
                              <a href='editPatient.php?patientsId=" . $row['patientsId'] . "' class='edit-btn'>
                                <i class='fa fa-edit'></i> Edit </a>
                             <button class='delete-btn' onclick='openDeleteModal(" . $row['patientsId'] . ")'><i class='fa fa-trash'></i> Delete</button> 
                            </td>
                        </tr>";
                        }
                      }else{
                        echo "<tr><td colspan='9'>No records found</td></tr>";
                      }
                      $conn->close();
                  ?>
                    </tbody>
                </table>
                 
                <form action="addPatient.php" method="post">
                   <!-- button for add -->
                   <button type="submit" class="add-btn">+ Add</button>
                </form>
              
            </section>
            
            <!-- modal for delete confirmation -->
            <div id="deleteModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeDeleteModal()">&times;</span>
                    <img src="images/delete.png" class="modal-icon">
                    <p>Are you sure you want to delete this record?</p>
                    <div class="modal-buttons">
                        <button onclick="closeDeleteModal()" class="no-btn"><i class="fa fa-times-circle"></i> No</button>
                        <button class="confirm-delete"><i class="fa fa-check-circle"></i> Yes</button>
                    </div>
                </div>
            </div>
         <!-- Success Message Modal -->
            <div id="successModal" class="success-modal">
                <div class="success-modal-content">
                    <span class="success-icon">&#10004;</span>
                    <p>Patient record deleted successfully!</p>
                    <button class="success-btn" onclick="closeSuccessModal()">OK</button>
                </div>
            </div>

     <script>
            function openDeleteModal(patientId) {
                document.getElementById("deleteModal").style.display = "flex";
                document.querySelector(".confirm-delete").setAttribute("data-id", patientId);
            }
            function closeDeleteModal() {
                document.getElementById("deleteModal").style.display = "none";
            }
            function showSuccessModal() {
                document.getElementById("successModal").style.display = "flex";
            }

            function closeSuccessModal() {
                document.getElementById("successModal").style.display = "none";
                location.reload(); // Reload page after closing modal
            }

            document.querySelector(".confirm-delete").addEventListener("click", function() {
                let patientId = this.getAttribute("data-id");

                fetch("deletePatient.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "id=" + patientId
                })
                .then(response => response.text())
                .then(data => {
                    if (data.trim() === "success") {
                        closeDeleteModal(); // Close the delete confirmation modal
                        showSuccessModal(); // Show success modal instead of alert
                    } else {
                        alert("Error deleting record.");
                    }
                });
            });

     </script>
    
</body>
</html>