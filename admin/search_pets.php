<?php
session_start();
include 'db_connect.php';

if (isset($_POST['pet_breed'])) {
    // Get pet breed from the form
    $pet_breed = $_POST['pet_breed'];

    // Search for pet by breed
    $query = "SELECT * FROM pets WHERE breed like '%$pet_breed%' LIMIT 5";
    $result = mysqli_query($conn, $query);
    $pets = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $pets[] = $row;
    }
}
// Return pet information as JSON
echo json_encode($pets);
?>