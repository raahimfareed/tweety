<?php
include_once '../../core/init.php';

if (isset($_POST['showpopup']) && !empty($_POST['showpopup'])) {
    $tweetID = $_POST['showpopup'];
    $userID = $user -> getUserID();
	$popupTweet = $tweet -> getPopupTweet($tweetID);
	$popupUser = $user -> userData($userID);
	$likes = $tweet -> likes($userID, $tweetID);
	$retweet = $tweet -> checkRetweet($tweetID, $userID);
	$comments = $tweet -> comments($tweetID);
?>

<div class="tweet-show-popup-wrap">
<input type="checkbox" id="tweet-show-popup-wrap">
<div class="wrap4">
	<label for="tweet-show-popup-wrap">
		<div class="tweet-show-popup-box-cut">
			<i class="fa fa-times" aria-hidden="true"></i>
		</div>
	</label>
	<div class="tweet-show-popup-box">
	<div class="tweet-show-popup-inner">
		<div class="tweet-show-popup-head">
			<div class="tweet-show-popup-head-left">
				<div class="tweet-show-popup-img">
					<img src="<?php echo BASE_URL.$popupTweet -> profileImage; ?>"/>
				</div>
				<div class="tweet-show-popup-name">
					<div class="t-s-p-n">
						<a href="<?php echo BASE_URL.$popupTweet -> userUID; ?>">
                            <?php echo $popupTweet -> screenName; ?>
						</a>
					</div>
					<div class="t-s-p-n-b">
						<a href="<?php echo BASE_URL.$popupTweet -> userUID; ?>">
							@<?php echo $popupTweet -> userUID; ?>
						</a>
					</div>
				</div>
			</div>
			<div class="tweet-show-popup-head-right">
				  <button class="f-btn"><i class="fa fa-user-plus"></i> Follow </button>
			</div>
		</div>
		<div class="tweet-show-popup-tweet-wrap">
			<div class="tweet-show-popup-tweet">
				<?php echo $tweet -> getTweetLinks($popupTweet -> tweetStatus); ?>
			</div>
			<div class="tweet-show-popup-tweet-ifram">
			<?php if(!empty($popupTweet -> tweetImage)) { ?>
  			    <img src="<?php echo BASE_URL.$popupTweet -> tweetImage; ?>"/> 
			<?php } ?>
			</div>
		</div>
		<div class="tweet-show-popup-footer-wrap">
			<div class="tweet-show-popup-retweet-like">
				<div class="tweet-show-popup-retweet-left">
					<div class="tweet-retweet-count-wrap">
						<div class="tweet-retweet-count-head">
							RETWEET
						</div>
						<div class="tweet-retweet-count-body">
							<?php echo $popupTweet -> retweetCount; ?>
						</div>
					</div>
					<div class="tweet-like-count-wrap">
						<div class="tweet-like-count-head">
							LIKES
						</div>
						<div class="tweet-like-count-body">
							<?php echo $popupTweet -> likesCount; ?>
						</div>
					</div>
				</div>
				<div class="tweet-show-popup-retweet-right">
				 
				</div>
			</div>
			<div class="tweet-show-popup-time">
				<span><?php echo $popupTweet -> postedOn; ?></span>
			</div>
			<div class="tweet-show-popup-footer-menu">
				<ul>
				<?php 
				if($user -> loggedIn() === true){
					echo '<li><button><a href="#"><i class="fa fa-share" aria-hidden="true"></i></a></button></li>	
						<li><button class="retweet" data-tweet="'.$popupTweet -> tweetBy.'"><a href="#"><i class="fa fa-retweet" aria-hidden="true"></i></a><span class="retweetsCount"></span></button></li>
						<li>'.(($likes['likeOn'] === $popupTweet -> tweetID) ? '<button class="unlike-btn" data-tweet="'.$popupTweet -> tweetID.'" data-user="'.$popupTweet -> tweetBy.'"><a href="#"><i class="fa fa-heart" aria-hidden="true"><span class="likesCounter">'.$popupTweet -> likesCount.'</span></i></a></button>' : '<button class="like-btn" data-tweet="'.$popupTweet -> tweetID.'" data-user="'.$popupTweet -> tweetBy.'"><a href="#"><i class="fa fa-heart-o" aria-hidden="true"><span class="likesCounter">'.(($popupTweet -> likesCount > 0) ? $popupTweet -> likesCount : '').'</span></i></a></button>').'</li>
						'.(($popupTweet -> tweetBy === $userID) ? '	
						<li>
							<a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
							<ul> 
							<li><label class="deleteTweet" data-tweet="'.$popupTweet -> tweetID.'">Delete Tweet</label></li>
							</ul>
						</li>' : '');
				} else {
					
				?>
					<li><button type="buttton"><i class="fa fa-share" aria-hidden="true"></i></button></li>
					<li><button type="button"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount"><?php echo $popupTweet -> retweetCount; ?></span></button></li>
					<li><button type="button"><i class="fa fa-heart" aria-hidden="true"></i><span class="likesCount"><?php echo $popupTweet -> likesCount; ?></span></button></button></li>
					
				<?php  } ?>
				</ul>
			</div>
		</div>
	</div><!--tweet-show-popup-inner end-->
	<?php #if ($user -> loggedIn() === true) {?>
 	<div class="tweet-show-popup-footer-input-wrap">
		<div class="tweet-show-popup-footer-input-inner">
			<div class="tweet-show-popup-footer-input-left">
				<img src="<?php echo BASE_URL.$user -> getProfileImage(); ?>"/>
			</div>
			<div class="tweet-show-popup-footer-input-right">
				<input id="commentField" type="text" name="comment" data-tweet="<?php echo $popupTweet -> tweetID ?>"  placeholder="Reply to @<?php echo $popupTweet -> userUID; ?>">
			</div>
		</div>
		<div class="tweet-footer">
		 	<div class="t-fo-left">
		 		<ul>
		 			<li>
		 				<!-- <label for="t-show-file"><i class="fa fa-camera" aria-hidden="true"></i></label>
		 				<input type="file" id="t-show-file"> -->
		 			</li>
		 			<li class="error-li">
				    </li> 
		 		</ul>
		 	</div>
		 	<div class="t-fo-right">
				  <input type="submit" id="postComment">
				  <!-- <script src="<?php #echo BASE_URL; ?>assets/js/comment.js"></script> -->
		 	</div>
		 </div>
	</div><!--tweet-show-popup-footer-input-wrap end-->
	<?php #} ?>
<div class="tweet-show-popup-comment-wrap">
	<div id="comments">
		 <?php
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
										<p><a href="'.BASE_URL.$popupTweet -> userUID.'">@'.$comment -> userUID.'</a> '.$comment -> comment.'</p>
								</div>
								<div class="tweet-show-popup-footer-menu">
									<ul>
										<li><button><i class="fa fa-share" aria-hidden="true"></i></button></li>
										<li><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
										'.(($comment -> commentBy === $userID) ? '
										<li>
										<a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
										<ul> 
										<li><label class="deleteComment" data-tweet="'.$popupTweet -> tweetID.'" data-comment="'.$comment -> commentID.'">Delete Tweet</label></li>
										</ul>
										</li>' : '').'
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!--TWEET SHOW POPUP COMMENT inner END-->
				</div>
				';
			 }
		 ?>
	</div>

</div>
<!--tweet-show-popup-box ends-->
</div>
</div>

<?php
}
?>