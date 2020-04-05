<?php
    // include_once '../../classes/user.class.php';
    include_once '../../core/init.php';
    // session_start();

    if (isset($_POST['search']) && !empty($_POST['search'])) {
        // $user = new User;
        // $user -> connect();
        // $user -> getInfo($_SESSION['userEmail']);
        $search = $_POST['search'];
        $result = $user -> search($search);

        echo 
        "
            <div class='nav-right-down-wrap'>
                <ul>
        ";


        foreach ($result as $userInf) {
            echo '
            <li>
                <div class="nav-right-down-inner">
                    <div class="nav-right-down-left">
                        <a href="../../profile.php"><img src="'.BASE_URL.$userInf -> profileImage.'"></a>
                    </div>
                    <div class="nav-right-down-right">
                        <div class="nav-right-down-right-headline">
                            <a href="'.BASE_URL.'profile.php">'.$userInf -> screenName.'</a><span>@'.$userInf -> userUID.'</span>
                        </div>
                        <div class="nav-right-down-right-body">
                        
                        </div>
                    </div>
                </div> 
            </li>';
        }

        echo 
        "
                </ul>
            <div>
        ";
    }
?>