<?php
require_once "header.php";

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    require_once "config.php";

    $sql = "SELECT * FROM Classes WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = trim($_GET["id"]);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {

                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                $classType = $row["classType"];
                $trainerName = $row["trainerName"];
                $dateTime = $row["dateTime"];
                $classDescription = $row["classDescription"];
            } else {
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    mysqli_stmt_close($stmt);

    mysqli_close($link);
} else {
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Class</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:weight@200&display=swap">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Raleway', sans-serif;
        }

        .wrapper {
            width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #7fdbbb;
        }

        label {
            font-weight: bold;
            color: #000000;

            display: inline-block;
            width: 150px;

        }

        .form-group {
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 0;
            color: #525351;
            display: inline-block;

        }

        .btn-primary {
            background-color: #7fdbbb;
            border-color: #525351;
        }

        .btn-primary:hover {
            background-color: #525351;
            border-color: #000;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Class</h1>
                    <div class="form-group">
                        <label>Class Name:</label>
                        <p><b><?php echo $row["classType"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Instructor: </label>
                        <p><b><?php echo $row["trainerName"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Date and Time: </label>
                        <p><b><?php echo $row["dateTime"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Class Description: </label>
                        <p><b><?php echo $row["classDescription"]; ?></b></p>
                    </div>
                    <p><a href="classesTable.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>