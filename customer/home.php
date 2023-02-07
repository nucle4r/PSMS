<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Home - Shop Pets</title>
</head>
<script>

</script>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'; ?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Adopt Pets</h1>
                    <p>Welcome, <?= $_SESSION['user']['name'] ?>!</p>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Species</th>
                                        <th>Breed</th>
                                        <th>Current Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT pets.breed as pet_breed, pets.species as pet_species, pets.age as pet_age, pets.price as pet_price, inventory.*
                                    FROM inventory JOIN pets ON inventory.pet_id = pets.pid WHERE quantity > 0";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($result)):
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $row['pet_species'] ?>
                                            </td>
                                            <td>
                                                <?= $row['pet_breed'] ?>
                                            </td>
                                            <td><?= $row['quantity'] ?></td>
                                            <td>
                                                <?= $row['pet_price'] ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-info" data-toggle="modal"
                                                    data-target="#adoptPetModal" data-inventory-id="<?= $row['id'] ?>"><i
                                                        class="fa-solid fa-heart"></i> Adopt Pet</button>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php
                $query = "SELECT pets.breed as pet_breed, pets.species as pet_species, pets.age as pet_age, pets.price as pet_price, inventory.*
                FROM inventory RIGHT JOIN pets ON inventory.pet_id = pets.pid";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)):
                    ?>
                    <div class="modal" id="adoptPetModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="adopt_pet.php" method="post">
                                    <input type="hidden" name="inventory_id" value="<?= $row['id'] ?>">
                                    <input type="hidden" id="pet_id" name="pet_id" value="">
                                    <input type="hidden" name="user_id" value="<?= $_SESSION['user']['uid'] ?>">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirm Order</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="pet_breed">Pet Breed:</label>
                                            <input type="text" class="form-control" id="pet_breed" name="pet_breed" value=""
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="pet_species">Pet Species:</label>
                                            <input type="text" class="form-control" id="pet_species" name="pet_species"
                                                value="" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="pet_price">Pet Price:</label>
                                            <input type="number" class="form-control" id="pet_price" name="pet_price"
                                                value="" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="quantity">Enter Quantity:</label>
                                            <input type="number" class="form-control" id="quantity" name="quantity"
                                                placeholder="Enter quantity" min="1" value="1">
                                        </div>
                                        <div class="form-group">
                                            <label for="total_price">Total Price:</label>
                                            <input type="number" class="form-control" id="total_price" name="total_price"
                                                value="" readonly>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Place Order</button>
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
        $(document).ready(function () {
            $('#adoptPetModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var inventoryId = button.data('inventory-id'); // Extract info from data-* attributes
                $("#inventory_id").val(inventoryId);
                // Send an AJAX request to get the details of the pet associated with the selected inventory
                $.ajax({
                    url: 'get_pet_details.php',
                    type: 'post',
                    data: { inventory_id: inventoryId },
                    success: function (response) {
                        var pet = JSON.parse(response);
                        console.log(pet)
                        $("#pet_id").val(pet.pid);
                        $("#pet_breed").val(pet.breed);
                        $("#pet_species").val(pet.species);
                        $("#pet_price").val(pet.price);
                        $("#total_price").val(pet.price * 1);
                        $("#quantity").attr({
                            "max": pet.quantity,
                        });
                    }
                });
            });
            $("#quantity").on('change', function () {
                var quantity = $(this).val();
                var price = document.getElementById('pet_price').value
                $("#total_price").val(price * quantity);

            });
        });
    </script>

</body>

</html>