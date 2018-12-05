<?php

require_once('database.php');
session_start();

if( isset($_GET['register'])) {
    
    $username = $_GET['register'];
    $password = $_GET['pass'];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    
    $theDBA = new DatabaseAdaptor();
    $arr = $theDBA->getUsernames();
    $ID = count($arr);
    
    if (checkExistance($username, $arr) == false) {
        $theDBA->addAccount($ID, $username, $hash);
        $_SESSION['login'] = 1;
        echo $username;
        $_SESSION['login'] = 1;
        $_SESSION['id'] = $username;
    }
 }
 
 if ( isset ($_GET['login'])) {
     
     $username = $_GET['login'];
     $password = $_GET['pass'];
     
     $theDBA = new DatabaseAdaptor();
     $arr = $theDBA->getPassword();
     if(checkLogin($arr, $username, $password)) {
         echo $username;
         $_SESSION['login'] = 1;
         $_SESSION['id'] = $username;
     }
     else {
         echo 'Incorrect password';
     }
 }

 //returns true if username already exists. False otherwise
 function checkExistance($username, $arr) {
     for($i = 0; $i < count($arr); $i++) {
         if($arr[$i]['username'] == $username) {
             echo 'Account already exists!';
             return true;
         }
     }
     return false;
 }
 
 //Checks that password is correct
 function checkLogin($arr, $username, $pwd) {
     for($i = 0; $i < count($arr); $i++) {
         if($arr[$i]['username'] == $username) 
             return password_verify($pwd, $arr[$i]['password']); 
     }
 }