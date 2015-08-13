<?php

$idToRemove = $_GET['removeID'];
$newCaptchaId = $_GET['newID'];

function isNumber($value){
    $validNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

    if($value == null || $value[0] == '0'){
        return false;
    }

    $count = 0;
    for($i = 0; $i < strlen($value); $i++){
        for($j = 0; $j < 11; $j++){
            if($value[$i] == $validNumbers[$j]){
                $count++;
                $j = 11;
            }
        }
    }
    if($count == strlen($value)){
        return true;
    }
    return false;
}

$link = new mysqli('mysql.hostinger.com.ua', 'u312980625_db', 'mL:o5eQ$&Z/[jJV#m~');
$link->select_db("u312980625_db");

if(isNumber($idToRemove)){
    $query = "DELETE FROM Captcha WHERE id = '$idToRemove'";
    $result = $link->query($query);
}
if (isNumber($newCaptchaId)) {
    $captchaString = generateCaptcha();
    $query = "INSERT INTO Captcha (id, captcha, create_date) VALUES ('$newCaptchaId', '$captchaString', CURDATE())";
    $result = $link->query($query);
}

$link->close();

function generateCaptcha(){
    $abc = ['0','1','2','3','4','5', '6','7','8','9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i',
        'j', 'k', 'l',	'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
    $captchaString = "";
    $obstacles = ['///////////////', '---------------', '==============='];
    for($i = 0; $i < 8; $i++){
        if(rand(0, 1) == 0){
            $captchaString .= $abc[rand(0, 35)];
        } else {
            $captchaString .= strtoupper($abc[rand(0, 35)]);
        }
    }

    $image = imagecreatetruecolor(90,35);
    imagestring($image, 5, 5, 10, $captchaString , 0x00ff00);
    $gaussian = array(array(0.0, 0.0, 0.0), array(3.0, 5.0, 1.0), array(0.0, 3.0, 0.0));
    imageconvolution($image, $gaussian, 15, 15);
    header('Content-Type: image/png');
    imagestring($image, 5, 5, 10, $obstacles[rand(0, sizeof($obstacles) - 1)], 0x000000);
    imagepng($image, null, 9);
    return $captchaString;
}
?>