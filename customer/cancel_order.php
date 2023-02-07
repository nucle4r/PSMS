<?php
session_start();
include 'db_connect.php';

// Check for form submission
if (isset($_GET['oid'])) {
    // Get form data
    $oid = $_GET['oid'];

    // Update order in the database
    $query = "UPDATE orders SET status = 'CANCELED' WHERE oid='$oid'";
    mysqli_query($conn, $query);

    // Redirect to the orders page
    header('Location: view_orders.php');
}
?>