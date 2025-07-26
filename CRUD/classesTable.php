<?php
require_once "config.php";
require_once "header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
  $selected_ids = $_POST["selected_ids"];
  foreach ($selected_ids as $id) {
    $stmt = mysqli_prepare($link, "DELETE FROM Classes WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
  }
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
$whereClause = '';
if (!empty($search)) {
  $whereClause = "WHERE classType LIKE '%$search%' OR trainerName LIKE '%$search%' OR dateTime LIKE '%$search%'";
}

$sql = "SELECT * FROM Classes $whereClause";
$result = mysqli_query($link, $sql);

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Class Table</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:weight@200&display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

  <style>
    body {
      background-color: #fdfdff;
      font-size: 16px;
      font-family: 'Raleway', sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
    }

    .container {
      margin-top: 20px;
    }

    .input-group {
      width: 100%;
      margin-bottom: 30px;
    }

    .form-control {
      border-radius: 5px;

    }

    .btn-info,
    .btn-success,
    .btn-danger {
      margin-right: 10px;
    }

    .btn-info {
      background-color: #7fdbbb;
      color: #303c4e;
      border: none;
      border-radius: 5px;
      font-weight: bold;
    }

    .btn-info:hover {
      background-color: #50b893;
    }

    .btn-success {
      background-color: #50b893;
      color: white;
      border: none;
      border-radius: 5px;
      font-weight: bold;
    }

    .btn-success:hover {
      background-color: #389978;
    }

    .btn-danger {
      background-color: #ff5c5c;
      color: white;
      border: none;
      border-radius: 5px;
      font-weight: bold;
    }

    .btn-danger:hover {
      background-color: #e74c3c;
    }

    .table-wrapper {
      width: 100%;
    }

    .table-title {
      margin-bottom: 20px;
    }

    #classesTable th,
    #classesTable td {
      text-align: center;
    }
  </style>
  <script>
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();
      var checkbox = $('table tbody input[type="checkbox"]');
      $("#selectAll").click(function() {
        if (this.checked) {
          checkbox.each(function() {
            this.checked = true;
          });
        } else {
          checkbox.each(function() {
            this.checked = false;
          });
        }
      });
      checkbox.click(function() {
        if (!this.checked) {
          $("#selectAll").prop("checked", false);
        }
      });
      $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#classesTable tbody tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
      });
    });
  </script>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search by Class Name, Instructor, or Date and Time" id="search" name="search" value="<?= htmlspecialchars($search) ?>">
          <span class="input-group-btn">
            <button class="btn btn-info" type="submit">Search</button>
          </span>
        </div>
      </div>
    </div>

    <div class="table-wrapper">
      <div class="table-title">
        <div class="row">
          <div class="col-sm-6">
            <h2>Manage <b>Class</b></h2>
          </div>
          <div class="col-sm-6">
            <form method="post" id="deleteForm">
              <a href="classRegistration.php" class="btn btn-success">
                <i class="material-icons">&#xE147;</i>
                <span>Add New Class</span>
              </a>
              <button type="button" class="btn btn-danger" onclick="deleteSelectedRows()">
                <i class="material-icons">&#xE15C;</i>
                <span>Delete</span>
              </button>
              <input type="hidden" name="delete" value="1">
              <input type="hidden" id="selectedIds" name="selected_ids[]">
            </form>
          </div>
        </div>
      </div>
      <?php
      if ($result) {
        if (mysqli_num_rows($result) > 0) {
          echo '<table class="table table-bordered table-striped" id="classesTable">';
          echo "<thead>";
          echo "<tr>";
          echo "<th>#</th>";
          echo "<th>Select</th>";
          echo "<th>Class Name</th>";
          echo "<th>Instructor Name</th>";
          echo "<th>Date and Time</th>";
          echo "</tr>";
          echo "</thead>";
          echo "<tbody>";
          while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td><input type='checkbox' class='checkbox' value='" . $row['id'] . "'></td>";
            echo "<td>" . $row['classType'] . "</td>";
            echo "<td>" . $row['trainerName'] . "</td>";
            echo "<td>" . $row['dateTime'] . "</td>";
            echo "<td><a href='readClass.php?id=" . $row['id'] . "'><span class='material-symbols-outlined'>visibility</span></a></td>";
            echo "<td><a href='updateClass.php?id=" . $row['id'] . "'><span class='material-symbols-outlined'>edit</span></a></td>";


            echo "</tr>";
          }
          echo "</tbody>";
          echo "</table>";
        } else {
          echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }
      ?>
    </div>
  </div>

  <form method="post" id="deleteForm">
    <input type="hidden" name="delete" value="1">
    <input type="hidden" id="selectedIds" na me="selected_ids[]">
  </form>
  <script>
    function deleteSelectedRows() {
      var selectedIds = [];
      $('.checkbox:checked').each(function() {
        selectedIds.push($(this).val());
      });
      $('#selectedIds').val(selectedIds);
      $('#deleteForm').submit();
    }
  </script>
</body>

</html>