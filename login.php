<?php
/**
 * Created by PhpStorm.
 * User: Sohan
 * Date: 10.08.2015
 * Time: 17:19
 */

if(isset($_COOKIE["e"]) && isset($_COOKIE["p"])){
    header("Location: http://webmaster23.16mb.com"); /* Redirect browser */
    exit;
}

include 'incLang.php';

    $userEmail = $_POST['email'];
    $userPassword = $_POST['password'];
    $userCaptcha = $_POST['captcha'];
    $captchaId = $_POST['captchaID'];

    $isLoginError = false;
    $errors = [
        "userEmail" => [
            "correct" => 1,
            "errorType" => 0
        ],
        "userPassword" => [
            "correct" => 1,
            "errorType" => 0
        ],
        "userCaptcha" => [
            "correct" => 1,
            "errorType" => 0
        ],
    ];

    if ($userPassword != null) {
        if (strlen($userPassword) > 7) {
            if (strlen($userPassword) > 100) {
                $errors["userPassword"]["correct"] = 0;
                $errors["userPassword"]["errorType"] = 5;
            }
        } else {
            $errors["userPassword"]["correct"] = 0;
            $errors["userPassword"]["errorType"] = 4;
        }
    } else {
        $errors["userPassword"]["correct"] = 0;
        $errors["userPassword"]["errorType"] = 1;
    }

    if ($userEmail != null && strlen($userEmail) > 0) {
        if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
            $errors["userEmail"]["correct"] = 0;
            $errors["userEmail"]["errorType"] = 3;
        }
    } else {
        $errors["userEmail"]["correct"] = 0;
        $errors["userEmail"]["errorType"] = 1;
    }

    if ($captchaId != null) {
        $link = new mysqli('mysql.hostinger.com.ua', 'u312980625_db', 'mL:o5eQ$&Z/[jJV#m~');
        $link->select_db("u312980625_db");

        if ($userCaptcha != null) {
            $query = "SELECT captcha FROM Captcha WHERE id = '$captchaId'";
            $captcha = $link->query($query);
            $row = $captcha->fetch_assoc();
            if ($row['captcha'] != $userCaptcha) {
                $errors["userCaptcha"]["correct"] = 0;
                $errors["userCaptcha"]["errorType"] = 12;
            }
        } else {
            $errors["userCaptcha"]["correct"] = 0;
            $errors["userCaptcha"]["errorType"] = 1;
        }

        $query = "DELETE FROM Captcha WHERE id = '$captchaId'";
        $result = $link->query($query);
        $link->close();
    } else {
        $errors["userCaptcha"]["correct"] = 0;
        $errors["userCaptcha"]["errorType"] = 11;
    }

    if ($errors["userEmail"]["correct"] && $errors["userPassword"]["correct"] && $errors["userCaptcha"]["correct"]) {
        $link = new mysqli('mysql.hostinger.com.ua', 'u312980625_db', 'mL:o5eQ$&Z/[jJV#m~');
        $link->select_db("u312980625_db");
        $query = "SELECT * FROM User WHERE email = '{$userEmail}' AND password = '{$userPassword}'";
        $result = $link->query($query);
        if ($result) {
            $length = $result->num_rows;
            if ($length > 0) {
                setcookie("p", password_hash(($userPassword), PASSWORD_DEFAULT));
                setcookie("e", $userEmail);
                header("Location: http://webmaster23.16mb.com"); /* Redirect browser */
                exit;
            } else {
                $isLoginError = true;
            }
        } else {
            echo $language["SomethingWrong"];
            return;
        }
        $result = $link->query($query);
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title><? $language['PageTitleLogIn']; ?></title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" href="style.css" type="text/css" media="all" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

</head>
<div class="registrationForm">
    <h2><? echo $language['PageTitleLogIn']; ?></h2>
<form id="registrationForm" class="form" action="http://webmaster23.16mb.com/login.php?check=1" method="post">
    <p class="email">
        <input maxlength="50" type="text" name="email" value="<? if($dataCheck) echo $userEmail; ?>" id="email" placeholder="<? echo $language['InputEmail']; ?>" oninput="inputDataController.email(this)" onblur="inputDataController.email(this)" />
        <label id="emailLabel" style="color: red"for="email"></label>
    </p>
    <p class="password">
        <input maxlength="100" type="password" name="password" value="<? if($dataCheck) echo $userPassword; ?>" id="password" placeholder="<? echo $language['InputPassword']; ?>" oninput="inputDataController.password(this)" onblur="inputDataController.password(this)" />
        <label for="password" style="color: red" id="passwordLabel"></label>
    </p>
    <lable id="loginDataError" <? if($isLoginError){ echo 'style="color: red;visibility: visible"'; } else { echo 'style="color: red;visibility: hidden"'; }; ?>><? echo $language['wrongEmailOrPassword']; ?></lable>
    <p class="captcha">
        <img id="captchaImage"  style="display:inline-block;vertical-align:middle;" src="images/preloader.gif" />
        <textarea id="captchaID" name="captchaID" hidden></textarea>
        <input id="captcha" name="captcha" maxlength="20" style="display:inline-block;vertical-align:middle;width:150px;" type="text" placeholder="Input text from image" oninput="inputDataController.captcha(this);" />
        <img style="display:inline-block;vertical-align:middle;" src="images/update.png" onclick="captchaController.updateCaptcha();" />
        <lable id="captchaLabel" style="color: red"></lable>
    </p>
    <p class="submit">
        <input style="width: inherit" value="<? echo $language['LogIn']; ?>" id="submit" type="submit">
        &nbsp;&nbsp;<b><? echo $language['LoginOrSignIn']; ?></b>&nbsp;&nbsp;
        <a style="width inherit;" href="javascript:q=(document.location.href);void(open('http://webmaster23.16mb.com/registration.php','_self','resizable,location,menubar,toolbar,scrollbars,status'));"><? echo $language['SignUp']; ?></a>
    </p>
</form>
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
    var checkData = <? if($dataCheck){ echo $dataCheck; } else { echo '0'; } ?>;

    var errorStrings = {
        empty : "<? echo $language['ErrorInputEmpty']; ?>",
        email : "<? echo $language['ErrorInputEmail'] ?>",
        passwordMinLength : "<? echo $language['ErrorInputPasswordMinLength'] ?>",
        passwordMaxLength : "<? echo $language['ErrorInputPasswordMaxLength'] ?>",
        captcha : "<? echo $language['ErrorInputCaptcha'] ?>",
        wrongEmailOrPassword : "<? echo $language['wrongEmailOrPassword'] ?>"
    }

    var errorInfo = {
        dataChecked : <? if($dataCheck){ echo '1'; } else { echo '0'; } ?>,
        errorType : {
            noErrors : 0,
            empty : 1,
            email : 3,
            passwordMinLength : 4,
            passwordMaxLength : 5,
            captcha : 12,
            wrongEmailOrPassword : 14
        },
        emailError : {
            type : <? if($dataCheck){ if($errors["userEmail"]["correct"]) { echo 'undefined'; } else { echo $errors["userEmail"]["errorType"]; }} else { echo 'undefined'; } ?>,
            correct : <? if($dataCheck){ if($errors["userEmail"]["correct"]) { echo '1'; } else { echo '0'; }} else { echo 'undefined'; } ?>
        },
        passwordError : {
            type : <? if($dataCheck){ if($errors["userPassword"]["correct"]) { echo 'undefined'; } else { echo $errors["userPassword"]["errorType"]; }} else { echo 'undefined'; } ?>,
            correct : <? if($dataCheck){ if($errors["userPassword"]["correct"]) { echo '1'; } else { echo '0'; }} else { echo 'undefined'; } ?>
        },
        captchaError : {
            type : <? if($dataCheck){ if($errors["userCaptcha"]["correct"]) { echo 'undefined'; } else { echo $errors["userCaptcha"]["errorType"]; }} else { echo 'undefined'; } ?>,
            correct : <? if($dataCheck){ if($errors["userCaptcha"]["correct"]) { echo '1'; } else { echo '0'; }} else { echo 'undefined'; } ?>
        },
        updateErrorInfo : function(error ,correct, errorType){
            error.correct = correct;
            error.type = errorType;
        },
        containErrors : function(){
            if(errorInfo.nameError.correct && errorInfo.surnameError.correct && errorInfo.emailError.correct &&
                errorInfo.passwordError.correct && errorInfo.birthdayError.day.correct && errorInfo.birthdayError.month.correct &&
                errorInfo.birthdayError.year.correct && errorInfo.genderError.correct && errorInfo.imageError.correct){
                return false;
            }
            return true;
        }
    }
</script>
<script src="scripts/loginFormController.js"></script>
</html>