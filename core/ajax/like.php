<?php
    session_start();
    include_once '../../classes/tweet.class.php';
    if (isset($_POST['like']) && !empty($_POST['like'])) {
        $tweet = new Tweet;
        $tweet -> getInfo($_SESSION['userEmail']);

        $userID = $tweet -> getUserID();
        $tweetID = $_POST['like'];
        $getID = $_POST['userID'];
        
        $tweet -> addLike($userID, $tweetID, $getID);
    }
    if (isset($_POST['unlike']) && !empty($_POST['unlike'])) {
        $tweet = new Tweet;
        $tweet -> getInfo($_SESSION['userEmail']);

        $userID = $tweet -> getUserID();
        $tweetID = $_POST['unlike'];
        $getID = $_POST['userID'];
        
        $tweet -> unlike($userID, $tweetID, $getID);
    }

?>