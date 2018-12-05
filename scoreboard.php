<?php

require_once('database.php');

if(! isset($_GET['username'])) {
    loadScores();
} else {
    $username = $_GET['username'];
    $count = $_GET['count'];
    updateScoreboard($username, $count);
    loadScores();
}

function loadScores() {
    $theDBA = new DatabaseAdaptor();
    $arr = $theDBA->loadScores();
    
    echo "<h4>Top 10 scores:</h4>";
    for($i = 0; $i < count($arr); $i++) {
        echo $arr[$i]['username'] . ": " . $arr[$i]['score'] . "<br>";
    }
}

function updateScoreboard($username, $count) {
    $theDBA = new DatabaseAdaptor();
    $arr = $theDBA->getID($username);
    $ID = $arr[0]['ID'];
    $theDBA->addScore($ID, $count);
}




