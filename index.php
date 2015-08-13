<?php
/**
 * Created by PhpStorm.
 * User: Sohan
 * Date: 09.08.2015
 * Time: 14:06
 */

if(isset($_COOKIE["e"]) && isset($_COOKIE["p"])){
    echo "Welcome " . $_COOKIE["e"];
    include 'profile.php';
} else {
    include 'login.php';
}
?>

