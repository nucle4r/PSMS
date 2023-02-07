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
    <title>Pet's Inventory</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'; ?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Manage Pets Inventory</h1>
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#addInventoryModal">Add Inventory</button>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Pet Breed</th>
                                        <th>Species</th>
                                        <th>Minimum Quantity</th>
                                        <th>Current Quantity</th>
                                        <th>Maximum Quantity</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT i.*, p.breed as pet_breed, p.species as pet_species FROM inventory i JOIN pets p ON i.pet_id = p.pid";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($result)):
                                        ?>
                                        <tr>
                                            <td><?= $row['pet_breed'] ?></td>
                                            <td><?= $row['pet_species'] ?></td>
                                            <td>
                                                <?= $row['min_quantity'] ?>
                                            </td>
                                            <td>
                                                <?= $row['quantity'] ?>
                                            </td>
                                            <td><?= $row['max_quantity'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-success" data-toggle="modal"
                                                    data-target="#addItemsModal<?= $row['id'] ?>"><i class="fa-solid fa-plus"></i>
                                                    Add</button>
                                                <button type="button" class="btn btn-dark" data-toggle="modal"
                                                    data-target="#reduceItemsModal<?= $row['id'] ?>"><i class="fa-solid fa-minus"></i> Reduce</button>                                                
                                                <button type="button" class="btn btn-info" data-toggle="modal"
                                                    data-target="#editInventoryModal<?= $row['id'] ?>"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                                                <a href="remove_inventory.php?id=<?= $row['id'] ?>"
                                                    class="btn btn-danger"> <i class="fa-solid fa-trash"></i> Remove</a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal" id="addInventoryModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="add_inventory.php" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Inventory</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>×</span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="pet_breed">Pet Breed:</label>
                                        <input type="text" class="form-control" id="pet_breed" name="pet_breed"
                                            placeholder="Enter Pet Breed" list="pets-list" autocomplete="off">
                                        <datalist id="pets-list"></datalist>
                                    </div>
                                    <div class="form-group">
                                        <label for="pet_species">Pet Species:</label>
                                        <input type="text" class="form-control" id="pet_species" name="pet_species"
                                            readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="pet_id">Pet ID:</label>
                                        <input type="number" class="form-control" id="pet_id" name="pet_id"
                                            readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="min_quantity">Minimum Quantity:</label>
                                        <input type="number" class="form-control" id="min_quantity" name="min_quantity"
                                            placeholder="Enter minimum quantity" min="1" value="1">
                                    </div>
                                    <div class="form-group">
                                        <label for="max_quantity">Maximum Quantity:</label>
                                        <input type="number" class="form-control" id="max_quantity" name="max_quantity"
                                            placeholder="Enter maximum quantity" min="1" value="1">
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
                <?php
                $query = "SELECT * FROM inventory";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)):
                    ?>
                    <div class="modal" id="editInventoryModal<?= $row['id'] ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="edit_inventory.php" method="post">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Inventory</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="min_quantity">Minimum Quantity:</label>
                                            <input type="number" class="form-control" id="min_quantity" name="min_quantity"
                                                placeholder="Enter minimum quantity" value="<?= $row['min_quantity'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="max_quantity">Maximum Quantity:</label>
                                            <input type="number" class="form-control" id="max_quantity" name="max_quantity"
                                                placeholder="Enter maximum quantity" value="<?= $row['max_quantity'] ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php
                $query = "SELECT * FROM inventory";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)):
                    ?>
                    <div class="modal" id="addItemsModal<?= $row['id'] ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="add_items.php" method="post">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Increase Quantity</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="add_quantity">Quantity to Add:</label>
                                            <input type="number" class="form-control" id="add_quantity" name="add_quantity"
                                                placeholder="Enter quantity" min="1" value="1">
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php
                $query = "SELECT * FROM inventory";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)):
                    ?>
                    <div class="modal" id="reduceItemsModal<?= $row['id'] ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="reduce_items.php" method="post">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Reduce Quantity</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="reduce_quantity">Quantity to Reduce:</label>
                                            <input type="number" class="form-control" id="reduce_quantity" name="reduce_quantity"
                                                placeholder="Enter quantity" min="1" value="1">
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Reduce</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
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
                    console.log(pets[i].breed)
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
            url: 'get_pet_species.php',
            type: 'post',
            data: {pet_id: pet_id},
            success: function(data) {
                var pet = JSON.parse(data);
                $("#pet_species").val(pet.species);
            }
        });
    });
});
    </script>

</body>

</html>