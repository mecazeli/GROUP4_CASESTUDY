<?php
include 'config.php';

if (isset($_GET['id'])) {
    $noteId = $_GET['id'];
    $sql = "DELETE FROM SOAPNotes WHERE noteId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $noteId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: SoapNotes.php");
    } else {
        echo "Error deleting note.";
    }
}
?>
