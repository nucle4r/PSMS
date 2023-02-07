<?php
session_start();
include 'db_connect.php';


// Get pet_id from the ajax call
$inventory_id = $_POST['inventory_id'];

// Retrieve species from the pets table
$query = "SELECT Pets.pid, Pets.species, Pets.breed, Pets.age, Pets.price, Inventory.quantity FROM Inventory JOIN Pets ON Inventory.pet_id = Pets.pid WHERE Inventory.id = $inventory_id";
$result = mysqli_query($conn, $query);
$pet = mysqli_fetch_assoc($result);

// Return the species as a JSON object
echo json_encode($pet);