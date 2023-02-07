<?php
session_start();
include 'db_connect.php';

  // Check for inventory id
  if (isset($_GET['id'])) {
    // Get the inventory id
    $inventory_id = $_GET['id'];

    // Delete the inventory from the database
    $query = "DELETE FROM inventory WHERE id = '$inventory_id'";
    mysqli_query($conn, $query);

    // Redirect to the inventory page
    header('Location: inventory.php');
  }
?>
