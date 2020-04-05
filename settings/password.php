<?php
include '../classes/user.class.php';
session_start();
if (!isset($_SESSION['userEmail'])) {
    header("Location: index.php");
} else {
    $user = new User;
    $user->getInfo($_SESSION['userEmail']);
?>
<html>
	<head>
		<title>Password settings page</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"/>
  		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
		<link rel="stylesheet" href="../assets/css/style-complete.css"/>
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
				<li id="messagePopup" rel="user_id"><i class="fa fa-envelope" aria-hidden="true"></i>Messages</li>
 			</ul>
		</div><!-- nav left ends-->
		<div class="nav-right">
			<ul>
				<li><input type="text" placeholder="Search" class="search"/><i class="fa fa-search" aria-hidden="true"></i></li>
				<div class="search-result">
					 			
				</div>
 				<li class="hover"><label class="drop-label" for="drop-wrap1"><img src="../<?php echo $user -> getProfileImage(); ?>"/></label>
				<input type="checkbox" id="drop-wrap1">
				<div class="drop-wrap">
					<div class="drop-inner">
						<ul>
							<li><a href="../profile.php"><?php echo $user -> getUserUID(); ?></a></li>
							<li><a href="account.php">Account</a></li>
							<li><a href="../includes/user/logout.inc.php">Log out</a></li>
						</ul>
					</div>
				</div>
				</li>
				<li><label for="pop-up-tweet">Tweet</label></li>
			</ul>
		</div>
		<!-- nav right ends-->
	</div>
	 <!-- nav ends -->
	</div><!-- nav container ends -->
</div><!-- header wrapper end -->
<div class="container-wrap">
	<div class="lefter">
		<div class="inner-lefter">
			<div class="acc-info-wrap">
				<div class="acc-info-bg">
					<!-- PROFILE-COVER -->
					<img id="outputCover" src="../<?php echo $user -> getProfileCover(); ?>"/>
				</div>
				<div class="acc-info-img">
					<!-- PROFILE-IMAGE -->
					<img src="../<?php echo $user -> getProfileImage(); ?>"/>
				</div>
				<div class="acc-info-name">
					<h3><?php echo $user -> getScreenName() ?></h3>
					<span><a href="../profile.php">@<?php echo $user -> getUserUID() ?></a></span>
				</div>
			</div>
			<!--Acc info wrap end-->
			<div class="option-box">
				<ul>
					<li>
						<a href="account.php" class="bold">
						<div>	
							Account
							<span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
						</div>
						</a>
					</li>
					<li>
						<a href="#">
						<div>
							Password
							<span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
						</div>
						</a>
					</li>
				</ul>
			</div>

		</div>
	</div><!--LEFTER ENDS-->
	
	<div class="righter">
		<div class="inner-righter">
			<div class="acc">
				<div class="acc-heading">
					<h2>Password</h2>
					<h3>Change your password or recover your current one.</h3>
				</div>
				<form method="POST" action="../includes/password.inc.php">
				<div class="acc-content">
					<div class="acc-wrap">
						<div class="acc-left">
							Current password
						</div>
						<div class="acc-right">
							<input type="password" name="currentPassword"/>
							<span>
								<!-- Current Pwd Error -->
							</span>
						</div>
					</div>

					<div class="acc-wrap">
						<div class="acc-left">
							New password
						</div>
						<div class="acc-right">
							<input type="password" name="newPassword" />
							<span>
								<!-- NewPassword Error -->
							</span>
						</div>
					</div>

					<div class="acc-wrap">
						<div class="acc-left">
							Verify password
						</div>
						<div class="acc-right">
							<input type="password" name="rePassword"/>
							<span>
								<!-- RePassword Error -->
							</span>
						</div>
					</div>
					<div class="acc-wrap">
						<div class="acc-left">
						</div>
						<div class="acc-right">
							<input type="Submit" name="submit" value="Save changes"/>
						</div>
						<div class="settings-error">
							<!-- Fields Error -->
 						</div>	
					</div>
				 </form>
				</div>
			</div>
			<div class="content-setting">
				<div class="content-heading">
					
				</div>
				<div class="content-content">
					<div class="content-left">
						
					</div>
					<div class="content-right">
						
					</div>
				</div>
			</div>
		</div>	
	</div>
	<!--RIGHTER ENDS-->
</div>
<!--CONTAINER_WRAP ENDS-->
</div>
<!-- ends wrapper -->
</body>
</html>
<?php } ?>