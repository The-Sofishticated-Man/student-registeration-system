<?php
require 'initConn.php';

// Initialize $student as an empty array
$student = [];

// Fetch student data if 'id' is provided in the query string
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM student WHERE StudentID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $student = $result->fetch_assoc();
}

// Handle form submission
if (isset($_POST['submit'])) {
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $age = $_POST['age'];
  $major = $_POST['major'];
  $email = $_POST['email'];
  $entryDate = $_POST['entryDate'];
  $profilePicture = $student['profile_picture'] ?? '';

  // Check if a new file was uploaded
  if (!empty($_FILES['profilePicture']['name'])) {
      $profilePicture = $_FILES['profilePicture']['name'];
      $targetDir = "uploads/";
      $targetFile = $targetDir . basename($profilePicture);

      // Move uploaded file to the uploads directory
      if (!move_uploaded_file($_FILES['profilePicture']['tmp_name'], $targetFile)) {
        $profilePicture = $student['profile_picture'] ?? ''; // Keep the old picture if upload fails
      }
  }

  // Prepare SQL statement for update
  $sql = "UPDATE student SET first_name = ?, last_name = ?, age = ?, major = ?, email = ?, entry_date = ?, profile_picture = ? WHERE StudentID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssissssi", $firstName, $lastName, $age, $major, $email, $entryDate, $profilePicture, $id);

  // Execute the statement
  $executed = $stmt->execute();
}
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Student</title>
    <link rel="stylesheet" href="./css/editStyle.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
  </head>
  <body>
    <nav>
      <img class="logo" src="img/logo.jpg" alt="Website Logo" />
      <a href="index.php" class="back-btn">
        <span>Back</span>
        <i class="fa" style="font-size: 2.4rem">&#xf0a8;</i>
      </a>
    </nav>
    <div class="container">
      <form method="post" enctype="multipart/form-data">
        <h1 class="form-heading">Edit Student</h1>
        <p class="form-description">Update the details of the student below</p>
        <div class="form-group">
          <label for="firstName">First Name:</label>
          <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($student['first_name'] ?? ''); ?>" required />
        </div>
        <div class="form-group">
          <label for="lastName">Last Name:</label>
          <input type="text" id="lastName" name="lastName" value="<?php echo htmlspecialchars($student['last_name'] ?? ''); ?>" required />
        </div>
        <div class="form-group">
          <label for="age">Age:</label>
          <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($student['age'] ?? ''); ?>" required />
        </div>
        <div class="form-group">
          <label for="major">Major:</label>
          <input type="text" id="major" name="major" value="<?php echo htmlspecialchars($student['major'] ?? ''); ?>" required />
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($student['email'] ?? ''); ?>" required />
        </div>
        <div class="form-group">
          <label for="entryDate">Entry Date:</label>
          <input type="date" id="entryDate" name="entryDate" value="<?php echo htmlspecialchars($student['entry_date'] ?? ''); ?>" required />
        </div>
        <div class="form-group">
          <label for="profilePicture">Profile Picture:</label>
          <input type="file" id="profilePicture" name="profilePicture" accept="image/*" />
          <div class="current">
            <p>Current Picture:</p>
            <div>
              <img src="uploads/<?php echo $student["profile_picture"]? htmlspecialchars($student['profile_picture']): ".jpg" ?>" alt="Profile Picture" width="100">
            </div>
          </div>
        </div>
        <button type="submit" class="submit-btn" name="submit">Update</button>
        <?php
        if (isset($executed) && $executed) {
          echo '<p class="success-message">Student updated successfully!</p>';
        } elseif (isset($executed)) {
          echo '<p class="error-message">Failed to update student. Please try again.</p>';
        }
        ?>
      </form>
    </div>
  </body>
</html>
