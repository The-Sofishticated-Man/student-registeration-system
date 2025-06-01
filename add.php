<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add a Student</title>
    <link rel="stylesheet" href="./css/addStyle.css" />
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
      <form method="post" enctype="multipart/form-data" action="addStudent.php" >
        <h1 class="form-heading">Add a Student</h1>
        <p class="form-description">Fill the form bellow to add a student</p>
        <div class="form-group">
          <label for="firstName">First Name:</label>
          <input type="text" id="firstName" name="firstName" required />
        </div>
        <div class="form-group">
          <label for="lastName">Last Name:</label>
          <input type="text" id="lastName" name="lastName" required />
        </div>
        <div class="form-group">
        <label for="age">Age:</label>
          <input type="number" id="age" name="age" required />
        </div>
          <div class="form-group">
            <label for="major">Major:</label>
          <input type="text" id="major" name="major" required />
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required />
        </div>
        <div class="form-group">
          <label for="entryDate">Entry Date:</label>
          <input
            type="date"
            id="entryDate"
            name="entryDate"
            required
          />
        </div>
        <div class="form-group">
          <label for="profilePicture">Profile Picture:</label>
          <input
            type="file"
            id="profilePicture"
            name="profilePicture"
            accept="image/*"
          />
        </div>
        <button type="submit" class="submit-btn" name="submit">Submit</button>
       
      </form>
  </body>

</html>

