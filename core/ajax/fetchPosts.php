<?php

include '../init.php';
if(isset($_POST['fetchPosts']) && !empty($_POST['fetchPosts'])) {
    $userID = $user -> getUserID();
    $limit = (int) trim($_POST['fetchPosts']);
    $tweet -> getTweets($userID, $limit);
}