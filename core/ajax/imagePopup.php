<?php
    include_once ("../init.php");

    if(isset($_POST['showImage']) && !empty($_POST['showImage'])) {
        $tweetID = $_POST['showImage'];
        $userID = $_SESSION['userID'];
        $tweets = $tweet -> getPopupTweet($tweetID);
        $likes = $tweet -> likes($userID, $tweetID);
        $retweet = $tweet -> checkRetweet($tweetID, $userID);
        ?>
        
        <div class="img-popup">
            <div class="wrap6">
            <span class="colose">
                <button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
            </span>
            <div class="img-popup-wrap">
                <div class="img-popup-body">
                    <img src="<?php echo BASE_URL.$tweets -> tweetImage; ?>"/>
                </div>
                <div class="img-popup-footer">
                    <div class="img-popup-tweet-wrap">
                        <div class="img-popup-tweet-wrap-inner">
                            <div class="img-popup-tweet-left">
                                <img src="<?php echo BASE_URL.$tweets -> profileImage; ?>"/>
                            </div>
                            <div class="img-popup-tweet-right">
                                <div class="img-popup-tweet-right-headline">
                                    <a href="<?php echo BASE_URL.$tweets -> userUID; ?>"><?php echo $tweets -> screenName; ?></a><span>@<?php echo $tweets -> userUID." - ".$tweet -> postedOn; ?></span>
                                </div>
                                <div class="img-popup-tweet-right-body">
                                    <?php echo $tweet -> getTweetLinks($tweets -> tweetStatus); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="img-popup-tweet-menu">
                        <div class="img-popup-tweet-menu-inner">
                            <ul> 
                                <?php if ($user -> loggedIn() === true) {
                                    echo '
                                        <li><button><a href="#"><i class="fa fa-share" aria-hidden="true"></i></a></button></li>	
                                        <li>'.(($tweet -> tweetID === $retweet['retweetID']) ? '<button class="retweeted" data-tweet="'.$tweet -> tweetID.'" data-user="'.$tweet -> tweetBy.'"><a href="#"><i class="fa fa-retweet" aria-hidden="true"></i></a><span class="retweetsCount">'.$tweet -> retweetCount.'</span></button>' : '<button class="retweet" data-tweet="'.$tweet -> tweetID.'" data-user="'.$tweet -> tweetBy.'"><a href="#"><i class="fa fa-retweet" aria-hidden="true"></i></a><span class="retweetsCount">'.(($tweet -> retweetCount > 0) ? $tweet -> retweetCount : '').'</span></button>').'</li>
                                        <li>'.(($likes['likeOn'] === $tweet -> tweetID) ? '<button class="unlike-btn" data-tweet="'.$tweet -> tweetID.'" data-user="'.$tweet -> tweetBy.'"><a href="#"><i class="fa fa-heart" aria-hidden="true"><span class="likesCounter">'.$tweet -> likesCount.'</span></i></a></button>' : '<button class="like-btn" data-tweet="'.$tweet -> tweetID.'" data-user="'.$tweet -> tweetBy.'"><a href="#"><i class="fa fa-heart-o" aria-hidden="true"><span class="likesCounter">'.(($tweet -> likesCount > 0) ? $tweet -> likesCount : '').'</span></i></a></button>').'</li>
                                        <li><label for="img-popup-menu"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></label>
                                            <input id="img-popup-menu" type="checkbox"/>
                                            <div class="img-popup-footer-menu">
                                                <ul>
                                                <li><label class="deleteComment" >Delete Tweet</label></li>
                                                </ul>
                                            </div>
                                        </li>
                                    ';
                                } else {
                                    echo '
                                        <li><button><i class="fa fa-share" aria-hidden="true"></i></button></li>	
                                        <li><button class="retweet"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount"></span></button></li>
                                        <li><button class="like-btn"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="likesCounter"></span></button></li>
                                    ';
                                } ?>
                                
                                
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div><!-- Image PopUp ends-->
        
        
        
        
        
        
        <?php
    }