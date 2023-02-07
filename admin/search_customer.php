<?php
session_start();
include 'db_connect.php';

if (isset($_POST['customer_name'])) {
    // Get customer name from the form
    $customer_name = $_POST['customer_name'];

    // Search for customer by name
    $query = "SELECT * FROM users WHERE name like '%$customer_name%' LIMIT 5";
    $result = mysqli_query($conn, $query);
    $customers = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $customers[] = $row;
    }
}
// Return customer information as JSON
echo json_encode($customers);
?>