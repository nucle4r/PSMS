<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
} ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Order</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'; ?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Order</h1>
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#addOrderModal">Add Order</button>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Pet Name</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Order Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT pets.breed as pet_name, users.name as customer_name, orders.*
                                    FROM orders JOIN pets ON orders.pet_id = pets.pid JOIN users ON orders.user_id = users.uid WHERE status = 'LIVE'";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($result)):
                                        ?>
                                        <tr>
                                            <td><?= $row['oid'] ?></td>
                                            <td>
                                            #<?= $row['user_id'] ?> <?= $row['customer_name'] ?>
                                            </td>
                                            <td><?= $row['pet_name'] ?></td>                                            
                                            <td>
                                                <?= $row['quantity'] ?>
                                            </td>
                                            <td><?= $row['total_price'] ?></td>
                                            <td><?= $row['date'] ?></td>
                                            <td>
                                                <a href="cancel_order.php?id=<?= $row['oid'] ?>"
                                                    class="btn btn-danger"><i class="fa-solid fa-xmark"></i> Cancel Order</a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal" id="addOrderModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="add_order.php" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Order</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>×</span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="pet_breed">Pet Name:</label>
                                        <input type="text" class="form-control" id="pet_breed" name="pet_breed"
                                            placeholder="Select pet" list="pets-list" autocomplete="off">                                        
                                        <datalist id="pets-list"></datalist>
                                    </div>
                                    <div class="form-group">
                                        <label for="pet_price">Pet Unit Price:</label>
                                        <input type="text" class="form-control" id="pet_price" name="pet_price"
                                            readonly>
                                    </div>                                   
                                        
                                        <input type="hidden" class="form-control" id="pet_id" name="pet_id">
                                    
                                    <div class="form-group">
                                        <label for="customer_name">Customer Name:</label>
                                        <input type="text" class="form-control" id="customer_name" name="customer_name"
                                            placeholder="Select Customer" list="users-list" autocomplete="off">
                                        <datalist id="users-list"></datalist>
                                    </div>
                                    <div class="form-group">
                                        <label for="customer_id">Customer ID:</label>
                                        <input type="number" class="form-control" id="customer_id" name="customer_id"
                                            readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Quantity:</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity"
                                           value="1" min="1" placeholder="Enter quantity">
                                    </div>
                                    <div class="form-group">
                                        <label for="total_price">Total Price:</label>
                                        <input type="text" class="form-control" id="total_price" name="total_price"
                                            readonly>
                                    </div>              
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>             
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
    <script>
  $(document).ready(function(){
    $("#pet_breed").on('input', function(){
        var pet_breed = $(this).val();
        $.ajax({
            url: 'search_pets.php',
            type: 'post',
            data: {pet_breed: pet_breed},
            success: function(data) {
                var pets = JSON.parse(data);
                $("#pets-list").empty();
                for(let i = 0; i < pets.length; i++) {
                    $("#pets-list").append("<option value='"+pets[i].breed+"' data-id='"+pets[i].pid+"'>"+pets[i].breed+"</option>");
                }
            }
        });
    });

    $("#pet_breed").on('change', function(){
        var selected_pet = $("#pet_breed").val();
        var pet_id = $("#pets-list option[value='"+selected_pet+"']").data("id");
        $("#pet_id").val(pet_id);
        $.ajax({
            url: 'get_pet_price.php',
            type: 'post',
            data: {pet_id: pet_id},
            success: function(data) {
                
                var pet = JSON.parse(data);
                console.log(pet)
                $("#pet_price").val(pet.price);
                $("#quantity").val(1);
                $("#total_price").val(pet.price);

            }
        });
    });
    $("#quantity").on('change', function(){
        var quantity = $(this).val();
        var price = document.getElementById('pet_price').value
        $("#total_price").val(price*quantity);

    });
    
});
    </script>
<script>
  $(document).ready(function(){
    $("#customer_name").on('input', function(){
        console.log('triggered')
        var customer_name = $(this).val();
        $.ajax({
            url: 'search_customer.php',
            type: 'post',
            data: {customer_name: customer_name},
            success: function(data) {
                var users = JSON.parse(data);
                $("#users-list").empty();
                for(let i = 0; i < users.length; i++) {
                    $("#users-list").append("<option value='"+users[i].name+"' data-id='"+users[i].uid+"'>"+users[i].name+"</option>");
                }
            }
        });
    });

    $("#customer_name").on('change', function(){
        var selected_customer = $("#customer_name").val();
        var customer_id = $("#users-list option[value='"+selected_customer+"']").data("id");
        $("#customer_id").val(customer_id);
        });
        }); 
</script>
</body>

</html>