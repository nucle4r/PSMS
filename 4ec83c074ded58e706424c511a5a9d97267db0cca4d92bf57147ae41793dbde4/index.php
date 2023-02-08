<?php
include 'db_connect.php';

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    if ($_POST['password'] == $_POST['repassword']) {
        // Get form data
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Insert data into the database
        $query = "INSERT INTO admins (name, email, password, created_at) VALUES ('$name', '$email', '$password', NOW())";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location: ../admin/index.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Passwords does not match!";
    }
}
// Close connection
mysqli_close($conn);

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Admin Login Form</title>
</head>

<body>
    <div class="container h-100 d-flex justify-content-center align-items-center">

        <!-- Sign Up Form -->
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h2>Admin Sign Up</h2>
                    <form action="signup.php" method="post">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="repassword">Re-Type Password:</label>
                            <input type="password" class="form-control" id="repassword" name="repassword" required>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Sign Up">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>