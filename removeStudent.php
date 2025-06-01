<?php
require 'initConn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['student_id'])) {
  $studentId = $_POST['student_id'];

  // Prepare SQL statement to delete the student
  $sql = "DELETE FROM student WHERE StudentID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $studentId);

  // Execute the statement
  if ($stmt->execute()) {
    // Redirect to index.php with success message
    header("Location: index.php?message=Student removed successfully");
    exit();
  } else {
    // Redirect to index.php with error message
    header("Location: index.php?error=Failed to remove student");
    exit();
  }
}
?>