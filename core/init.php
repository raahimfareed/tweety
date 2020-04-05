<?php
define("BASE_URL", "http://localhost:1111/tweety/");
include_once $_SERVER['DOCUMENT_ROOT'].'/tweety/classes/dbh.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/tweety/classes/user.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/tweety/classes/tweet.class.php';

session_start();

$dbh = new Dbh;
$dbh -> connect();

$user = new User;
$user -> getInfo($_SESSION['userEmail']);

$tweet = new Tweet;
