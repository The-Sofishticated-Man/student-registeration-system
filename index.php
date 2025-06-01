<?php
require './initConn.php';
if(isset($_GET["message"])){
  echo '<script>alert("'.htmlspecialchars($_GET["message"]).'")</script>';
}else if(isset($_GET["error"])){
  echo '<script>alert("'.htmlspecialchars($_GET["error"]).'")</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>THE AMAZING STUDENT RECORD - IJWSTJMB</title>
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    rel="stylesheet"
    />
    <link rel="stylesheet" href="./css/homeStyle.css" />
  </head>
  <body>
    <nav>
      <a href="#"><img class="logo" src="./img/logo.jpg" alt="logo" /></a>
      <form method="GET" action="" class="search-form">
        <input type="text" name="search" placeholder="Search by name" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" />
        <button type="submit"><i class="fas fa-search"></i> Search</button>
      </form>
      <a href="add.php" class="add-student">Add Student</a>
    </nav>
    <main>
      <?php
      // Fetch student data from the database with search functionality
      $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
      $sql = "SELECT * FROM student";
      if (!empty($search)) {
        $sql .= " WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%'";
      }
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<div class="student-card">';
            $profilePicture = !empty($row['profile_picture']) ? './uploads/' . $row['profile_picture'] : './uploads/.jpg';
            echo '<img src="' . $profilePicture . '" alt="Student Image" class="student-image" />';
          echo '<h2 class="student-name">' . $row['first_name'] . ' ' . $row['last_name'] . '</h2>';
          echo '<p class="student-age">' . $row['age'] . ' years old</p>';
          echo '<p class="student-major">' . $row['major'] . '</p>';
          echo '<a class="student-email" href="mailto:' . $row['email'] . '">' . $row['email'] . '</a>';
          echo '<div class="student-actions">';
          // 
            echo '<a href="editStudent.php?id=' . $row['StudentID'] . '" class="edit-student"><i class="fas fa-edit"></i> Edit</a>';
          // Remove student button with confirmation
            echo '<form method="POST" action="removeStudent.php" class="remove-student-form" onsubmit="return confirm(\'Are you sure you want to remove this student?\');">';
            echo '<input class="hidden" type="hidden" name="student_id" value="' . $row['StudentID'] . '">';
            echo '<button type="submit" class="remove-student"><i class="fas fa-trash"></i> Remove</button>';
            echo '</form>';

          echo '</div>';
          echo '<p class="student-registration-date">Registered on: ' . $row['entry_date'] . '</p>';
          echo '</div>';
        }
      } else {
        echo '<h1 class="no-students">No students found.</h1>';
      }
      if(isset($_GET["message"])){
        echo '<script>alert("'.htmlspecialchars($_GET["message"]).'")</script>';
      }else if(isset($_GET["error"])){
        echo '<script>alert("'.htmlspecialchars($_GET["error"]).'")</script>';
      }
      ?>
    </main>
    <footer class="site-footer">
      <p>made with 💙 by <a href="https://github.com/The-Sofishticated-Man" target="_blank">The Sofishticated Man</a></p>
    </footer>
  </body>
</html>
