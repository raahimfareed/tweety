<?php
include_once('../init.php');
if(isset($_POST['deleteTweet']) && !empty($_POST['deleteTweet'])) {
    $tweetID = $_POST['deleteTweet'];
    $userID = $user -> getUserID();
    $tweet -> delete('tweets', array('tweetID' => $tweetID, 'tweetBy' => $userID));
}
if(isset($_POST['showPopup']) && !empty($_POST['showPopup'])) {
    $tweetID = $_POST['showPopup'];
    $userID = $user -> getUserID();
    $tweets = $tweet -> getPopupTweet($tweetID);
    ?>
    
    <div class="retweet-popup">
        <div class="wrap5">
            <div class="retweet-popup-body-wrap">
                <div class="retweet-popup-heading">
                    <h3>Are you sure you want to delete this Tweet?</h3>
                    <span><button class="close-retweet-popup"><i class="fa fa-times" aria-hidden="true"></i></button></span>
                </div>
                <div class="retweet-popup-inner-body">
                    <div class="retweet-popup-inner-body-inner">
                        <div class="retweet-popup-comment-wrap">
                            <div class="retweet-popup-comment-head">
                                <img src="<?php echo BASE_URL.$tweets -> profileImage; ?>"/>
                            </div>
                            <div class="retweet-popup-comment-right-wrap">
                                <div class="retweet-popup-comment-headline">
                                    <a><?php echo $tweets -> screenName; ?> </a><span>‏@<?php echo $tweets -> userUID . ' ' . $tweets -> postedOn; ?></span>
                                </div>
                                <div class="retweet-popup-comment-body">
                                    <?php echo $tweets -> tweetStatus. ' ' .$tweets -> tweetImage; ?>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="retweet-popup-footer"> 
                    <div class="retweet-popup-footer-right">
                        <button class="cancel-it f-btn">Cancel</button><button class="delete-it" type="submit">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    
    <?php
}