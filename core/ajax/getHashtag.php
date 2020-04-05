<?php
    session_start();
    include '../../classes/tweet.class.php';
    $tweet = new Tweet;
    if(isset($_POST['hashtag'])) {
        $hashtag = $_POST['hashtag'];
        $mention = $_POST['hashtag'];
        if(substr($hashtag, 0, 1) === '#') {
            $trend = str_replace('#', '', $hashtag);
            $trends = $tweet -> getTrendByHash($trend);

            foreach($trends as $hashtag) {
                echo
                '
                    <li>
                        <span class="getValue">#'.$hashtag -> hashtag.'</span>
                    </li>
                ';
            }
        }
        if(substr($mention, 0, 1) === '@') {
            $mention = str_replace('@', '', $mention);
            $mentions = $tweet -> getMention($mention);

            foreach($mentions as $mention) {
                echo
                '
                <li><div class="nav-right-down-inner">
                    <div class="nav-right-down-left">
                        <span><img src="'.$mention -> profileImage.'"></span>
                    </div>
                    <div class="nav-right-down-right">
                        <div class="nav-right-down-right-headline">
                            <a>'.$mention -> screenName.'</a><span class="getValue">@'.$mention -> userUID.'</span>
                        </div>
                    </div>
                </div><!--nav-right-down-inner end-here-->
                </li>
                ';
            }
        }
    }
    

?>