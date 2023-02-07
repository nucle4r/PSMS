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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Pets</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'; ?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Manage Pets</h1>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addpetModal">
                        Add Pet
                    </button>
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
                                    $query = "SELECT COALESCE(inventory.quantity, 0) as pet_quantity, pets.* FROM pets LEFT JOIN inventory on pets.pid = inventory.pet_id;";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($result)):
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $row['species'] ?>
                                            </td>
                                            <td>
                                                <?= $row['breed'] ?>
                                            </td>
                                            <td><?= $row['pet_quantity'] ?></td>
                                            <td>
                                                <?= $row['price'] ?>
                                            </td>
                                            <td>
                                                <a href="remove_pet.php?pid=<?= $row['pid'] ?>"
                                                    class="btn btn-danger"><i class="fa-solid fa-trash"></i> Remove</a>
                                                <button type="button" class="btn btn-info" data-toggle="modal"
                                                    data-target="#editpetModal<?= $row['pid'] ?>"><i
                                                        class="fa-solid fa-pen-to-square"></i> Edit</button>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal" id="addpetModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="add_pet.php" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add pet</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="species">Species:</label>
                                        <input type="text" class="form-control" id="species" name="species"
                                            placeholder="Enter species name">
                                    </div>
                                    <div class="form-group">
                                        <label for="breed">Breed:</label>
                                        <input type="text" class="form-control" id="breed" name="breed"
                                            placeholder="Enter pet name">
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price:</label>
                                        <input type="text" class="form-control" id="price" name="price"
                                            placeholder="Enter unit price">
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
                $query = "SELECT * FROM pets";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)):
                    ?>
                    <div class="modal" id="editpetModal<?= $row['pid'] ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="edit_pet.php" method="post">
                                    <input type="hidden" name="pid" value="<?= $row['pid'] ?>">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Pet Details</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="species">Species:</label>
                                            <input type="text" class="form-control" id="species" name="species"
                                                placeholder="Enter species name" value="<?= $row['species'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="breed">Name:</label>
                                            <input type="text" class="form-control" id="breed" name="breed"
                                                placeholder="Enter pet breed" value="<?= $row['breed'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Price:</label>
                                            <input type="text" class="form-control" id="price" name="price"
                                                placeholder="Enter unit price" value="<?= $row['price'] ?>">
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
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>

</body>

</html>