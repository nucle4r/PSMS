<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}

// Get the count of inventory
// $query = "SELECT COUNT(*) as inventory_count FROM inventory";
// $result = mysqli_query($conn, $query);
// $inventory_count = mysqli_fetch_assoc($result)['inventory_count'];

// // Get the count of products
// $query = "SELECT COUNT(*) as product_count FROM products";
// $result = mysqli_query($conn, $query);
// $product_count = mysqli_fetch_assoc($result)['product_count'];

// // Get the count of customers
// $query = "SELECT COUNT(*) as customer_count FROM customers";
// $result = mysqli_query($conn, $query);
// $customer_count = mysqli_fetch_assoc($result)['customer_count'];

// // Get the count of orders
// $query = "SELECT COUNT(*) as order_count FROM orders";
// $result = mysqli_query($conn, $query);
// $order_count = mysqli_fetch_assoc($result)['order_count'];

// // Get the total quantity of all products
// $query = "SELECT SUM(quantity) as total_quantity FROM inventory";
// $result = mysqli_query($conn, $query);
// $total_quantity = mysqli_fetch_assoc($result)['total_quantity'];

// // Get the total revenue from orders
// $query = "SELECT SUM(total_price) as total_revenue FROM orders";
// $result = mysqli_query($conn, $query);
// $total_revenue = mysqli_fetch_assoc($result)['total_revenue'];

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Dashboard</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'; ?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <p>Welcome, <?= $_SESSION['admin']['name'] ?>!</p>
                </div>
                <div class="container-fluid">
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <div class="card text-white bg-primary h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Inventory</h5>
                                    <p class="card-text">Total count: <?php echo $inventory_count; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card text-white bg-success h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Products</h5>
                                    <p class="card-text">Total count: <?php echo $product_count; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card text-white bg-warning h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Customers</h5>
                                    <p class="card-text">Total count: <?php echo $customer_count; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card text-white bg-danger h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Orders</h5>
                                    <p class="card-text">Total count: <?php echo $order_count; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <div class="card text-white bg-info h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Total Items in Inventory</h5>
                                    <p class="card-text">Total Quantity: <?php echo $total_quantity; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card text-white bg-dark h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Total Revenue</h5>
                                    <p class="card-text">Total Revenue: $<?php echo $total_revenue; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>