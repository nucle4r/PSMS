<?php
session_start();
include 'db_connect.php';

// Check for form submission
if (isset($_POST['name'])) {
    // Get form data
    $name = $_POST['name'];
    $phonenumber = $_POST['phonenumber'];

    // Insert new customer into the database
    $query = "INSERT INTO customers (name, phonenumber) VALUES ('$name', '$phonenumber')";
    mysqli_query($conn, $query);

    // Redirect to the customers page
    header('Location: customers.php');
}
?>