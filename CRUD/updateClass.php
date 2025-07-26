<?php
require_once "config.php";
require_once "header.php";

$id = $_GET['id'];

$sqlGetClass = "SELECT * FROM Classes WHERE id = $id";
$resultGetClass = mysqli_query($link, $sqlGetClass);

$classType_err = "";
$trainerName_err = "";
$dateTime_err = "";
$classImage_err = "";
$classDescription_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
  $classType = $_POST['classType'];
  $trainerName = $_POST['trainerName'];
  $dateTime = $_POST['dateTime'];
  $classImage = $_POST['classImage'];
  $classDescription = $_POST['classDescription'];

  $sqlUpdateClass = "UPDATE classes SET classType='$classType', trainerName='$trainerName', dateTime='$dateTime', classDescription='$classDescription' WHERE id=$id";

  if (mysqli_query($link, $sqlUpdateClass)) {
    echo '<script>alert("Class updated successfully!"); window.location.href = "classesTable.php";</script>';
    exit();
  } else {
    echo "Error updating class: " . mysqli_error($link);
  }
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Class</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
      /* Dark grey text color */
    }

    input[type="text"],
    input[type="datetime-local"],
    textarea {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      margin-bottom: 10px;
      box-sizing: border-box;
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
    }
  </style>
</head>

<body>
  <div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="post">
      <h2 style="text-align: center;">Update Class</h2>
      <?php
      while ($row = mysqli_fetch_array($resultGetClass)) {
      ?>
        <div class="form-group">
          <label for="classType">Class Name:</label>
          <input type="text" name="classType" value="<?php echo $row['classType']; ?>" required>
          <span class="error"><?php echo $classType_err; ?></span>
        </div>
        <div class="form-group">
          <label for="trainerName">Instructor:</label>
          <input type="text" name="trainerName" value="<?php echo $row['trainerName']; ?>" required>
          <span class="error"><?php echo $trainerName_err; ?></span>
        </div>
        <div class="form-group">
          <label for="dateTime">Date and Time:</label>
          <input type="datetime-local" name="dateTime" value="<?php echo $row['dateTime']; ?>" required>
          <span class="error"><?php echo $dateTime_err; ?></span>
        </div>
        <div class="form-group">
          <label for="classImage">Class Illustrative Image:</label>
          <input type="file" name="classImage" accept="image/*">
        </div>
        <div class="form-group">
          <label for="classDescription">Class Description:</label>
          <textarea name="classDescription" rows="4" cols="50" required><?php echo $row['classDescription']; ?></textarea>
          <span class="error"><?php echo $classDescription_err; ?></span>
        </div>
        <button type="submit" name="update">Update Class</button>
      <?php
      }
      ?>
    </form>
  </div>
</body>
</html>