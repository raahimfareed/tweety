<?php
// Starting Session
session_start();
// Autoloading Classes
// include 'classAutoLoader.inc.php';
include '../../classes/user.class.php';


// Checking if User entered the form
if (isset($_POST['signup'])) {
    // User Variables
    $screenName = $_POST['screenName'];
    $userUID = $_POST['userUID'];
    $signupEmail = $_POST['signupEmail'];
    $signupPassword = $_POST['signupPassword'];

    // Checking if Fields are empty
    if (empty($screenName) || empty($userUID) || empty($signupEmail) || empty($signupPassword)) {
        header("Location: ../../index.php?error=empty");
        exit();

    // Checking Names
    } else if (!preg_match("/^[a-zA-Z\s]*$/", $screenName)) {
        header("Location: ../../index.php?error=invalidname");
        exit();

    // Checking Email
    } else if (!filter_var($signupEmail, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../../index.php?error=email");
        exit();

    } else {
        $user = new User;
        $user -> signup($userUID, $signupEmail, $screenName, $signupPassword);
        
    }
} else {
    header("Location: ../../index.php?error=unknown");
    exit();
}
