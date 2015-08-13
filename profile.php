<?php
/**
 * Created by PhpStorm.
 * User: Sohan
 * Date: 10.08.2015
 * Time: 17:12
 */

include 'incLang.php';

$userEmail = $_COOKIE["e"];

$link = new mysqli('mysql.hostinger.com.ua', 'u312980625_db', 'mL:o5eQ$&Z/[jJV#m~');
$link->select_db("u312980625_db");

$query = "SELECT * FROM User WHERE email = '{$userEmail}'";
$result = $link->query($query);
$userInfo = $result->fetch_assoc();
$user["password"] = $userInfo["password"];

$ok = password_verify($user["password"], $_COOKIE["p"]);
echo '  ' . $ok;
if($ok) {
    $user = [
        name => null,
        surname => null,
        email => $userEmail,
        birthday => null,
        gender => null,
        image => null,
        imageName => null
    ];


    $query = "SELECT * FROM User WHERE email = '{$userEmail}'";
    $result = $link->query($query);

    if ($result) {
        $userInfo = $result->fetch_assoc();

        echo $userInfo->num_rows;

        $user["name"] = $userInfo["name"];
        $user["surname"] = $userInfo["surname"];
        $user["birthday"] = $userInfo["birthday"];
        $user["gender"] = $userInfo["gender"];

        $query = "SELECT image_name, image FROM UserImage WHERE user_id = '{$userInfo['user_id']}'";
        $result = $link->query($query);
        if ($result) {
            $userInfo = $result->fetch_assoc();
            $user["image"] = $userInfo["image"];
            $user["imageName"] = $userInfo["image_name"];
        } else {
            echo $language["SomethingWrong"];
            exit;
        }
    } else {
        echo $language["SomethingWrong"];
        exit;
    }
}
$link->close();

?>
<!DOCTYPE html>
<html>
<head>
    <title><? echo $language['PageTitleProfile']; ?></title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" href="style.css" type="text/css" media="all" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

</head>
<div class="registrationForm">
    <h2><? echo $language['PageTitleProfile']; ?></h2>

    <p>
        <b><? echo $language["InputName"]; ?>:</b>&nbsp;<i><? echo $user["name"]; ?></i><br>
        <b><? echo $language["InputSurname"]; ?>:</b>&nbsp;<i><? echo $user["surname"]; ?></i><br>
        <b><? echo $language["InputEmail"]; ?>:</b>&nbsp;<i><? echo $user["email"]; ?></i><br>
        <b><? echo $language["SelectGender"]; ?>:</b>&nbsp;<i><? if($user["gender"] == 1){ echo $language["SelectGenderMale"];}else if($user["gender"] == 2){echo $language["SelectGenderFemale"];} ?></i><br>
        <b><? echo $language["BirthdayLabel"]; ?>:</b>&nbsp;<i><? echo $user["birthday"]; ?></i><br>

            <b><? echo $language["ImageTitle"]; ?>:</b>&nbsp;<? echo '<img  style="vertical-align:middle;" src="data:image/jpeg;base64,' . base64_encode( $user['image'] ) . '" />'; ?><br>

    </p>

    <p>
        <input style="width: inherit" type="button" onclick="logout();" value="<? echo $language["logout"]; ?>">
    </p>

    <br><br><br>
    <footer>
        <hr>
        <i><? echo $language["Languages"]; ?> :</i>&nbsp;&nbsp;
        <a href="?lang=eng">English</a>&nbsp;&nbsp;
        <a href="?lang=ukr">Українська</a>&nbsp;&nbsp;
        <a href="?lang=rus">Руский</a>
    </footer>
</div>
<script>
    function logout(name){
        cookie.setCookie('p', "", {
            expires: -1
        });
        cookie.setCookie('n', "", {
            expires: -1
        });
        location.reload();
    }
    var cookie = {
        setCookie : function(name, value, options) {
            options = options || {};

            var expires = options.expires;

            if (typeof expires == "number" && expires) {
                var d = new Date();
                d.setTime(d.getTime() + expires * 1000);
                expires = options.expires = d;
            }
            if (expires && expires.toUTCString) {
                options.expires = expires.toUTCString();
            }

            value = encodeURIComponent(value);

            var updatedCookie = name + "=" + value;

            for (var propName in options) {
                updatedCookie += "; " + propName;
                var propValue = options[propName];
                if (propValue !== true) {
                    updatedCookie += "=" + propValue;
                }
            }

            document.cookie = updatedCookie;
        },
        deleteCookie : function(name) {
            this.setCookie(name, "", {
                expires: -1
            })
        },
        getCookie : function(name) {
            var matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        }
    }
</script>
</html>
