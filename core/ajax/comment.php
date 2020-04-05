<?php

include_once '../init.php';

if (isset($_POST['comment']) && !empty($_POST['comment'])) {
    $comment = $_POST['comment'];
    $userID = $user -> getUserID();
    $tweetID = $_POST['tweetID'];

    if (!empty($comment)) {
        $sql = "INSERT INTO comments (comment, commentOn, commentBy, commentAt) VALUES (?, ?, ?, ?);";
        $stmt = $dbh -> getDb() -> prepare($sql);
        $stmt -> execute([$comment, $tweetID, $userID, date('Y-m-d H:i:s')]);
        #$user -> create('comments', array('comment' => $comment, 'commentID' => $tweetID, 'commentBy' => $userID, 'commentAt' => date('Y-m-d H:i:s')));
        $comments = $tweet -> comments($tweetID);
        $tweets = $tweet -> getPopupTweet($tweetID);

        foreach ($comments as $comment) {
            echo '
            <div class="tweet-show-popup-comment-box">
                <div class="tweet-show-popup-comment-inner">
                    <div class="tweet-show-popup-comment-head">
                        <div class="tweet-show-popup-comment-head-left">
                            <div class="tweet-show-popup-comment-img">
                                <img src="'.BASE_URL.$comment -> profileImage.'">
                            </div>
                        </div>
                        <div class="tweet-show-popup-comment-head-right">
                            <div class="tweet-show-popup-comment-name-box">
                                <div class="tweet-show-popup-comment-name-box-name"> 
                                    <a href="'.BASE_URL.$comment -> userUID.'">'.$comment -> screenName.'</a>
                                </div>
                                <div class="tweet-show-popup-comment-name-box-tname">
                                    <a href="'.BASE_URL.$comment -> userUID.'">@'.$comment -> userUID.' - '.$comment -> commentAt.'</a>
                                </div>
                            </div>
                            <div class="tweet-show-popup-comment-right-tweet">
                                    <p><a href="'.BASE_URL.$tweets -> userUID.'">@'.$comment -> userUID.'</a> '.$comment -> comment.'</p>
                            </div>
                            <div class="tweet-show-popup-footer-menu">
                                <ul>
                                    <li><button><i class="fa fa-share" aria-hidden="true"></i></button></li>
                                    <li><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                    <li>
                                    <a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                    <ul> 
                                    <li><label class="deleteTweet">Delete Tweet</label></li>
                                    </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!--TWEET SHOW POPUP COMMENT inner END-->
            </div>
            ';
         }
    }
}