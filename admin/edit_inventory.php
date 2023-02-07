<?php
session_start();
include 'db_connect.php';

// Check for form submission
if (isset($_POST['min_quantity']) && isset($_POST['min_quantity'])) {
    // Get form data
    $inventory_id = $_POST['id'];
    $min_quantity = $_POST['min_quantity'];
    $max_quantity = $_POST['max_quantity'];

    // Update inventory in the database
    $query = "UPDATE inventory SET min_quantity='$min_quantity', max_quantity='$max_quantity' WHERE id='$inventory_id'";
    mysqli_query($conn, $query);

    // Redirect to the inventory page
    header('Location: inventory.php');
}
?>