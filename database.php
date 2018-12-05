<?php
Class DatabaseAdaptor {
    
    private $DB;
    
    public function __construct() {
        $dataBase = 'mysql:dbname=highscores;charset=utf8;host=127.0.0.1';
        $user = 'root';
        $password ='';
        try {
            $this->DB = new PDO ( $dataBase, $user, $password );
            $this->DB->setAttribute ( PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION );
        } catch ( PDOException $e ) {
            echo "Error Connection Not Established";
            exit ();
        }
    }
    
    public function loadScores() {
        $stmt = $this->DB->prepare( "SELECT accountInfo.username, scores.score FROM accountInfo
                                    JOIN scores
                                    ON accountInfo.ID = scores.ID;" );
        $stmt->execute ();
        return $stmt->fetchAll( PDO::FETCH_ASSOC );
    }
    
    //returns array of all usernames
    public function getUsernames() {
        $stmt = $this->DB->prepare( "SELECT username FROM accountInfo" );
        $stmt->execute ();
        return $stmt->fetchAll( PDO::FETCH_ASSOC );
    }
    
    //Adds account to database
    public function addAccount($ID, $user, $pwd) {
        $stmt = $this->DB->prepare( "INSERT into accountInfo (ID, username, password) values ('" . $ID . "', '" . $user . "', '" . $pwd . "')" );
        $stmt->execute ();
    }
    
    
    //returns array of [usernames, passwords]
    public function getPassword() {
        $stmt = $this->DB->prepare( "SELECT username, password FROM accountInfo" );
        $stmt->execute ();
        return $stmt->fetchAll( PDO::FETCH_ASSOC );
    }
    
    public function getID($username) {
        $stmt = $this->DB->prepare( "SELECT ID FROM accountInfo WHERE username='" . $username . "'" );
        $stmt->execute ();
        return $stmt->fetchAll( PDO::FETCH_ASSOC );
    }
    
    public function addScore($ID, $count) {
        $stmt = $this->DB->prepare( "INSERT into scores (ID, score) values ('" . $ID . "', " . $count . " )");
        $stmt->execute ();
    }
    
    
    
}