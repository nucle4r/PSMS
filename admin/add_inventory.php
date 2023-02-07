<?php
session_start();
include 'db_connect.php';


$pet_id1 = $_POST['pet_id'];
$query1 = "SELECT * FROM inventory WHERE pet_id = '$pet_id1'";
$result1 = mysqli_query($conn, $query1);
if (mysqli_num_rows($result1) == 0) {

  // Get form data
  $pet_id = $_POST['pet_id'];
  $min_quantity = $_POST['min_quantity'];
  $max_quantity = $_POST['max_quantity'];

  // Insert inventory into the inventory table
  $query = "INSERT INTO inventory (pet_id, min_quantity, quantity,  max_quantity) VALUES ('$pet_id', '$min_quantity', 0, '$max_quantity')";
  $result = mysqli_query($conn, $query);

  if ($result) {
    // Inventory added successfully
    header('Location: inventory.php');
  } else {
    // Error adding inventory
    echo "Error adding inventory: " . mysqli_error($conn);
  }
} else {
  // Error adding inventory
  echo "Error adding inventory: Inventory Already Exists";
}
?>