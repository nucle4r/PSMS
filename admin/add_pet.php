<?php
session_start();
include 'db_connect.php';

// Check for form submission
if (isset($_POST['breed'])) {
    // Get form data
    $breed = $_POST['breed'];
    $species = $_POST['species'];
    $age = $_POST['age'];
    $price = $_POST['price'];

    // Insert new pet into the database
    $query = "INSERT INTO pets (breed, species, age, price) VALUES ('$breed', '$species', '$age', '$price')";
    mysqli_query($conn, $query);

    // Redirect to the pets page
    header('Location: pets.php');
}
?>