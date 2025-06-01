<?php
require 'initConn.php';
if (isset($_POST['submit'])) {
  // Handle form submission
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $age = $_POST['age'];
  $major = $_POST['major'];
  $email = $_POST['email'];
  $entryDate = $_POST['entryDate'];
  $profilePicture = null;

  // Check if a file was uploaded
  if (!empty($_FILES['profilePicture']['name'])) {
      $profilePicture = $_FILES['profilePicture']['name'];
      $targetDir = "uploads/";
      $targetFile = $targetDir . basename($profilePicture);

      // Move uploaded file to the uploads directory
      if (!move_uploaded_file($_FILES['profilePicture']['tmp_name'], $targetFile)) {
        $profilePicture = null; // Reset to null if upload fails
      }
  }

  // Prepare SQL statement
  $sql = "INSERT INTO student (first_name, last_name, age, major, email, entry_date, profile_picture) 
    VALUES (?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssissss", $firstName, $lastName, $age, $major, $email, $entryDate, $profilePicture);

  // Execute the statement
  $executed = $stmt->execute();
  if ($executed) {
    // Redirect to index.php with success message
    header("Location: index.php?message=Student added successfully.");
  } else {
    // Redirect to index.php with error message
    header("Location: index.php?error=Failed to add student. Please try again.");
  }
}
?>