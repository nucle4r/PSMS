<?php
session_start();
include 'db_connect.php';

// Check for form submission
if (isset($_POST['quantity'])) {
    //Get form data
    $inventory_id = $_POST['inventory_id'];
    $pet_id = $_POST['pet_id'];
    $user_id = $_POST['user_id'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];

    // Insert new order into the database
    $query = "INSERT INTO orders (user_id, pet_id, quantity, total_price) VALUES ('$user_id', '$pet_id', '$quantity', '$total_price')";
    mysqli_query($conn, $query);

    // Redirect to the orders page
    header('Location: home.php');
}
?>