<?php
include_once('../init.php');

if (isset($_POST) && !empty($_POST)) {
    $status = $_POST['status'];
    $userID = $user -> getUserID();
    $tweetImage = '';

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

            $result['success'] = "Your tweet has been posted";
            echo json_encode($result);
        }
    }

    if (isset($error)) {
        $result['error'] = $error;
        echo json_encode($result);
    }
}