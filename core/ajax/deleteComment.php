<?php

include_once('../../core/init.php');

if(isset($_POST['deleteComment']) && !empty($_POST['deleteComment'])) {
    $userID = $user -> getUserID();
    $commentId = $_POST['deleteComment'];
    $user -> delete('comments', array('commentID' => $commentId, 'commentBy' => $userID));
}