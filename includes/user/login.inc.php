<?php
// Starting Session
session_start();
// Autoloading Classes
// include 'classAutoLoader.inc.php';
include '../../classes/user.class.php';

// Checking if User Submitted the form
if (isset($_POST['login'])) {
    // User Variables
    $loginEmail = $_POST['loginEmail'];
    $loginPassword = $_POST['loginPassword'];
    
    // Checking if fields are empty
    if (empty($loginEmail) || empty($loginPassword)) {
        header("Location: ../../index.php?error=empty");
        exit();

    } else if (!filter_var($loginEmail, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../../index.php?error=email");
    } else {
        $user = new User;
        $user -> connect();
        $user -> login($loginEmail, $loginPassword);
        exit();
    }
} else {
    header("Location: ../../index.php?error=unknown+err0");
    exit();
}