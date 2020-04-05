<?php
    session_start();
    include '../../classes/user.class.php';

    if(isset($_POST['submit'])) {
        $user = new User;
        $user -> getInfo($_SESSION['userEmail']);
        // $supportedImage = array('gif','jpg','jpeg','png');
        if (isset($_POST['screenName'])) {
            if (!empty($_POST['screenName'])) {
                $screenName = $_POST['screenName'];
            } else {
                $screenName = $user -> getUserUID();
            }
        } else {
            $screenName = $user -> getUserUID();
        }
        if (isset($_POST['userBio'])) {
            $userBio = $_POST['userBio'];
        } else {
            $userBio = "";
        }
        if (isset($_POST['userCountry'])) {
            $userCountry = $_POST['userCountry'];
        } else {
            $userCountry = "";
        }
        if (isset($_POST['userWebsite'])) {
            $userWebsite = $_POST['userWebsite'];
        } else {
            $userWebsite = "";
        }
        
        $userEmail = $_SESSION['userEmail'];

        if (empty($screenName)) {
            header("Location: ../../profileEdit.php?error=empty");
            exit();
        } else if(strlen($screenName) > 32) {
            header("Location: ../../profileEdit.php?error=longusername");
            exit();
        } else if (strlen($userBio) > 120) {
            header("Location: ../../profileEdit.php?error=longbio");
            exit();
        } else if (strlen($userCountry) > 100) {
            header("Location: ../../profileEdit.php?error=invalidcountry");
            exit();
        } else {
            $user -> updateSettings($screenName, $userBio, $userCountry, $userWebsite, $userEmail);
        }
    } else {
        header("Location: ../../profileEdit.php");
        exit();
        // echo "Error";
    }