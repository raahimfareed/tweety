<?php
    session_start();
    include("classes/user.class.php");
    if(isset($_SESSION['userEmail'])) {
        header("Location: home.php");
    } else {

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media</title>

    <!-- Materialize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Material Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/main/custom.css">

</head>
<body class="grey lighten-2">
    <ul class="sidenav" id="mobile-sidenav">
        <li><a href="#!" class="grey-text text-darken-4">Home</a></li>
        <li><a href="#!" class="grey-text text-darken-4">About</a></li>
        <li><a href="#!" class="grey-text text-darken-4">Language</a></li>
    </ul>

    <header>
        <nav class="grey lighten-3 grey-text text-darken-4">
            <div class="nav-wrapper container">
                <a href="index.php" class="brand-logo center blue-text"><i class="fa fa-twitter fa-2x"></i></a>
                <a href="#!" class="sidenav-trigger" data-target="mobile-sidenav"><i class="material-icons grey-text text-darken-4">menu</i></a>
                <ul class="left hide-on-med-and-down">
                    <li><a href="#!" class="grey-text text-darken-4">Home</a></li>
                    <li><a href="#!" class="grey-text text-darken-4">About</a></li>
                </ul>
                <ul class="right hide-on-med-and-down">
                    <li><a href="#!" class="grey-text text-darken-4">Language</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <section class="parallax-container">
            <div class="parallax"><img src="https://source.unsplash.com/2560x1600/?tech,laptop"
                    class="main-banner hide-on-med-and-down" width="100"></div>
            <div class="parallax"><img src="https://source.unsplash.com/1600x2560/?mobile"
                    class="main-banner hide-on-large-only" width="100"></div>
            <div class="container section white-text">
                <div class="row">
                    <h1 class="hide-on-med-and-down">Twitter</h1>
                    <h1 class="hide-on-large-only center-align">Twitter</h1>
                    <div class="col s12 m7">
                        <p class="flow-text hide-on-med-and-down">A place to connect with your friends -- and Get updates from the people you love, And get the updates from the world!</p>
                        <p class="flow-text hide-on-large-only center-align">A place to connect with your friends -- and Get updates from the people you love, And get the updates from the world!</p>
                    </div>
                    <div class="col s12 m5">
                    <div class="row">
                        <div class="col s12">
                            <ul class="tabs tabs-fixed-width">
                                <li class="tab col s6"><a href="#login" class="blue-text">Login</a></li>
                                <li class="tab col s6"><a href="#signup" class="blue-text">Sign Up</a></li>
                            </ul>
                        </div>
                        <div id="login" class="col s12"><?php include 'login.php'; ?></div>
                        <div id="signup" class="col s12"><?php include 'signup.php'; ?></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- Materialize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/init.js"></script>
</body>
</html>


<?php
    }
?>