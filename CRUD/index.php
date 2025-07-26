<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'webgym');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($link === false) {
  die("ERROR: " . mysqli_connect_error());
}


// User registration
if (isset($_POST['signup'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = password_hash($_POST['pswd'], PASSWORD_DEFAULT);

  $sql = "INSERT INTO Admins (username, email, password) VALUES ('$username', '$email', '$password')";

  if (mysqli_query($link, $sql)) {
    echo "Registration successful!";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
  }
}

// User login
if (isset($_POST['login'])) {
  $username = $_POST['txt'];
  $password = $_POST['pswd'];

  $sql = "SELECT * FROM Admins WHERE username = '$username'";
  $result = mysqli_query($link, $sql);

  if ($result) {
    $row = mysqli_fetch_assoc($result);
    if ($row && password_verify($password, $row['password'])) {
      header("Location: land.php");
      exit();
    } else {
      echo '<script>alert("Invalid User"); </script>';
    }
  } else {
    echo "User not found";
  }
}

mysqli_close($link);
?>
<!DOCTYPE html>
<html>

<head>
  <title>Log In page</title>
  <link rel="stylesheet" type="text/css" href="slide navbar style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:weight@200&display=swap">

  <style>
    body {
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      font-family: 'Raleway', sans-serif;
      background: linear-gradient(to bottom, #7fdbbb, #fdfdff);
    }

    .main {
      width: 500px;
      height: 600px;
      background: red;
      overflow: hidden;
      background: url("https://doc-08-2c-docs.googleusercontent.com/docs/securesc/68c90smiglihng9534mvqmq1946dmis5/fo0picsp1nhiucmc0l25s29respgpr4j/1631524275000/03522360960922298374/03522360960922298374/1Sx0jhdpEpnNIydS4rnN4kHSJtU1EyWka?e=view&authuser=0&nonce=gcrocepgbb17m&user=03522360960922298374&hash=tfhgbs86ka6divo3llbvp93mg4csvb38") no-repeat center/ cover;
      border-radius: 10px;
      box-shadow: 5px 20px 50px #000;
    }

    #chk {
      display: none;
    }

    .signup {
      position: relative;
      width: 100%;
      height: 100%;
    }

    label {
      color: #525351;
      font-size: 2.8em;
      justify-content: center;
      display: flex;
      margin: 60px;
      cursor: pointer;
      transition: .5s ease-in-out;
    }

    input {
      width: 60%;
      height: 20px;
      background: whitesmoke;
      justify-content: center;
      display: flex;
      margin: 20px auto;
      padding: 10px;
      border: none;
      outline: none;
      border-radius: 5px;
    }

    button {
      width: 60%;
      height: 40px;
      margin: 10px auto;
      justify-content: center;
      display: block;
      color: #fff;
      background: #525351;
      font-size: 1em;
      font-weight: bold;
      margin-top: 20px;
      outline: none;
      border: none;
      border-radius: 5px;
      transition: .2s ease-in;
      cursor: pointer;
    }

    button:hover {
      background: #7fdbbb;
    }

    .login {
      height: 460px;
      background: #E8E9E6;
      border-radius: 60% / 10%;
      transform: translateY(-180px);
      transition: .8s ease-in-out;
    }

    .login label {
      color: #525351;
      transform: scale(.6);
    }

    #chk:checked~.login {
      transform: translateY(-500px);
    }

    #chk:checked~.login label {
      transform: scale(1);
    }

    #chk:checked~.signup label {
      transform: scale(.6);
    }
  </style>


</head>

<body>
  <div class="main">
    <input type="checkbox" id="chk" aria-hidden="true" />

    <div class="signup">
      <form method="post" action="">
        <label for="chk" aria-hidden="true">Sign up</label>
        <input type="text" name="username" placeholder="User name" required="" />
        <input type="email" name="email" placeholder="Email" required="" />
        <input type="password" name="pswd" placeholder="Password" required="" />
        <button type="submit" name="signup">Sign up</button>
      </form>
    </div>

    <div class="login">
      <form action="" method="post">
        <label for="chk" aria-hidden="true">Login</label>
        <input type="text" name="txt" placeholder="User name" required="" />
        <input type="password" name="pswd" placeholder="Password" required="" />
        <button type="submit" name="login">Log In</button>
      </form>



    </div>
  </div>
</body>

</html>