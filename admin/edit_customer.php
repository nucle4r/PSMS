<?php
session_start();
include 'db_connect.php';

// Check for form submission
if (isset($_POST['name'])) {
    // Get form data
    $cid = $_POST['cid'];
    $name = $_POST['name'];
    $phonenumber = $_POST['phonenumber'];

    // Update customer in the database
    $query = "UPDATE customers SET name='$name', phonenumber='$phonenumber' WHERE cid='$cid'";
    mysqli_query($conn, $query);

    // Redirect to the customers page
    header('Location: customers.php');
}
?>