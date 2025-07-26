<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    body {
      margin: 0;
      font-family: 'Raleway', sans-serif;
    }

    nav {
      background-color: #7fdbbb;
      overflow: hidden;
    }

    nav a {
      float: left;
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }

    nav a:hover {
      background-color: #50b893;
      color: white;
    }

    .logout {
      float: right;
      background-color: #e74c3c;
    }

    @media screen and (max-width: 600px) {
      nav a {
        float: none;
        width: 100%;
        text-align: left;
      }

      .logout {
        float: none;
      }
    }
  </style>
</head>

<body>

  <nav>
    <a href="land.php">Landing Page</a>
    <a href="membersTable.php">Member Table</a>
    <a href="classesTable.php">Class Table</a>
    <a href="index.php" class="logout">Log Out</a>
  </nav>

</body>

</html>