<?php
require_once "config.php";
require_once "header.php";

$id = $_GET['id'];

$sqlGetMember = "SELECT * FROM Members WHERE id = $id";
$resultGetMember = mysqli_query($link, $sqlGetMember);

$name_err = "";
$surname_err = "";
$phoneNum_err = "";
$DOB_err = "";
$gender_err = "";
$height_err = "";
$weight_err = "";
$exp_err = "";
$prg_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $phoneNum = $_POST['phoneNum'];
  $DOB = $_POST['DOB'];
  $gndr = $_POST['gndr'];
  $height = $_POST['height'];
  $weight = $_POST['weight'];
  $exp = $_POST['exp'];
  $prg = $_POST['prg'];

  $sqlUpdateMember = "UPDATE Members SET name='$name', surname='$surname', phoneNum='$phoneNum', DOB='$DOB', gender='$gndr', height='$height', weight='$weight', experience='$exp', program='$prg' WHERE id=$id";

  if (mysqli_query($link, $sqlUpdateMember)) {
    echo '<script>alert("Member updated successfully!"); window.location.href = "membersTable.php";</script>';
    exit();
  } else {
    echo "Error updating member: " . mysqli_error($link);
  }
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Member</title>
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
    }
  </style>
</head>

<body>
  <div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="post">
      <h2 style="text-align: center;">Update Member</h2>
      <?php
      while ($row = mysqli_fetch_array($resultGetMember)) {
      ?>
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
          <span class="error"><?php echo $name_err; ?></span>
        </div>
        <div class="form-group">
          <label for="surname">Surname:</label>
          <input type="text" name="surname" value="<?php echo $row['surname']; ?>" required>
          <span class="error"><?php echo $surname_err; ?></span>
        </div>
        <div class="form-group">
          <label for="phoneNum">Phone Number:</label>
          <input type="text" name="phoneNum" value="<?php echo $row['phoneNum']; ?>" placeholder="+90 ..." required>
          <span class="error"><?php echo $phoneNum_err; ?></span>
        </div>
        <div class="form-group">
          <label for="DOB">Date Of Birth:</label>
          <input type="date" name="DOB" value="<?php echo $row['DOB']; ?>" required>
          <span class="error"><?php echo $DOB_err; ?></span>
        </div>
        <div class="form-group">
          <label>Gender:</label>
          <input type="radio" name="gndr" value="Male" <?php echo ($row['gender'] == 'Male') ? 'checked' : ''; ?> required> Male
          <input type="radio" name="gndr" value="Female" <?php echo ($row['gender'] == 'Female') ? 'checked' : ''; ?> required> Female
          <span class="error"><?php echo $gender_err; ?></span>
        </div>
        <div class="form-group">
          <label for="height">Height:</label>
          <input type="range" name="height" min="130" max="220" value="<?php echo $row['height']; ?>" required>
          <span id="heightValue"><?php echo $row['height']; ?></span> cm
          <span class="error"><?php echo $height_err; ?></span>
        </div>
        <div class="form-group">
          <label for="weight">Weight:</label>
          <input type="range" name="weight" min="35" max="200" value="<?php echo $row['weight']; ?>" required>
          <span id="weightValue"><?php echo $row['weight']; ?></span> kg
          <span class="error"><?php echo $weight_err; ?></span>
        </div>
        <div class="form-group">
          <label for="exp">Fitness Experience:</label>
          <input type="range" name="exp" min="0" max="10" value="<?php echo $row['experience']; ?>" required>
          <span id="expValue"><?php echo $row['experience']; ?></span>
          <span class="error"><?php echo $exp_err; ?></span>
        </div>
        <div class="form-group">
          <label for="prg">Program:</label>
          <select name="prg">
            <option value="loseWeight" <?php echo ($row['program'] == 'loseWeight') ? 'selected' : ''; ?>>Lose Weight</option>
            <option value="gainMuscles" <?php echo ($row['program'] == 'gainMuscles') ? 'selected' : ''; ?>>Gain Muscles</option>
            <option value="maintainFitness" <?php echo ($row['program'] == 'maintainFitness') ? 'selected' : ''; ?>>Maintain Fitness</option>
            <option value="improveEndurance" <?php echo ($row['program'] == 'improveEndurance') ? 'selected' : ''; ?>>Improve Endurance</option>
            <option value="strengthTraining" <?php echo ($row['program'] == 'strengthTraining') ? 'selected' : ''; ?>>Strength Training</option>
            <option value="flexibility" <?php echo ($row['program'] == 'flexibility') ? 'selected' : ''; ?>>Flexibility</option>
            <option value="customProgram" <?php echo ($row['program'] == 'customProgram') ? 'selected' : ''; ?>>Custom Program</option>
          </select>
        </div>
        <button type="submit" name="update">Update</button>
      <?php
      }
      ?>
    </form>
  </div>

  <script>
    document.querySelectorAll('input[type="range"]').forEach(function(el) {
      el.addEventListener('input', function() {
        document.getElementById(el.name + 'Value').innerText = el.value;
      });
    });
  </script>
</body>

</html>