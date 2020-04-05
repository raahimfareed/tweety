<?php
    include_once('core/init.php');
    if (!isset($_SESSION['userEmail'])) {
        header("Location: index.php");
        exit();
        // echo 'Error';
    } else {
		// var_dump($tweet -> countTweets($user -> getUserID()));
		if (isset($_POST['tweet'])) {
			$status = $_POST['status'];
			$tweetImage = '';
			$fileDestination = '';
			if (!empty($status) or !empty($_FILES['file']['name'][0])) {
				if (!empty($_FILES['file']['name'][0])) {
					$file = $_FILES['file'];
					$fileName = $file['name'];
					$fileTmpName = $file['tmp_name'];
					$fileSize = $file['size'];
					$fileError = $file['error'];
					$fileType = $file['type'];
			
					$fileExt = explode('.', $fileName);
					// print_r($fileExt);
					$ext  = strtolower(end($fileExt));
					$allowedExt = array('jpg', 'jpeg', 'png', 'webp', 'gif');
		
					if (in_array($ext, $allowedExt)) {
						$fileNameNew = uniqid('', true).".$ext";
						$fileDestination = 'assets/images/tweets/'.$fileNameNew;
						move_uploaded_file($fileTmpName, $fileDestination);
					} else {
						$error = "Wrong Image Type";
					}
				}
				if (strlen($status) > 140) {
					$error = "Your tweet is too long!";
				} else {
					$user -> tweet($status, $fileDestination, $_SESSION['userEmail']);
					preg_match_all("/#+([a-zA-Z0-9_]+)/i", $status, $hashtag);
					if (!empty($hashtag)) {
						$tweet -> addTrend($status); 
					}

				}
			}


		} else {
			$error = "Status cannot be empty!";
		}
		
?>

<!DOCTYPE HTML> 
 <html>
	<head>
		<title>Tweety</title>
		  <meta charset="UTF-8" />
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"/>  
 	  	  <link rel="stylesheet" href="assets/css/style-complete.css"/> 
   		  <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>  	  
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
				<li><a href="#"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
				<li><a href="i/notifications"><i class="fa fa-bell" aria-hidden="true"></i>Notification</a></li>
				<li><i class="fa fa-envelope" aria-hidden="true"></i>Messages</li>
			</ul>
		</div><!-- nav left ends-->

		<div class="nav-right">
			<ul>
				<li>
					<input type="text" placeholder="Search" class="search"/>
					<i class="fa fa-search" aria-hidden="true"></i>
					<div class="search-result">			
					</div>
				</li>

				<li class="hover"><label class="drop-label" for="drop-wrap1"><img src="<?php echo $user -> getProfileImage() ?>"/></label>
				<input type="checkbox" id="drop-wrap1">
				<div class="drop-wrap">
					<div class="drop-inner">
						<ul>
							<li><a href="profile.php"><?php echo $user -> getUserUID() ?></a></li>
							<li><a href="settings/account.php">Settings</a></li>
							<li><a href="includes/user/logout.inc.php">Log out</a></li>
						</ul>
					</div>
				</div>
				</li>
				<li><label class="addTweetBtn">Tweet</label></li>
			</ul>
		</div><!-- nav right ends-->

	</div><!-- nav ends -->

</div><!-- nav container ends -->

</div><!-- header wrapper end -->

<script src="assets/js/search.js"></script>
<script src="assets/js/hashtag.js"></script>


<!---Inner wrapper-->
<div class="inner-wrapper">
<div class="in-wrapper">
	<div class="in-full-wrap">
		<div class="in-left">
			<div class="in-left-wrap">
		<div class="info-box">
			<div class="info-inner">
				<div class="info-in-head">
					<!-- PROFILE-COVER-IMAGE -->
					<img src="<?php echo $user -> getProfileCover() ?>"/>
				</div><!-- info in head end -->
				<div class="info-in-body">
					<div class="in-b-box">
						<div class="in-b-img">
						<!-- PROFILE-IMAGE -->
							<img src="<?php echo $user -> getProfileImage() ?>"/>
						</div>
					</div><!--  in b box end-->
					<div class="info-body-name">
						<div class="in-b-name">
							<div><a href="profile.php"><?php echo $user -> getScreenName() ?></a></div>
							<span><small><a href="profile.php">@<?php echo $user -> getUserUID() ?></a></small></span>
						</div><!-- in b name end-->
					</div><!-- info body name end-->
				</div><!-- info in body end-->
				<div class="info-in-footer">
					<div class="number-wrapper">
						<div class="num-box">
							<div class="num-head">
								TWEETS
							</div>
							<div class="num-body">
								<?php echo $tweet -> countTweets($user -> getUserId()) ?>
							</div>
						</div>
						<div class="num-box">
							<div class="num-head">
								FOLLOWING
							</div>
							<div class="num-body">
								<span class="count-following"><?php echo $user -> getUserFollowing() ?></span>
							</div>
						</div>
						<div class="num-box">
							<div class="num-head">
								FOLLOWERS
							</div>
							<div class="num-body">
								<span class="count-followers"><?php echo $user -> getUserFollowers() ?></span>
							</div>
						</div>	
					</div><!-- mumber wrapper-->
				</div><!-- info in footer -->
			</div><!-- info inner end -->
		</div><!-- info box end-->

	<!--==TRENDS==-->
 	  <!---TRENDS HERE-->
 	<!--==TRENDS==-->

	</div><!-- in left wrap-->
		</div><!-- in left end-->
		<div class="in-center">
			<div class="in-center-wrap">
				<!--TWEET WRAPPER-->
				<div class="tweet-wrap">
					<div class="tweet-inner">
						 <div class="tweet-h-left">
						 	<div class="tweet-h-img">
						 	<!-- PROFILE-IMAGE -->
						 		<img src="<?php echo $user -> getProfileImage() ?>"/>
						 	</div>
						 </div>
						 <div class="tweet-body">
						 <form method="post" enctype="multipart/form-data">
							<textarea class="status" name="status" placeholder="Type Something here!" rows="4" cols="50"></textarea>
 						 	<div class="hash-box">
						 		<ul>
  						 		</ul>
						 	</div>
 						 </div>
						 <div class="tweet-footer">
						 	<div class="t-fo-left">
						 		<ul>
						 			<input type="file" name="file" id="file"/>
						 			<li><label for="file"><i class="fa fa-camera" aria-hidden="true"></i></label>
						 			<span class="tweet-error"><?php if (isset($error)) {echo $error;} else if (isset($imageError)){echo $imageError;} ?></span>
						 			</li>
						 		</ul>
						 	</div>
						 	<div class="t-fo-right">
						 		<span id="count">140</span>
						 		<input type="submit" name="tweet" value="tweet"/>
				 		</form>
						 	</div>
						 </div>
					</div>
				</div><!--TWEET WRAP END-->

			
				<!--Tweet SHOW WRAPPER-->
				 <div class="tweets">
				 	<!-- <div class="all-tweet"> -->
					<?php 
						$tweet -> getTweets($user -> getUserID(), 5);
					?>
					<!-- </div> -->
 				 </div>
 				<!--TWEETS SHOW WRAPPER-->

		    	<div class="loading-div">
		    		<img id="loader" src="assets/images/loading.svg" style="display: none;"/> 
		    	</div>
				<div class="popupTweet"></div>
				<!--Tweet END WRAPER-->
				<script src="assets/js/like.js"></script>
				<script src="assets/js/retweet.js"></script>
				<script src="assets/js/popuptweets.js"></script>
				<script src="assets/js/delete.js"></script>
				<script src="assets/js/comment.js"></script>
				<script src="assets/js/popupForm.js"></script>
				<script src="assets/js/fetch.js"></script>
 			
			</div><!-- in left wrap-->
		</div><!-- in center end -->

		<div class="in-right">
			<div class="in-right-wrap">

		 	<!--Who To Follow-->
		      <!--WHO_TO_FOLLOW HERE-->
      		<!--Who To Follow-->

 			</div><!-- in left wrap-->

		</div><!-- in right end -->

	</div><!--in full wrap end-->

</div><!-- in wrappper ends-->
</div><!-- inner wrapper ends-->
</div><!-- ends wrapper -->
</body>

</html>

<?php
    }
?>