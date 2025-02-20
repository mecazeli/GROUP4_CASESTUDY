<?php
include 'config.php';

$noteId = $_GET['id'];
$sql = "SELECT s.*, p.firstName, p.lastName FROM SOAPNotes s
        JOIN Patients p ON s.patientsId = p.patientsId
        WHERE s.noteId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $noteId);
$stmt->execute();
$result = $stmt->get_result();
$note = $result->fetch_assoc();

if (!$note) {
    die("Note not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View SOAP Note</title>
</head>
<body>
  <h2>SOAP Note Details</h2>
  <p><strong>Patient:</strong> <?= htmlspecialchars($note['firstName'] . ' ' . $note['lastName']) ?></p>
  <p><strong>Subjective:</strong> <?= nl2br(htmlspecialchars($note['subjective'])) ?></p>
  <p><strong>Objective:</strong> <?= nl2br(htmlspecialchars($note['objective'])) ?></p>
  <p><strong>Assessment:</strong> <?= nl2br(htmlspecialchars($note['assessment'])) ?></p>
  <p><strong>Plan:</strong> <?= nl2br(htmlspecialchars($note['plan'])) ?></p>
  <p><strong>Date:</strong> <?= $note['dateCreated'] ?></p>
</body>
</html>

<?php $conn->close(); ?>
