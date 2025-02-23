<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "MetroMedClinic");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if noteId is set
if (isset($_GET['noteId'])) {
    $noteId = intval($_GET['noteId']);

    // Prepare and execute delete query
    $stmt = $conn->prepare("DELETE FROM SOAPNotes WHERE noteId = ?");
    $stmt->bind_param("i", $noteId);
    
    if ($stmt->execute()) {
        echo "<script>alert('SOAP Note deleted successfully!'); window.location.href='SoapNotes.php';</script>";
    } else {
        echo "<script>alert('Error deleting SOAP Note.'); window.location.href='SoapNotes.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>