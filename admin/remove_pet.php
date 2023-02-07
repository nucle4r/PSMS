<?php
session_start();
include 'db_connect.php';

  // Check for pet id
  if (isset($_GET['pid'])) {
    // Get the pet id
    $pid = $_GET['pid'];

    // Delete the pet from the database
    $query = "DELETE FROM pets WHERE pid = '$pid'";
    mysqli_query($conn, $query);

    // Redirect to the pets page
    header('Location: pets.php');
  }
?>
