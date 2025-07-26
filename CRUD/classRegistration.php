<?php
require_once "header.php";

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'webgym');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($link === false) {
  die("ERROR: " . mysqli_connect_error());
}
$query_create_table = "CREATE TABLE IF NOT EXISTS classes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  classType VARCHAR(255) NOT NULL,
  trainerName VARCHAR(255) NOT NULL,
  dateTime DATETIME NOT NULL,
  classImage VARCHAR(255),
  classDescription TEXT NOT NULL
)";
mysqli_query($link, $query_create_table);

if (isset($_POST['createClass'])) {
  $classType = $_POST['classType'];
  $trainerName = $_POST['trainerName'];
  $dateTime = $_POST['dateTime'];
  $classDescription = $_POST['classDescription'];

  $sql = "INSERT INTO classes (classType, trainerName, dateTime,  classDescription) 
            VALUES ('$classType', '$trainerName', '$dateTime',  '$classDescription')";

  if (mysqli_query($link, $sql)) {
    echo '<script>alert("Class registered successfully!"); window.location.href = "classesTable.php";</script>';
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
  }
}

$sqlFetchData = "SELECT * FROM classes";
$result = mysqli_query($link, $sqlFetchData);



mysqli_close($link);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Class Registration</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:weight@200&display=swap">

  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Raleway', sans-serif;
    }

    .container {
      width: 600px;
      margin: 50px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      color: #7fdbbb;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
      color: #495057;
    }

    input[type="text"],
    input[type="date"],
    select {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      margin-bottom: 10px;
      box-sizing: border-box;
    }

    input[type="range"] {
      width: 80%;
    }

    button {
      background-color: #50b893;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #389978;
    }

    .error {
      color: #dc3545;
      /* Red color for error messages */
    }
  </style>
</head>

<body>
  <div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <h2 style="text-align: center;">Class Registration</h2>

      <div class="form-group">
        <label for="classType">Class Name:</label>
        <input type="text" name="classType" required>
      </div>

      <div class="form-group">
        <label for="trainerName">Instructor:</label>
        <input type="text" name="trainerName" required>
      </div>

      <div class="form-group">
        <label for="dateTime">Date and Time:</label>
        <input type="datetime-local" name="dateTime" required>
      </div>



      <div class="form-group">
        <label for="classDescription">Class Description:</label> <br>
        <textarea name="classDescription" rows="4" cols="50" required></textarea>
      </div>

      <button type="submit" name="createClass">Create Class</button>
    </form>
  </div>
</body>

</html>