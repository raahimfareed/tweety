<?php
include_once 'dbh.class.php';

class User extends Dbh {
    private $userUID;
    private $userEmail;
    private $screenName;
    private $userID;
    private $profileImage;
    private $profileCover;
    private $userFollowing;
    private $userFollowers;
    private $userBio;
    private $userCountry;
    private $userWebsite;

    const NO_USER = "No user Found";

    public function signup ($userUID, $userEmail, $screenName, $userPassword) {
        $pdo = new Dbh;
        $pdo -> connect();
        $sql = "SELECT * FROM `users` WHERE `userUID` = ? OR `userEmail` = ?";
        $stmt = $pdo -> getDb() -> prepare($sql);
        $stmt -> execute([$userUID, $userEmail]);

        if ($stmt -> rowCount() > 0) {
            header("Location: ../../index.php?error=usertaken");
            exit();
        } else {
            $hashPassword = password_hash($userPassword, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (userUID, userEmail, screenName, userPassword) VALUES (?, ?, ?, ?);";
            $stmt = $pdo -> getDb() -> prepare($sql);
            $stmt -> execute([$userUID, $userEmail, $screenName, $hashPassword]);
            header("Location: ../../index.php?signup=success");
            exit();
        }
        // $pdo = null;
    }

    public function login ($userEmail, $userPassword) {
        $pdo = new Dbh;
        $pdo -> connect();
        $sql = "SELECT * FROM `users` WHERE `userEmail` = ?";
        $stmt = $pdo -> getDb() -> prepare($sql);
        $stmt -> execute([$userEmail]);
        if ($stmt -> rowCount() <= 0) {
            header("Location: ../../index.php?error=userdoesntexist");
            exit();
        } else {
            $row = $stmt -> fetch();
            $dehashPassword = password_verify($userPassword, $row['userPassword']);
            if ($dehashPassword) {
                $_SESSION['userEmail'] = $row['userEmail'];

                header("Location: ../../home.php?login=success");
                exit();
            } else {
                header("Location: ../../index.php?error=wrongpassword");
                exit();
            }

        }
        // $pdo = null;
    }

    public function create($table, $fields = array()) {
        $this -> connect();
        $columns = implode('.', array_keys($fields));
        $values = ':'.implode(', :', array_keys($fields));
        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";
        if ($stmt = $this -> getDb() -> prepare($sql)) {
            foreach($fields as $key => $data) {
                $stmt -> bindValue(':'.$key, $data);
            }
            $stmt -> execute();
            return $this -> getDb() -> lastInsertId();
        }
    }

    public function delete($table, $array) {
        $this -> connect();
        $sql = "DELETE FROM `{$table}`";
        $where = " WHERE ";

        foreach($array as $name => $value) {
            $sql .= "{$where} `{$name}` = :{$name}";
            $where = " AND ";
        }

        if ($stmt = $this -> getDb() -> prepare($sql)) {
            foreach($array as $name => $value) {
                $stmt -> bindValue(':'.$name, $value);
            }

            $stmt -> execute();
        }
    }

    public function loggedIn() {
        if (isset($_SESSION['userEmail'])) {
            if ($_SESSION['userEmail'] == "" || $_SESSION['userEmail'] == " ") {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function logout() {
        session_destroy();
        header("Location: ../../index.php");
        exit();
    }

    public function getInfo($userEmail) {
        $pdo = new Dbh;
        $pdo -> connect();
        $sql = "SELECT * FROM users WHERE userEmail = ?";
        $stmt = $pdo -> getDb() -> prepare($sql);
        $stmt -> execute([$userEmail]);

        if ($stmt -> rowCount() <= 0) {
            return self::NO_USER;
        } else {
            $row = $stmt -> fetch();
            $this -> userUID = $row['userUID'];
            $this -> userEmail = $row['userEmail'];
            $this -> screenName = $row['screenName'];
            $this -> userID = $row['userID'];
            $this -> profileImage = $row['profileImage'];
            $this -> profileCover = $row['profileCover'];
            $this -> userFollowing = $row['userFollowing'];
            $this -> userFollowers = $row['userFollowers'];
            $this -> userBio = $row['userBio'];
            $this -> userCountry = $row['userCountry'];
            $this -> userWebsite = $row['userWebsite'];
        }

        // $pdo = null;
    }

    public function userData($userID) {
        $this -> connect();
        $stmt = $this -> getDb() -> prepare("SELECT * from users where userID = :userID");
        $stmt -> bindParam(":userID", $userID, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetch(PDO::FETCH_OBJ);
    }

    public function getUserUID() {
        return $this -> userUID;
    }
    public function getUserEmail() {
        return $this -> userEmail;
    }
    public function getScreenName() {
        return $this -> screenName;
    }
    public function getUserID() {
        return $this -> userID;
    }
    public function getProfileImage() {
        return $this -> profileImage;
    }
    public function getProfileCover() {
        return $this -> profileCover;
    }
    public function getUserFollowing() {
        return $this -> userFollowing;
    }
    public function getUserFollowers() {
        return $this -> userFollowers;
    }
    public function getUserBio() {
        return $this -> userBio;
    }
    public function getUserCountry() {
        return $this -> userCountry;
    }
    public function getUserWebsite() {
        return $this -> userWebsite;
    }
    
    public function updateSettings($screenName, $userBio, $userCountry, $userWebsite, $userEmail) {
        $pdo = new Dbh;
        $pdo -> connect();
        $sql = "SELECT * FROM users WHERE userEmail = ?";
        $stmt = $pdo -> getDb() -> prepare($sql);
        $stmt -> execute([$userEmail]);
        
        if($stmt -> rowCount() < 1) {
            return false;
        } else {
            $sql = "UPDATE users SET screenName = ?, userBio = ?, userCountry = ?, userWebsite = ? WHERE userEmail = ?";
            $stmt = $pdo -> getDb() -> prepare($sql);
            $stmt -> execute([$screenName, $userBio, $userCountry, $userWebsite, $userEmail]);
            header("Location: ../../profile.php?settings=updated");
            exit();
        }
    }

    public function updateAccount($userEmail, $userUID) {
        $pdo = new Dbh;
        $pdo -> connect();
        $sql = "SELECT * FROM users WHERE userEmail = ?";
        $stmt = $pdo -> getDb() -> prepare($sql);
        $stmt -> execute([$userEmail]);
        
        if($stmt -> rowCount() < 1) {
            return false;
        } else {
            $sql = "UPDATE users SET userEmail = ?, userUID = ? WHERE userEmail = ?";
            $stmt = $pdo -> getDb() -> prepare($sql);
            $stmt -> execute([$userEmail, $userUID, $userEmail]);
            return true;
            
        }
    }

    public function changePassword($password, $userEmail) {
        $pdo = new Dbh;
        $pdo -> connect();
        $sql = "SELECT * FROM users WHERE userEmail = ?";
        $stmt = $pdo -> getDb() -> prepare($sql);
        $stmt -> execute([$userEmail]);

        if ($stmt -> rowCount() <= 0) {
            return false;
        } else {
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET userPassword = ? WHERE userEmail = ?";
            $stmt = $pdo -> getDb() -> prepare($sql);
            $stmt -> execute([$hashPassword, $userEmail]);
        }

        // $pdo = null;
    }

    public function search($search) {
        $dbh = new Dbh;
        $dbh -> connect();
        $stmt = $dbh -> getDb() -> prepare("SELECT `userID`, `userUID`, `screenName`, `profileImage`, `profileCover` FROM `users` WHERE `userUID` LIKE ? OR screenName LIKE ?");
        $stmt -> bindValue(1, $search.'%', PDO::PARAM_STR);
        $stmt -> bindValue(2, $search.'%', PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetchAll(PDO::FETCH_OBJ);
    }

    public function tweet($status, $image, $userEmail) {
        $dbh = new Dbh;
        $dbh -> connect();
        $sql = "SELECT * FROM users WHERE userEmail = ?";
        $stmt = $dbh -> getDb() -> prepare($sql);
        $stmt -> execute([$userEmail]);

        if ($stmt -> rowCount() < 1) {
            return false;
        } else {
            $row = $stmt -> fetch();
            $userID = $row['userID'];
            $sql = "INSERT INTO tweets (tweetStatus, tweetBy, tweetImage, postedOn) VALUES (?, ?, ?, ?);";
            $stmt = $dbh -> getDb() -> prepare($sql);
            if ($stmt -> execute([$status, $userID, $image, date('Y-m-d H:i:s')])) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function uploadImage($file) {
        $file = $_FILES['image'];
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
            if($fileError === 0) {
                if ($fileSize < 10485760) {
                    $this -> connect();
                    $sql = "INSERT INTO pictures (imagePath) VALUE (?)";
                    $stmt = $this -> getDb() -> prepare($sql);
                    $fileNameNew = uniqid('', true).".$ext";
                    $fileDestination = 'uploads/'.$fileNameNew;
                    $stmt -> execute([$fileDestination]); 
                    move_uploaded_file($fileTmpName, $_SERVER['DOCUMENT_ROOT'].'/tweety/'.$fileDestination);
                    header("Location: index.php?upload=successful");
                    exit();
                } else {
                    echo 'Your image should be less than 10MB. It is '. $fileSize/1024 .' KB';
                }
            } else {
                echo "There was an error uploading your file! Please try again.";
            }
        } else {
            echo "Wrong File Type!";
        }
    }

    public function timeAgo($datetime) {
        $time    = strtotime($datetime);
        $current = time();
        $seconds = $current - $time;
        $minutes = round($seconds / 60);
        $hours   = round($seconds / 3600);
        $months  = round($seconds / 2600640);

        if ($seconds <= 60) {
            if ($seconds == 0) {
                return 'now';
            } else {
                return $seconds.'s';
            }
        } else if ($minutes <= 60) {
            return $minutes."m";
        } else if ($hours <= 24) {
            return $hours.'h';
        } else if ($months <= 12) {
            return date('M j', $time);
        } else {
            return date('j M Y', $time);
        }
        }
    }