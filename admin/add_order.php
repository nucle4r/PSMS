<?php
session_start();
include 'db_connect.php';

// Check for form submission
if (isset($_POST['pet_id']) && isset($_POST['customer_id']) && isset($_POST['quantity']) && isset($_POST['total_price'])) {			
    // Get form data
    $pet_id = $_POST['pet_id'];
    $user_id= $_POST['customer_id'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];

    // Insert new order into the database
    $query = "INSERT INTO orders (pet_id, user_id, quantity, total_price) VALUES ('$pet_id', '$user_id', '$quantity', '$total_price')";
    mysqli_query($conn, $query);

    // Redirect to the orders page
    header('Location: orders.php');
} else {
    echo 'Fill All Fields and Try Again.';
}
?>