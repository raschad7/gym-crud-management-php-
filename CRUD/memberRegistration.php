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

$query_create_table_members = "CREATE TABLE IF NOT EXISTS Members (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  surname VARCHAR(255) NOT NULL,
  phoneNum VARCHAR(20) NOT NULL,
  DOB DATE NOT NULL,
  gender VARCHAR(10) NOT NULL,
  height INT NOT NULL,
  weight INT NOT NULL,
  experience INT NOT NULL,
  program VARCHAR(50) NOT NULL
)";
mysqli_query($link, $query_create_table_members);

$name_err = "";
$surname_err = "";

$phoneNum_err = "";
$DOB_err = "";
$gender_err = "";
$height_err = "";
$weight_err = "";
$exp_err = "";
$prg_err = "";


if (isset($_POST['create'])) {
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $phoneNum = $_POST['phoneNum'];
  $DOB = $_POST['DOB'];
  $gndr = $_POST['gndr'];
  $height = $_POST['height'];
  $weight = $_POST['weight'];
  $exp = $_POST['exp'];
  $prg = $_POST['prg'];

  $sqlMembers = "INSERT INTO Members (name, surname, phoneNum, DOB, gender, height, weight, experience, program) 
            VALUES ('$name', '$surname', '$phoneNum', '$DOB', '$gndr', '$height', '$weight', '$exp', '$prg')";

  if (mysqli_query($link, $sqlMembers)) {
    echo '<script>alert("Member registered successfully!"); window.location.href = "membersTable.php";</script>';
    exit();
  } else {
    echo "Error: " . $sqlMembers . "<br>" . mysqli_error($link);
  }
}

mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Member Registration</title>
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <h2 style="text-align: center;">Member Registration</h2>
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <span class="error"><?php echo $name_err; ?></span>
      </div>
      <div class="form-group">
        <label for="surname">Surname:</label>
        <input type="text" name="surname" required>
        <span class="error"><?php echo $surname_err; ?></span>
      </div>
      <div class="form-group">
        <label for="phoneNum">Phone Number:</label>
        <input type="text" name="phoneNum" placeholder="+90 ..." required>
        <span class="error"><?php echo $phoneNum_err; ?></span>
      </div>
      <div class="form-group">
        <label for="DOB">Date Of Birth:</label>
        <input type="date" name="DOB" required>
        <span class="error"><?php echo $DOB_err; ?></span>
      </div>
      <div class="form-group">
        <label>Gender:</label> <br>
        <label style="font-weight: bold;"><input type="radio" name="gndr" value="Male" required> Male</label><br>
        <label style="font-weight: bold;"><input type="radio" name="gndr" value="Female" required> Female</label><br>
        <span class="error"><?php echo $gender_err; ?></span>
      </div><br>
      <div class="form-group">
        <label for="height">Height:</label>
        <span id="heightValue">150</span> cm
        <span class="error"><?php echo $height_err; ?></span>
        <input type="range" name="height" min="130" max="220" value="150" required>

      </div>
      <div class="form-group">
        <label for="weight">Weight:</label>
        <span id="weightValue">60</span> kg
        <span class="error"><?php echo $weight_err; ?></span>
        <input type="range" name="weight" min="35" max="200" value="60" required>

      </div>
      <div class="form-group">
        <label for="exp">Fitness Experience:</label>
        <span id="expValue">5</span>
        <span class="error"><?php echo $exp_err; ?></span>
        <input type="range" name="exp" min="0" max="10" value="5" required>

      </div>
      <div class="form-group">
        <label for="prg">Program:</label>
        <select name="prg">
          <option value="Lose Weight">Lose Weight</option>
          <option value="Gain Muscles">Gain Muscles</option>
          <option value="Maintain Fitness">Maintain Fitness</option>
          <option value="Improve Endurance">Improve Endurance</option>
          <option value="Strength Training">Strength Training</option>
          <option value="Flexibility">Flexibility</option>
          <option value="Custom Program">Custom Program</option>
        </select>
      </div>
      <button type="submit" name="create">Create</button>
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