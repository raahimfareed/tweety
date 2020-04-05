<?php
    class Dbh {
        private $servername;
        private $username;
        private $password;
        private $dbname;
        private $charset;
        private $dbConn = null;
        private $error = null;

        public function connect() {
            $this -> servername = "localhost";
            $this -> username = "root";
            $this -> password = "";
            $this -> dbname = "socialmedia";
            $this -> charset = "utf8mb4";

            try {
                $dsn = 'mysql:dbname='.$this -> dbname.';host='.$this -> servername.';port=3308;charset='.$this -> charset;
                $this -> dbConn = new PDO($dsn, $this -> username, $this -> password);
                $this -> dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this -> dbConn;
            } catch (PDOException $e) {
                $this -> error = $e -> getMessage();
            }
        }
        public function getDb() {
            if ($this -> dbConn instanceof PDO) {
                return $this -> dbConn;
            }
        }
        public function setError($error) {
            $this -> error = $error;
        }
        public function getError() {
            return $this -> error;
        }
    }
