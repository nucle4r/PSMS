<?php
session_start();
include 'db_connect.php';

// Check for form submission
if (isset($_POST['reduce_quantity'])) {
    // Get form data
    $id = $_POST['id'];
    $reduce_quantity = $_POST['reduce_quantity'];

    // Update inventory in the database
    $query = "UPDATE inventory SET quantity= quantity - $reduce_quantity WHERE id='$id'";
    mysqli_query($conn, $query);

    // Redirect to the inventory page
    header('Location: inventory.php');
}
?>