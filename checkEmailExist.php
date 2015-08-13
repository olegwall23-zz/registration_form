<?php
/**
 * Created by PhpStorm.
 * User: Sohan
 * Date: 10.08.2015
 * Time: 15:46
 */
$email = $_GET["email"];
if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $link = new mysqli('mysql.hostinger.com.ua', 'u312980625_db', 'mL:o5eQ$&Z/[jJV#m~');
    $link->select_db("u312980625_db");

    $query = "SELECT * FROM User WHERE email = '{$email}'";
    $result = $link->query($query);
    $length = $result->num_rows;

    if($length > 0){
        echo json_encode(0);
    } else {
        echo json_encode(1);
    }

    $link->close();
}