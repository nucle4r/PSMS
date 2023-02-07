<?php
session_start();
include 'db_connect.php';

if (isset($_SESSION['user'])) {
  header("Location: home.php");
  exit;
}

if (isset($_POST['email']) && isset($_POST['password'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
    $_SESSION['user'] = $user;
    header("Location: home.php");
    exit;
  } else {
    $error = "Incorrect email or password.";
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <title>Login Form</title>
</head>

<body>
  <div class="container h-100 d-flex justify-content-center align-items-center">
    <form action="index.php" method="post">
      <div class="text-center mb-4">
        <h1 class="h3 mb-3 font-weight-normal">Customer Login</h1>
      </div>
      <div class="form-group">
        <label for="email">email:</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" autocomplete="off">
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password"
          autocomplete="off">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <div class="row">
        <p>Are you an Admin</p> <a href="../admin/index.php">. Sign in as Admin </a>
      </div>
    </form>
    <?php if (isset($error)): ?>
      <div class="text-danger mt-3"><?= $error ?></div>
    <?php endif; ?>
  </div>
</body>

</html>