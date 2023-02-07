<?php
session_start();

// check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}

// destroy session
session_destroy();

// redirect to login page
header('Location: index.php');
