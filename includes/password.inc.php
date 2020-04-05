<?php
session_start();
include '../classes/user.class.php';
$dbh = new Dbh;
$dbh -> connect();
if (isset($_POST['submit'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $rePassword = $_POST['rePassword'];
    $userEmail = $_SESSION['userEmail'];

    if (empty($currentPassword) || empty($newPassword) || empty($rePassword)) {
        header("Location: ../settings/password.php?error=empty");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE userEmail = ?";
        $stmt = $dbh -> getDb() -> prepare($sql);
        $stmt -> execute([$userEmail]);
        if ($stmt -> rowCount() < 1) {
            header("Location: ../settings/password.php?error=unknown");
        } else {
            $row = $stmt -> fetch();
            $oldPassword = $row['userPassword'];
            $deHashPwd !== password_verify($currentPassword, $oldPassword);
            if ($deHashPwd === false) {
                $dbh = null;
                header("Location: ../settings/password.php?error=incorrect");
                exit();
            } else {
                if ($newPassword !== $rePassword) {
                    header("Location: ../settings/password.php?error=notmatching");
                    exit();
                } else {
                    $user = new User;
                    if ($user -> changePassword($newPassword, $userEmail) === false) {
                        header("Location: ../settings/password.php?error=unknown");
                        exit();
                    } else {
                        $user = null;
                        header("Location: ../settings/password.php?password=changed");
                        exit();
                    }
                }
            }
        }
    }
} else {
    header('Location: ../settings/password.php');
    exit();
}