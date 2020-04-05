<?php
	include_once '../../core/init.php';
	$userID = $user -> getUserID();

	if (isset($_POST['retweet']) && !empty($_POST['retweet'])) {
		$tweetID = $_POST['retweet'];
		$getID = $_POST['userID'];
		$comment = $_POST['comment'];
		$tweet -> retweet($tweetID, $userID, $getID, $comment);
	}

    if (isset($_POST['showPopup']) && !empty($_POST['showPopup'])) {
        $tweetID = $_POST['showPopup'];
        $getID = $_POST['userID'];

		$userTweet = $tweet -> getPopupTweet($tweetID);
	
?>

<div class="retweet-popup">
<div class="wrap5">
	<div class="retweet-popup-body-wrap">
		<div class="retweet-popup-heading">
			<h3>Retweet this to followers?</h3>
			<span><button class="close-retweet-popup"><i class="fa fa-times" aria-hidden="true"></i></button></span>
		</div>
		<div class="retweet-popup-input">
			<div class="retweet-popup-input-inner">
				<input type="text" class="retweetMsg" placeholder="Add a comment.."/>
			</div>
		</div>
		<div class="retweet-popup-inner-body">
			<div class="retweet-popup-inner-body-inner">
				<div class="retweet-popup-comment-wrap">
					 <div class="retweet-popup-comment-head">
					 	<img src="<?php echo BASE_URL.$userTweet -> profileImage; ?>"/>
					 </div>
					 <div class="retweet-popup-comment-right-wrap">
						 <div class="retweet-popup-comment-headline">
						 	<a><?php echo $userTweet -> screenName ?> </a><span>‏@<?php echo $userTweet -> userUID ?> - <?php echo $userTweet -> postedOn ?></span>
						 </div>
						 <div class="retweet-popup-comment-body">
						 	<?php echo $tweet -> getTweetLinks($userTweet -> tweetStatus) ?>   - <?php echo $userTweet -> tweetImage ?>
						 </div>
					 </div>
				</div>
			</div>
		</div>
		<div class="retweet-popup-footer"> 
			<div class="retweet-popup-footer-right">
				<button class="retweet-it" type="submit"><i class="fa fa-retweet" aria-hidden="true"></i>Retweet</button>
			</div>
		</div>
	</div>
</div>
</div><!-- Retweet PopUp ends-->

<?php
    }

?>