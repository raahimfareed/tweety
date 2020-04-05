<?php

include '../classes/user.class.php';
session_start();
$user = new User;
$user -> connect($_SESSION['userEmail']);
// $dbh = new Dbh;
$user -> getInfo($_SESSION['userEmail']);

if (isset($_POST['submit'])) {
    if (isset($_POST['userEmail'])) {
        $userEmail = $_POST['userEmail'];
    } else {
        $userEmail = $_SESSION['userEmail'];
    }

    if (isset($_POST['userUID'])) {
        $userUID = $_POST['userUID'];
    } else {
        // $userUID = $user -> getUserUID();
    }
    if (empty($userUID) || empty($userEmail)) {
        header("Location: ../settings/account.php?error=empty");
        exit();
    } else if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../settings/account.php?error=email");
        exit();
    } else if (!preg_match("/^[-a-zA-Z0-9]*$/", $userUID)) {
        header("Location: ../settings/account.php?error=username");
        exit();
    } else if (strlen($userUID) > 32) {
        header("Location: ../settings/account.php?error=length");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE userUID = ?";
        $stmt = $user -> getDb() -> prepare($sql);
        $stmt -> execute([$userUID]);
        if ($stmt -> rowCount() >= 1) {
            header("Location: ../settings/account.php?error=taken");
            exit();
        } else if ($user -> updateAccount($userEmail, $userUID) === false) {
            header("Location: ../settings/account.php?error=db");
            exit();
        } else if ($user -> updateAccount($userEmail, $userUID) === true) {
            header("Location: ../settings/account.php?account=updated");
            exit();
        }
    }
} else {
    header("Location: ../settings/account.php");
    exit();
}