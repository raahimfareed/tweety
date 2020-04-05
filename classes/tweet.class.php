<?php
include_once 'user.class.php';

class Tweet extends User {

    public function getTweets($userID, $num) {
        // $dbh = new Dbh;
        $this -> connect();
        $stmt = $this -> getDb() -> prepare("SELECT * FROM tweets, users WHERE tweetBy = userID LIMIT :num");
        $stmt -> bindParam(':num', $num, PDO::PARAM_INT);
        $stmt -> execute();
        $tweets = $stmt -> fetchAll(PDO::FETCH_OBJ);
        
        foreach ((array_reverse($tweets)) as $tweet) {
            $likes =    $this -> likes($userID, $tweet -> tweetID);
            // $retweet =  $this -> checkRetweet($tweet -> tweetID, $userID);
            // $userData = $this -> userData($retweet['retweetBy']);
            echo '
            <div class="all-tweet">
                <div class="t-show-wrap">	
                <div class="t-show-inner">
                    <div class="t-show-popup" data-tweet="'.$tweet -> tweetID.'">
                        <div class="t-show-head">
                            <div class="t-show-img">
                                <img src="'.$tweet -> profileImage.'"/>
                            </div>
                            <div class="t-s-head-content">
                                <div class="t-h-c-name">
                                    <span><a href="'.$tweet -> userUID.'">'.$tweet -> screenName.'</a></span>
                                    <span>@'.$tweet -> userUID.'</span>
                                    <span>'.$this -> timeAgo($tweet -> postedOn).'</span>
                                </div>
                                <div class="t-h-c-dis">
                                    '.$this -> getTweetLinks($tweet -> tweetStatus).'
                                </div>
                            </div>
                        </div>';
                        if (!empty($tweet -> tweetImage)) {
                            echo '
                                <!--tweet show head end-->
                                <div class="t-show-body">
                                <div class="t-s-b-inner">
                                <div class="t-s-b-inner-in">
                                <img src="http://localhost:1111/tweety/'.$tweet -> tweetImage.'" class="imagePopup" data-tweet="'.$tweet -> tweetID.'" />
                                </div>
                                </div>
                                </div>
                                <!--tweet show body end-->
                                ';
                            }
                            echo'
                            </div>
                    <div class="t-show-footer">
                        <div class="t-s-f-right">
                            <ul> 
                                <li><button><a href="#"><i class="fa fa-share" aria-hidden="true"></i></a></button></li>	
                                <li><button class="retweeted" data-tweet="" data-user=""><a href="#"><i class="fa fa-retweet" aria-hidden="true"></i></a><span class="retweetsCount">'.$tweet -> retweetCount.'</span></button></li>
                                '.(($tweet -> tweetBy === $userID) ? '
                                <li>'.(($likes['likeOn'] === $tweet -> tweetID) ? '<button class="unlike-btn" data-tweet="'.$tweet -> tweetID.'" data-user="'.$tweet -> tweetBy.'"><a href="#"><i class="fa fa-heart" aria-hidden="true"><span class="likesCounter">'.$tweet -> likesCount.'</span></i></a></button>' : '<button class="like-btn" data-tweet="'.$tweet -> tweetID.'" data-user="'.$tweet -> tweetBy.'"><a href="#"><i class="fa fa-heart-o" aria-hidden="true"><span class="likesCounter">'.(($tweet -> likesCount > 0) ? $tweet -> likesCount : '').'</span></i></a></button>').'</li>
                                    <li>
                                    <a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                    <ul> 
                                    <li><label class="deleteTweet" data-tweet="'.$tweet -> tweetID.'">Delete Tweet</label></li>
                                    </ul>
                                </li>' : '').'
                            </ul>
                        </div>
                    </div>
                </div>
                </div>
                </div>
            ';
        }
    }
    public function getTrendbyHash ($hashtag) {
        // $dbh = new Dbh;
        $this -> connect();
        $stmt = $this -> getDb() -> prepare("SELECT * from `trends` where `hashtag` like :hashtags limit 5");
        $stmt -> bindValue(':hashtags', $hashtag.'%');
        $stmt -> execute();
        return $stmt -> fetchAll(PDO::FETCH_OBJ);
    }

    public function getMention($mention) {
        // $dbh = new Dbh;
        $this -> connect();
        $stmt = $this -> getDb() -> prepare("select `useriD`, `userUID`, `screenName`, `profileImage` from `users` where `userUID` like :mention or `screenName` like :mention limit 5");
        $stmt -> bindValue(':mention', $mention.'%');
        $stmt -> execute();
        return $stmt -> fetchAll(PDO::FETCH_OBJ);
    }

    public function addTrend($hashtag) {
        preg_match_all("/#+([a-zA-Z0-9_]+)/i", $hashtag, $matches);
        if ($matches) {
            $result = array_values($matches[1]);
        }

        // $dbh = new Dbh;
        $this -> connect();
        $sql = "INSERT into trends (hashtag, createdOn) values (?, CURRENT_TIMESTAMP);";
    
        foreach($result as $trend) {
            if ($stmt = $this -> getDb() -> prepare($sql)) {
                $stmt -> execute([$trend]);
            }
        }
    }

    public function getTweetLinks($tweet) {
        $tweet = preg_replace("/(https?:\/\/)([\w]+.)([\w\.]+)/", "<a href='$0' target='_blank'>$0</a>", $tweet);
        $tweet = preg_replace("/#([\w]+)/", "<a href='http://localhost/tweety/hashtag/$1'>$0</a>", $tweet);
        $tweet = preg_replace("/@([\w]+)/", "<a href='http://localhost/tweety/$1'>$0</a>", $tweet);
        return $tweet;
    }

    public function getPopupTweet($tweetID) {
        $this -> connect();
        $sql = "SELECT * FROM tweets, users WHERE tweetID = :tweetID AND tweetBy = userID";
        $stmt = $this -> getDb() -> prepare($sql);
        $stmt -> bindParam(":tweetID", $tweetID, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetch(PDO::FETCH_OBJ);
    }

    public function retweet($tweetID, $userID, $getID, $comment) {
        $this -> connect();
        $stmt = $this -> getDb() -> prepare("UPDATE tweets SET retweetCount = retweetCount + 1 WHERE tweetID = :tweetID");
        $stmt -> bindParam(":tweetID", $tweetID, PDO::PARAM_INT);
        $stmt -> execute();

        $stmt = $this -> getDb() -> prepare("INSERT INTO `tweets` (`tweetStatus`, `tweetBy`, `retweetID`, `retweetBy`, `tweetImage`, `postedOn`, `likesCount`, `retweetCount`, `retweetMessage`) SELECT `tweetStatus`, `tweetBy`, `tweetID`, :userID, `tweetImage`, CURRENT_TIMESTAMP, `likesCount`,  `retweetCount`, :retweetMsg FROM `tweets` WHERE `tweetID` = :tweetID");
        $stmt -> bindParam(":userID", $userID, PDO::PARAM_INT);
        $stmt -> bindParam(":retweetMsg", $comment, PDO::PARAM_STR);
        $stmt -> bindParam(":tweetID", $tweetID, PDO::PARAM_INT);
        $stmt -> execute();
    }

    public function checkRetweet($tweetID, $userID) {
        $this -> connect();
        $stmt = $this -> getDb() -> prepare("SELECT * FROM tweets WHERE retweetID = :tweetID AND retweetBy = :userID OR tweetID = :tweetID AND retweetBy = :userID");
        $stmt -> bindParam(":tweetID", $tweetID, PDO::PARAM_INT);
        $stmt -> bindParam(":userID", $userID, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetch(PDO::FETCH_ASSOC);
    }

    public function comments($tweetID) {
        $this -> connect();
        $stmt = $this -> getDb() -> prepare("SELECT * from comments left join users on commentBy = userID where commentOn = :tweetID");
        $stmt -> bindParam(":tweetID", $tweetID, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetchAll(PDO::FETCH_OBJ);
    }

    public function countTweets($userID) {
        $this -> connect();
        $stmt = $this -> getDb() -> prepare("SELECT COUNT(`tweetID`) AS `totalTweets` FROM `tweets` WHERE `tweetBy` = :userID");
        $stmt -> bindParam(":userID", $userID, PDO::PARAM_INT);
        $stmt -> execute();
        $count = $stmt -> fetch (PDO::FETCH_OBJ);
        echo $count -> totalTweets;
    }

    public function countLikes($userID) {
        $this -> connect();
        $stmt = $this -> getDb() -> prepare("SELECT COUNT(`likeID`) AS `totalLikes` FROM `likes` WHERE `likeBy` = :userID");
        $stmt -> bindParam(":userID", $userID, PDO::PARAM_INT);
        $stmt -> execute();
        $count = $stmt -> fetch(PDO::FETCH_OBJ);
        echo $count -> totalLikes;
    }

    public function getUserTweets($userID) {
        $this -> connect();
        $stmt = $this -> getDb() -> prepare("SELECT * FROM tweets LEFT JOIN users ON tweetBy = userID WHERE tweetBy = :userID");
        $stmt -> bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetchAll(PDO::FETCH_OBJ);
    }

    public function addLike($userID, $tweetID, $getID) {
        $this -> connect();
        $stmt = $this -> getDb() -> prepare("UPDATE tweets set likesCount = likesCount + 1 where tweetID = :tweetID");
        $stmt -> bindParam(":tweetID", $tweetID, PDO::PARAM_INT);
        $stmt -> execute();

        $sql = "INSERT INTO likes (likeBy, likeOn) VALUES (?, ?);";
        $stmt = $this -> getDb() -> prepare($sql);
        $stmt -> execute([$userID, $tweetID]);
    }
    
    public function unlike($userID, $tweetID, $getID) {
        $this -> connect();
        $stmt = $this -> getDb() -> prepare("UPDATE tweets set likesCount = likesCount - 1 where tweetID = :tweetID");
        $stmt -> bindParam(":tweetID", $tweetID, PDO::PARAM_INT);
        $stmt -> execute();

        $sql = "DELETE FROM likes WHERE likeBy = ? AND likeOn = ?";
        $stmt = $this -> getDb() -> prepare($sql);
        $stmt -> execute([$userID, $tweetID]);
    }

    public function likes($userID, $tweetID) {
        // $dbh = new Dbh;
        $this -> connect();
        $stmt = $this -> getDb() -> prepare("SELECT  * FROM likes WHERE likeBy = :userID AND likeOn = :tweetID");
        $stmt -> bindParam(":userID", $userID, PDO::PARAM_INT);
        $stmt -> bindParam(":tweetID", $tweetID, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetch(PDO::FETCH_ASSOC);
    }
}