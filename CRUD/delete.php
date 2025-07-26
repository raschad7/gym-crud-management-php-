<?php
require_once "config.php";

if (isset($_POST['delete_ids'])) {
  $delete_ids = $_POST['delete_ids'];

  $delete_ids = array_map('intval', $delete_ids);

  $ids_string = implode(',', $delete_ids);

  $delete_query = "DELETE FROM Classes WHERE id IN ($ids_string)";

  $delete_result = mysqli_query($link, $delete_query);


  if ($delete_result) {
    echo "Selected rows deleted successfully.";
  } else {
    echo "Error deleting rows: " . mysqli_error($link);
  }
} else {
  echo "Invalid request.";
}

mysqli_close($link);