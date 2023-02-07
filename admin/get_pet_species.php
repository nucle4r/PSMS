<?php
session_start();
include 'db_connect.php';


// Get pet_id from the ajax call
$pet_id = $_POST['pet_id'];

// Retrieve species from the pets table
$query = "SELECT species FROM pets WHERE pid = '$pet_id'";
$result = mysqli_query($conn, $query);
$pet = mysqli_fetch_assoc($result);

// Return the species as a JSON object
echo json_encode($pet);
