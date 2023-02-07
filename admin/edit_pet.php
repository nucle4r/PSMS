<?php
session_start();
include 'db_connect.php';

// Check for form submission
if (isset($_POST['breed'])) {
    // Get form data
    $pid = $_POST['pid'];
    $breed = $_POST['breed'];
    $species = $_POST['species'];
    $age = $_POST['age'];
    $price = $_POST['price'];

    // Update pet in the database
    $query = "UPDATE pets SET breed='$breed', species='$species', age='$age', price='$price' WHERE pid='$pid'";
    mysqli_query($conn, $query);

    // Redirect to the pets page
    header('Location: pets.php');
}
?>