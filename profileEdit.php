<?php
include 'core/init.php';
if (!isset($_SESSION['userEmail'])) {
    header("Location: index.php");
} else {

    ?>



<!doctype html>
<html>
<head>
	<title>Profile edit page</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"/>
	<link rel="stylesheet" href="assets/css/style-complete.css" />
	<script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
	<script src="assets/js/image.js"></script>
</head>

<!--Helvetica Neue-->
<body>
<div class="wrapper">
	<!-- header wrapper -->
<div class="header-wrapper">

<div class="nav-container">
	<!-- Nav -->
	<div class="nav">
		<div class="nav-left">
			<ul>
				<li><a href="home.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
				<li><a href="i/notifications"><i class="fa fa-bell" aria-hidden="true"></i>Notification</a></li>
				<l><i class="fa fa-envelope" aria-hidden="true"></i>Messages</li>
			</ul>
		</div>
		<!-- nav left ends-->
		<div class="nav-right">
			<ul>
				<li><input type="text" placeholder="Search" class="search"/><i class="fa fa-search" aria-hidden="true"></i>
				<div class="search-result">

				</div></li>
				<li class="hover"><label class="drop-label" for="drop-wrap1"><img src="<?php echo $user->getProfileImage(); ?>"/></label>
				<input type="checkbox" id="drop-wrap1">
				<div class="drop-wrap">
					<div class="drop-inner">
						<ul>
							<li><a href="profile.php"><?php echo $user -> getUserUID(); ?></a></li>
							<li><a href="settings/account.php">Settings</a></li>
							<li><a href="includes/logout.php">Log out</a></li>
						</ul>
					</div>
				</div>
				</li>
				<li><label for="pop-up-tweet" class="addTweetBtn">Tweet</label></li>
			</ul>
		</div>
		<!-- nav right ends-->
	</div>
	<!-- nav ends -->
</div>
<!-- nav container ends -->
</div>
<!-- header wrapper end -->

<!--Profile cover-->
<div class="profile-cover-wrap">
<div class="profile-cover-inner">
	<div class="profile-cover-img">
	   <!-- PROFILE-COVER -->
		<img id="outputCover" src="<?php echo $user -> getProfileCover(); ?>"/>

		<div class="img-upload-button-wrap">
			<div class="img-upload-button1">
				<label for="cover-upload-btn">
					<i class="fa fa-camera" aria-hidden="true"></i>
				</label>
				<span class="span-text1">
					Change your profile photo
				</span>
				<input id="cover-upload-btn" type="checkbox"/>
				<div class="img-upload-menu1">
					<span class="img-upload-arrow"></span>
					<form action="includes/user/savechanges.inc.php" id="profileCover" method="post" enctype="multipart/form-data">
						<ul>
							<li>
								<label for="file-up">
									Upload photo
								</label>
								<input type="file" name="profileCover" onchange="coverImageUpdate(event)" id="file-up" required />
							</li>
								<li>
								<label for="cover-upload-btn">
									Cancel
								</label>
							</li>
						</ul>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="profile-nav">
	<div class="profile-navigation">
		<ul>
			<li>
				<a href="<?php echo BASE_URL.$user -> getUserUID().'/tweets'; ?>">
					<div class="n-head">
						TWEETS
					</div>
					<div class="n-bottom">
						<?php echo $tweet -> countTweets($user -> getUserID()) ?>
					</div>
				</a>
			</li>
			<li>
				<a href="<?php echo BASE_URL.$user -> getUserUID().'/following'; ?>">
					<div class="n-head">
						FOLLOWINGS
					</div>
					<div class="n-bottom">
                        <?php echo $user -> getUserFollowing(); ?>
					</div>
				</a>
			</li>
			<li>
				<a href="<?php echo BASE_URL.$user -> getUserUID().'/followers'; ?>">
					<div class="n-head">
						FOLLOWERS
					</div>
					<div class="n-bottom">
                        <?php echo $user->getUserFollowers(); ?>
					</div>
				</a>
			</li>
			<li>
				<a href="#">
					<div class="n-head">
						LIKES
					</div>
					<div class="n-bottom">
						<?php echo $tweet -> countLikes($user -> getUserID()); ?>
					</div>
				</a>
			</li>

		</ul>
		<!--
		<div class="edit-button">
			<span>
				<button class="f-btn" type="button" value="Cancel">Cancel</button>
			</span>
			<span>
				<input type="submit" name="submit" id="save" onclick="submitForms();" value="Save Changes">
			</span>

		</div>
		-->
	</div>
</div>
</div><!--Profile Cover End-->

<div class="in-wrapper">
<div class="in-full-wrap">
  <div class="in-left">
	<div class="in-left-wrap">
		<!--PROFILE INFO WRAPPER END-->
<div class="profile-info-wrap">
	<div class="profile-info-inner">
		<div class="profile-img">
			<!-- PROFILE-IMAGE -->
			<img id="outputImage" src="<?php echo $user->getProfileImage(); ?>"/>
 			<div class="img-upload-button-wrap1">
			 <div class="img-upload-button">
				<label for="img-upload-btn">
					<i class="fa fa-camera" aria-hidden="true"></i>
				</label>
				<span class="span-text">
					Change your profile photo
				</span>
				<input id="img-upload-btn" type="checkbox"/>
				<div class="img-upload-menu">
				 <span class="img-upload-arrow"></span>
					<form action="includes/user/savechanges.inc.php" id="profileImage" method="post" enctype="multipart/form-data">
						<ul>
							<li>
								<label for="profileImage">
									Upload photo
								</label>
								<input id="profileImage" type="file" onchange="profileImageUpdate(event)" name="profileImage" accept="image/*"  required />
							</li>
							<li><a href="#">Remove</a></li>
							<li>
								<label for="img-upload-btn">
									Cancel
								</label>
							</li>
						</ul>
					</form>
				</div>
			  </div>
			  <!-- img upload end-->
			</div>
		</div>

			    <form action="includes/user/savechanges.inc.php" id="userData" name="userData" method="post" enctype="multipart/Form-data">
				<div class="profile-name-wrap">
					<!-- <ul>
	 					 <li class="error-li">
						 	 <div class="span-pe-error"></div>
						 </li>
					 </ul>  -->
					<div class="profile-name">
						<input type="text" name="screenName" value="<?php echo $user->getScreenName(); ?>"/>
					</div>
					<div class="profile-tname">
						@<?php echo $user->getUserUID(); ?>
					</div>
				</div>
				<div class="profile-bio-wrap">
					<div class="profile-bio-inner">
						<textarea class="userBio" name="userBio"><?php echo $user->getUserBio(); ?></textarea>
						<div class="hash-box">
					 		<ul>
					 		</ul>
					 	</div>
					</div>
				</div>
					<div class="profile-extra-info">
					<div class="profile-extra-inner">
						<ul>
							<li>
								<div class="profile-ex-location">
									<input id="cn" type="text" name="userCountry" placeholder="Country" value="<?php echo $user->getUserCountry(); ?>" />
								</div>
							</li>
							<li>
								<div class="profile-ex-location">
									<input type="text" name="userWebsite" placeholder="Website" value="<?php echo $user->getUserWebsite(); ?>"/>
								</div>
                            </li>
                            <button type="submit" name="submit" style="background-color: #5ab2f5; color: #FFF; font-weight: 700; border-radius: 5px; border: none; padding: 10px; cursor: pointer;">Save Changes</button>
				</form>
						</ul>
					</div>
				</div>
				<div class="profile-extra-footer">
					<div class="profile-extra-footer-head">
						<div class="profile-extra-info">
							<ul>
								<li>
									<div class="profile-ex-location-i">
										<i class="fa fa-camera" aria-hidden="true"></i>
									</div>
									<div class="profile-ex-location">
										<a href="#">0 Photos and videos </a>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="profile-extra-footer-body">
						<ul>
						  <!-- <li><img src="#"></li> -->
						</ul>
					</div>
				</div>
			</div>
			<!--PROFILE INFO INNER END-->
		</div>
		<!--PROFILE INFO WRAPPER END-->
	</div>
	<!-- in left wrap-->
</div>
<!-- in left end-->

<div class="in-center">
	<div class="in-center-wrap">
		<?php
			$tweets = $tweet -> getUserTweets($user -> getUserID());
			foreach ((array_reverse($tweets)) as $tweety) {
				$likes =    $tweet -> likes($user -> getUserID(), $tweety -> tweetID);
				// $retweet =  $this -> checkRetweet($tweet -> tweetID, $userID);
				// $userData = $this -> userData($retweet['retweetBy']);
				echo '
				<div class="all-tweet">
					<div class="t-show-wrap">	
					<div class="t-show-inner">
						<div class="t-show-popup" data-tweet="'.$tweety -> tweetID.'">
							<div class="t-show-head">
								<div class="t-show-img">
									<img src="'.$tweety -> profileImage.'"/>
								</div>
								<div class="t-s-head-content">
									<div class="t-h-c-name">
										<span><a href="'.$tweety -> userUID.'">'.$tweety -> screenName.'</a></span>
										<span>@'.$tweety -> userUID.'</span>
										<span>'.$tweet -> timeAgo($tweety -> postedOn).'</span>
									</div>
									<div class="t-h-c-dis">
										'.$tweet -> getTweetLinks($tweety -> tweetStatus).'
									</div>
								</div>
							</div>';
							if (!empty($tweety -> tweetImage)) {
								echo '
									<!--tweet show head end-->
									<div class="t-show-body">
									<div class="t-s-b-inner">
									<div class="t-s-b-inner-in">
									<img src="http://localhost:1111/tweety/'.$tweety -> tweetImage.'" class="imagePopup" data-tweet="'.$tweety -> tweetID.'" />
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
									<li><button class="retweeted" data-tweet="" data-user=""><a href="#"><i class="fa fa-retweet" aria-hidden="true"></i></a><span class="retweetsCount">'.$tweety -> retweetCount.'</span></button></li>
									'.(($tweety -> tweetBy === $user -> getUserID()) ? '
									<li>'.(($likes['likeOn'] === $tweety -> tweetID) ? '<button class="unlike-btn" data-tweet="'.$tweety -> tweetID.'" data-user="'.$tweety -> tweetBy.'"><a href="#"><i class="fa fa-heart" aria-hidden="true"><span class="likesCounter">'.$tweety -> likesCount.'</span></i></a></button>' : '<button class="like-btn" data-tweet="'.$tweety -> tweetID.'" data-user="'.$tweety -> tweetBy.'"><a href="#"><i class="fa fa-heart-o" aria-hidden="true"><span class="likesCounter">'.(($tweety -> likesCount > 0) ? $tweety -> likesCount : '').'</span></i></a></button>').'</li>
										<li>
										<a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
										<ul> 
										<li><label class="deleteTweet" data-tweet="'.$tweety -> tweetID.'">Delete Tweet</label></li>
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
		?>
	</div>
	<!-- in left wrap-->
   <div class="popupTweet"></div>
   	<script src="assets/js/like.js"></script>
	<script src="assets/js/retweet.js"></script>
	<script src="assets/js/popuptweets.js"></script>
	<script src="assets/js/delete.js"></script>
	<script src="assets/js/comment.js"></script>
	<script src="assets/js/popupForm.js"></script>
	<script src="assets/js/search.js"></script>
	<script src="assets/js/hashtag.js"></script>

</div>
<!-- in center end -->

<div class="in-right">
	<div class="in-right-wrap">
		<!--==WHO TO FOLLOW==-->
           <!-- HERE -->
		<!--==WHO TO FOLLOW==-->

		<!--==TRENDS==-->
 	 	   <!-- HERE -->
	 	<!--==TRENDS==-->
	</div>
	<!-- in left wrap-->
</div>
<!-- in right end -->

   </div>
   <!--in full wrap end-->

  </div>
  <!-- in wrappper ends-->

</div>
<!-- ends wrapper -->

</body>
</html>

<?php
}
?>