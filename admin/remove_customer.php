<?php
session_start();
include 'db_connect.php';

  // Check for customer id
  if (isset($_GET['uid'])) {
    // Get the customer id
    $uid = $_GET['uid'];

    // Delete the customer from the database
    $query = "DELETE FROM users WHERE uid = '$uid'";
    mysqli_query($conn, $query);

    // Redirect to the customers page
    header('Location: customers.php');
  }
?>
