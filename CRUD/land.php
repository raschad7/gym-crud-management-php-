<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <script src="https://kit.fontawesome.com/d92630495d.js" crossorigin="anonymous"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <title>Main page</title>

  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&family=Poppins:wght@700&display=swap" rel="stylesheet">

  <style>
    * {
      box-sizing: border-box;
    }

    #logout-btn {
      position: fixed;
      bottom: 50px;
      right: 50px;
      background-color: gray;
      color: #7fdbbb;
      padding: 0.5rem 2rem;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
      border: 0.1rem solid #7fdbbb;

    }

    #logout-btn:hover {
      background-color: #6d44b8;
    }

    body {
      background: #fdfdff;
      margin: 0;
      font-size: 16px;
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: space-between;
      height: 100vh;
      padding: 2rem;
      font-family: "Raleway", sans-serif;
    }

    #image-section {
      width: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 2rem;
    }

    .header-image {
      width: 110%;
      height: 695px;
      opacity: 0.8;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    #content {
      width: 50%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-between;
    }

    #content-text {
      font-family: "Raleway", sans-serif;
      font-size: 1.5rem;
      text-align: center;
      margin-top: 2rem;
    }

    h1,
    h3 {
      font-family: "Raleway", sans-serif;
      font-weight: 700;
      color: #303c4e;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    }

    .button-container {
      display: flex;
      flex-direction: column;
      gap: 2rem;
      margin-top: 2rem;
    }

    button {
      background-color: #7fdbbb;
      padding: 0.5rem 2rem;
      border: 0.1rem solid #7fdbbb;
      border-radius: 0.4rem;
      font-family: "Raleway", sans-serif;
      font-size: 1.2rem;
      font-weight: 700;
      color: #303c4e;
      transition: 0.5s ease;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    }

    button:hover {
      background-color: #50b893;
      cursor: pointer;
      color: white;
      transition: 0.5s;
    }

    @media (max-width: 600px) {
      body {
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }

      #image-section {
        width: 100%;
      }

      .header-image {
        max-width: 100%;
      }

      #content {
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <div id="image-section">
    <img class="header-image" src="https://img.freepik.com/free-vector/gradient-home-gym-with-machines_52683-55393.jpg?w=996&t=st=1704561280~exp=1704561880~hmac=a35efdadcfa75832f189426636a80635a0f4659960ec74e64c0bdaf70ca8a4dd" alt="a business woman and man standing back to back to each other and smiling">
  </div>
  <div id="content">
    <div id="content-text">
      <h1>Gym Database <br> System</h1>
      <h3>Select a Table</h3>
      <form action="" method="post">
        <button type="submit" name="membersBtn">Members Table</button>
        <button type="submit" name="classesBtn">Classes Table</button>
      </form>

      <?php
      if (isset($_POST['membersBtn'])) {
        header("Location: membersTable.php");
        exit();
      }

      if (isset($_POST['classesBtn'])) {
        header("Location: classesTable.php");
        exit();
      }
      ?>
    </div>
    <div id="logout-btn" onclick="logout()">Logout</div>
    <script>
      function logout() {
        window.location.href = 'index.php';
      }
    </script>
  </div>
</body>

</html>