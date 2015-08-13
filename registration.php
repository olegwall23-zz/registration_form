<?php
/**
 * Created by PhpStorm.
 * User: Sohan
 * Date: 31.07.2015
 * Time: 12:05
 */

if(isset($_COOKIE["e"]) && isset($_COOKIE["p"])){
    header("Location: http://webmaster23.16mb.com"); /* Redirect browser */
    exit;
}

include 'incLang.php';

if($dataCheck){
    $userName = $_POST['name'];
    $userSurname = $_POST['surname'];
    $userEmail = $_POST['email'];
    $userPassword = $_POST['password'];
    $userBirthdayDay = $_POST['birthdayDay'];
    $userBirthdayMonth = $_POST['birthdayMonth'];
    $userBirthdayYear = $_POST['birthdayYear'];
    $userGender = $_POST['gender'];
    $userImage = $_POST['image'];
    $userCaptcha = $_POST['captcha'];
    $captchaId = $_POST['captchaID'];

    $errors = [
        "userName" => [
            "correct" => 1,
            "errorType" => 0
        ],
        "userSurname" => [
            "correct" => 1,
            "errorType" => 0
        ],
        "userEmail" => [
            "correct" => 1,
            "errorType" => 0
        ],
        "userPassword" => [
            "correct" => 1,
            "errorType" => 0
        ],
        "userBirthdayDay" => [
            "correct" => 1,
            "errorType" => 0
        ],
        "userBirthdayMonth" => [
            "correct" => 1,
            "errorType" => 0,
            "selected" => 0
        ],
        "userBirthdayYear" => [
            "correct" => 1,
            "errorType" => 0
        ],
        "userGender" => [
            "correct" => 1,
            "errorType" => 0,
            "selected" => 0
        ],
        "userImage" => [
            "correct" => 1,
            "errorType" => 0
        ],
        "userCaptcha" => [
            "correct" => 1,
            "errorType" => 0
        ],
    ];

    function nameSurnameValidate($string){
        return preg_match('/[\s#$%^&*()+=\-\[\]\';,0-9.\/{}|":<>?~\\\\]/', $string);
    }

    if($userName != null || strlen($userName) > 0){
        if(nameSurnameValidate($userName)){
            $errors["userName"]["correct"] = 0;
            $errors["userName"]["errorType"] = 2;
        }
    } else {
        $errors["userName"]["correct"] = 0;
        $errors["userName"]["errorType"] = 1;
    }

    if($userSurname != null && strlen($userSurname) > 0){
        if(nameSurnameValidate($userSurname)){
            $errors["userSurname"]["correct"] = 0;
            $errors["userSurname"]["errorType"] = 2;
        }
    } else {
        $errors["userSurname"]["correct"] = 0;
        $errors["userSurname"]["errorType"] = 1;
    }

    if($userEmail != null && strlen($userEmail) > 0){
        if(filter_var($userEmail, FILTER_VALIDATE_EMAIL)){
            $link = new mysqli('mysql.hostinger.com.ua', 'u312980625_db', 'mL:o5eQ$&Z/[jJV#m~');
            $link->select_db("u312980625_db");

            $query = "SELECT * FROM User WHERE email = '{$userEmail}'";
            $result = $link->query($query);
            $rows = $result->num_rows;

            if($rows > 0){
                $errors["userEmail"]["correct"] = 0;
                $errors["userEmail"]["errorType"] = 13;
            }

            $link->close();

        } else {
            $errors["userEmail"]["correct"] = 0;
            $errors["userEmail"]["errorType"] = 3;
        }
    } else {
        $errors["userEmail"]["correct"] = 0;
        $errors["userEmail"]["errorType"] = 1;
    }

    if($userPassword != null){
        if(strlen($value) < 7){
            if(strlen($value) > 100){
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

    if($userBirthdayDay != null && strlen($userBirthdayDay) > 0){
        if(is_numeric($userBirthdayDay)){
            if((int)$userBirthdayDay <= 0  && (int)$userBirthdayDay > 32){
                $errors["userBirthdayDay"]["correct"] = 0;
                $errors["userBirthdayDay"]["errorType"] = 8;
            }
        } else {
            $errors["userBirthdayDay"]["correct"] = 0;
            $errors["userBirthdayDay"]["errorType"] = 7;
        }
    } else {
        $errors["userBirthdayDay"]["correct"] = 0;
        $errors["userBirthdayDay"]["errorType"] = 1;
    }

    if((int)$userBirthdayMonth != 0){
        if(is_numeric($userBirthdayMonth)){
            if((int)$userBirthdayMonth > 0  && (int)$userBirthdayMonth < 13){
                $errors["userBirthdayMonth"]["selected"] = (int)$userBirthdayMonth;
            } else {
                $errors["userBirthdayMonth"]["correct"] = 0;
                $errors["userBirthdayMonth"]["errorType"] = 8;
            }
        } else {
            $errors["userBirthdayMonth"]["correct"] = 0;
            $errors["userBirthdayMonth"]["errorType"] = 8;
        }
    } else {
        $errors["userBirthdayMonth"]["correct"] = 0;
        $errors["userBirthdayMonth"]["errorType"] = 1;
    }

    if($userBirthdayYear != null){
        if(is_numeric($userBirthdayYear)){
            if((int)$userBirthdayYear <= (strftime("%Y") - 150) && (int)$userBirthdayYear > strftime("%Y")){
                $errors["userBirthdayYear"]["correct"] = 0;
                $errors["userBirthdayYear"]["errorType"] = 8;
            }
        } else {
            $errors["userBirthdayYear"]["correct"] = 0;
            $errors["userBirthdayYear"]["errorType"] = 9;
        }
    } else {
        $errors["userBirthdayYear"]["correct"] = 0;
        $errors["userBirthdayYear"]["errorType"] = 1;
    }

    if($userGender != null || (int)$userGender == 0){
        if(is_numeric($userGender)){
            if((int)$userGender > 0  && (int)$userGender <= 2){
                $errors["userGender"]["selected"] = (int)$userGender;
            } else {
                $errors["userGender"]["correct"] = 0;
                $errors["userGender"]["errorType"] = 8;
            }
        } else {
            $errors["userGender"]["correct"] = 0;
            $errors["userGender"]["errorType"] = 7;
        }
    } else {
        $errors["userGender"]["correct"] = 0;
        $errors["userGender"]["errorType"] = 1;
    }

    if($captchaId != null){
        $link = new mysqli('mysql.hostinger.com.ua', 'u312980625_db', 'mL:o5eQ$&Z/[jJV#m~');
        $link->select_db("u312980625_db");

        if($userCaptcha != null){
            $query = "SELECT captcha FROM Captcha WHERE id = '$captchaId'";
            $captcha = $link->query($query);
            $row = $captcha->fetch_assoc();
            if($row['captcha'] != $userCaptcha){
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

    if(
        $errors["userName"]["correct"] == 1 &&
        $errors["userSurname"]["correct"] == 1 &&
        $errors["userEmail"]["correct"] == 1 &&
        $errors["userPassword"]["correct"] == 1 &&
        $errors["userBirthdayMonth"]["correct"] == 1 &&
        $errors["userBirthdayDay"]["correct"] == 1 &&
        $errors["userBirthdayYear"]["correct"] == 1 &&
        $errors["userGender"]["correct"] == 1 &&
        $errors["userCaptcha"]["correct"] == 1
    ) {
// Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["userImage"]["tmp_name"]);
            if($check === false) {
                $errors["userImage"]["correct"] = 0;
                $errors["userImage"]["errorType"] = 11;
            }
        }

// Check file size
        if ($_FILES["userImage"]["size"] > 64000) {
            $errors["userImage"]["correct"] = 0;
            $errors["userImage"]["errorType"] = 14;
        }

// Allow certain file formats
        if($_FILES["userImage"]["type"] != "image/jpeg" && $_FILES["userImage"]["type"] != "image/png" && $_FILES["userImage"]["type"] != "image/gif" ) {
            $errors["userImage"]["correct"] = 0;
            $errors["userImage"]["errorType"] = 6;
        }

        if($errors["userImage"]["correct"]){
            $link = new mysqli('mysql.hostinger.com.ua', 'u312980625_db', 'mL:o5eQ$&Z/[jJV#m~');
            $link->select_db("u312980625_db");

            $userName = addslashes($userName);
            $userSurname = addslashes($userSurname);
            $userEmail = addslashes($userEmail);
            $userPassword = $userPassword;
            $userBirthday = $userBirthdayYear . '-' . $userBirthdayMonth . '-' . $userBirthdayDay;
            $userGender = addslashes($userGender);


            $query = "INSERT INTO User (name, surname, email, password, birthday, gender) VALUES
                      ('{$userName}', '{$userSurname}', '{$userEmail}', '{$userPassword}', '{$userBirthday}', '{$userGender}')";
            $result = $link->query($query);
            if($result){
                setcookie("p", password_hash($userPassword, PASSWORD_DEFAULT));
                setcookie("e", $userEmail);

                $query = "SELECT user_id FROM User WHERE email = '$userEmail'";
                $result = $link->query($query);
                $userRow = $result->fetch_assoc();

                $image = addslashes(file_get_contents($_FILES['userImage']['tmp_name'])); //SQL Injection defence!
                $image_name = addslashes($_FILES['userImage']['name']);

                $query = "INSERT INTO UserImage (user_id, image, image_name) VALUES ('{$userRow['user_id']}', '{$image}', '{$image_name}')";
                $result = $link->query($query);
            } else {
                echo $language["SomethingWrong"];
                return;
            }
            $link->close();

            header("Location: http://webmaster23.16mb.com"); /* Redirect browser */
            exit;
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title><? echo $language['PageTitleSignUp']; ?></title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" href="style.css" type="text/css" media="all" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

</head>

<footer>

    <div class="registrationForm">

        <h2><? echo $language['PageTitleSignUp']; ?></h2>

        <form id="registrationForm" class="form" action="http://webmaster23.16mb.com/registration.php?check=1" method="post" enctype="multipart/form-data">

            <p class="name">
                <input maxlength="20" type="text" name="name" id="name" value="<? if($dataCheck) echo $userName; ?>" placeholder="<? echo $language["InputName"]; ?>" oninput="inputDataController.name(this)" onblur="inputDataController.name(this)" />
                <label id="nameLabel" style="color: red" for="name"></label>
            </p>

            <p class="surname">
                <input maxlength="20" type="text" name="surname" value="<? if($dataCheck) echo $userSurname; ?>" id="surname" placeholder="<? echo $language['InputSurname']; ?>" oninput="inputDataController.surname(this)" onblur="inputDataController.surname(this)" />
                <label id="surnameLabel" style="color: red" for="surname"></label>
            </p>

            <p class="email">
                <input maxlength="50" type="text" name="email" value="<? if($dataCheck) echo $userEmail; ?>" id="email" placeholder="<? echo $language['InputEmail']; ?>" oninput="inputDataController.email(this)" onblur="inputDataController.email(this)" />
                <label id="emailLabel" style="color: red"for="email"></label>
            </p>


            <p class="password">
                <input maxlength="100" type="password" name="password" value="<? if($dataCheck) echo $userPassword; ?>" id="password" placeholder="<? echo $language['InputPassword']; ?>" oninput="inputDataController.password(this)" onblur="inputDataController.password(this)" />
                <label for="password" style="color: red" id="passwordLabel"></label>
            </p>

            <p class="birthday" id="birthday" style="padding-top: 15px">
                <b style="position: absolute; left: 160px; top: 315px"> <? echo $language['BirthdayLabel']; ?>: </b>
                <input type="number" style="width: 50px" name="birthdayDay" id="birthdayDay" value="<? if($dataCheck) echo $userBirthdayDay; ?>" placeholder="<? echo $language['InputDay']; ?>" onblur="inputDataController.birthday.day(this)" oninput="inputDataController.birthday.day(this)" />
                <select name="birthdayMonth" id="birthdayMonth" style="width: 145px" onchange="inputDataController.birthday.month(this);" onblur="inputDataController.birthday.month(this);">
                    <option value="0" <? if($dataCheck || $errors["userBirthdayMonth"]["selected"] == 0) echo 'selected style="display: none"'; ?>><? echo $language['SelectMonth']; ?></option>
                    <option value="1" <? if($dataCheck && $errors["userBirthdayMonth"]["selected"] == 1) echo 'selected'; ?>><? echo $language['SelectMonth0']; ?></option>
                    <option value="2" <? if($dataCheck && $errors["userBirthdayMonth"]["selected"] == 2) echo 'selected'; ?>><? echo $language['SelectMonth1']; ?></option>
                    <option value="3" <? if($dataCheck && $errors["userBirthdayMonth"]["selected"] == 3) echo 'selected'; ?>><? echo $language['SelectMonth2']; ?></option>
                    <option value="4" <? if($dataCheck && $errors["userBirthdayMonth"]["selected"] == 4) echo 'selected'; ?>><? echo $language['SelectMonth3']; ?></option>
                    <option value="5" <? if($dataCheck && $errors["userBirthdayMonth"]["selected"] == 5) echo 'selected'; ?>><? echo $language['SelectMonth4']; ?></option>
                    <option value="6" <? if($dataCheck && $errors["userBirthdayMonth"]["selected"] == 6) echo 'selected'; ?>><? echo $language['SelectMonth5']; ?></option>
                    <option value="7" <? if($dataCheck && $errors["userBirthdayMonth"]["selected"] == 7) echo 'selected'; ?>><? echo $language['SelectMonth6']; ?></option>
                    <option value="8" <? if($dataCheck && $errors["userBirthdayMonth"]["selected"] == 8) echo 'selected'; ?>><? echo $language['SelectMonth7']; ?></option>
                    <option value="9" <? if($dataCheck && $errors["userBirthdayMonth"]["selected"] == 9) echo 'selected'; ?>><? echo $language['SelectMonth8']; ?></option>
                    <option value="10" <? if($dataCheck && $errors["userBirthdayMonth"]["selected"] == 10) echo 'selected'; ?>><? echo $language['SelectMonth9']; ?></option>
                    <option value="11" <? if($dataCheck && $errors["userBirthdayMonth"]["selected"] == 11) echo 'selected'; ?>><? echo $language['SelectMonth10']; ?></option>
                    <option value="12" <? if($dataCheck && $errors["userBirthdayMonth"]["selected"] == 12) echo 'selected'; ?>><? echo $language['SelectMonth11']; ?></option>
                </select>
                <input type="number" style="width: 50px" name="birthdayYear" value="<? if($dataCheck) echo $userBirthdayYear; ?>" id="birthdayYear" placeholder="<? echo $language['InputYear']; ?>" onblur="inputDataController.birthday.year(this)" oninput="inputDataController.birthday.year(this)" />
                <label id="birthdayLabel" style="color: red" for="birthday"></label>
            </p>

            <p class="gender" id="gender" title="Gender">
                <select name="gender" id="selectGender" style="width: 296px" onblur="inputDataController.gender(this)" onchange="inputDataController.gender(this)">
                    <option value="0" <? if($dataCheck || $errors["userGender"]["selected"] == 0) echo 'selected style="display: none"'; ?> ><? echo $language['SelectGender']; ?></option>
                    <option value="1"<? if($dataCheck && $errors["userGender"]["selected"] == 1) echo 'selected'; ?>><? echo $language['SelectGenderMale']; ?></option>
                    <option value="2"<? if($dataCheck && $errors["userGender"]["selected"] == 2) echo 'selected'; ?>><? echo $language['SelectGenderFemale']; ?></option>
                </select>
                <label id="selectGenderLabel" style="color: red" for="gender"></label>
            </p>

            <p class="image">
                <input id="selectImgBtn" style="width: 300px; background-color: #FFFFFF" type="button" value="<? echo $language['ChooseImage'] ?>" onclick="$('#files').click();">
                <input type="file" id="files" name="userImage" title="Select image" hidden />
                <label id="filesLabel" style="color: red"><? $language['ErrorImageFormat'] ?></label>
            </p>

            <output id="list"></output>

            <p class="captcha">
                <img id="captchaImage"  style="display:inline-block;vertical-align:middle;" src="images/preloader.gif" />
                <textarea id="captchaID" name="captchaID" hidden></textarea>
                <input id="captcha" name="captcha" maxlength="20" style="display:inline-block;vertical-align:middle;width:150px;" type="text" placeholder="<? echo $language['CaptchaInputText']; ?>" oninput="inputDataController.captcha(this);" />
                <img style="display:inline-block;vertical-align:middle;" src="images/update.png" onclick="captchaController.updateCaptcha();" />
                <lable id="captchaLabel" style="color: red"></lable>
            </p>

            <p class="submit">
                <input style="width: inherit" value="<? echo $language['SignUp']; ?>" id="submit" type="submit">
                &nbsp;&nbsp;<b><? echo $language['LoginOrSignIn']; ?></b>&nbsp;&nbsp;
                <a style="width inherit;" href="javascript:q=(document.location.href);void(open('http://webmaster23.16mb.com/login.php','_self','resizable,location,menubar,toolbar,scrollbars,status'));"><? echo $language['LogIn']; ?></a>
                
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


    <script src="scripts/registrationFormController.js"></script>
    <script>

        var checkData = <? if($dataCheck){ echo $dataCheck; } else { echo '0'; } ?>;

        var errorStrings = {
            empty : "<? echo $language['ErrorInputEmpty']; ?>",
            notALetter : "<? echo $language['ErrorInputNaL']; ?>",
            email : "<? echo $language['ErrorInputEmail']; ?>",
            passwordMinLength : "<? echo $language['ErrorInputPasswordMinLength']; ?>",
            passwordMaxLength : "<? echo $language['ErrorInputPasswordMaxLength']; ?>",
            notAnImage : "<? echo $language['ErrorInputImageNaI']; ?>",
            imageFormat : "<? echo $language['ErrorInputImageFormat']; ?>",
            birthdayDayNaN : "<? echo $language['ErrorInputBirthdayDayNaN']; ?>",
            birthdayDayRange : "<? echo $language['ErrorInputBirthdayDayNumRange']; ?>",
            birthdayYearNaN : "<? echo $language['ErrorInputBirthdayYearNaN']; ?>",
            birthdayYearRange : "<? echo $language['ErrorInputBirthdayYearNumRange']; ?>",
            birthdayYearRange : "<? echo $language['ErrorInputBirthdayYearNumRange']; ?>",
            captcha : "<? echo $language['ErrorInputCaptcha'] ?>",
            emailExist : "<? echo $language['emailExist']; ?>",
            imageSize : "<? echo $language["ErrorImageSize"]; ?>"
        }

        var errorInfo = {
            dataChecked : <? if($dataCheck){ echo '1'; } else { echo '0'; } ?>,
            errorType : {
                noErrors : 0,
                empty : 1,
                notALetter : 2,
                email : 3,
                passwordMinLength : 4,
                passwordMaxLength : 5,
                imageFormat : 6,
                birthdayDayNaN : 7,
                birthdayDayRange : 8,
                birthdayYearNaN : 9,
                birthdayYearRange : 10,
                notAnImage : 11,
                captcha : 12,
                emailExist : 13,
                imageSize : 14
            },
            nameError : {
                type : <? if($dataCheck){ if($errors["userName"]["correct"]) { echo 'undefined'; } else { echo $errors["userName"]["errorType"]; }} else { echo 'undefined'; } ?>,
                correct : <? if($dataCheck){ if($errors["userName"]["correct"]) { echo '1'; } else { echo '0'; }} else { echo 'undefined'; } ?>
            },
            surnameError : {
                type : <? if($dataCheck){ if($errors["userSurname"]["correct"]) { echo 'undefined'; } else { echo $errors["userSurname"]["errorType"]; }} else { echo 'undefined'; } ?>,
                correct : <? if($dataCheck){ if($errors["userSurname"]["correct"]) { echo '1'; } else { echo '0'; }} else { echo 'undefined'; } ?>
            },
            emailError : {
                type : <? if($dataCheck){ if($errors["userEmail"]["correct"]) { echo 'undefined'; } else { echo $errors["userEmail"]["errorType"]; }} else { echo 'undefined'; } ?>,
                correct : <? if($dataCheck){ if($errors["userEmail"]["correct"]) { echo '1'; } else { echo '0'; }} else { echo 'undefined'; } ?>
            },
            passwordError : {
                type : <? if($dataCheck){ if($errors["userPassword"]["correct"]) { echo 'undefined'; } else { echo $errors["userPassword"]["errorType"]; }} else { echo 'undefined'; } ?>,
                correct : <? if($dataCheck){ if($errors["userPassword"]["correct"]) { echo '1'; } else { echo '0'; }} else { echo 'undefined'; } ?>
            },
            birthdayError : {
                day : {
                    type : <? if($dataCheck){ if($errors["userBirthdayDay"]["correct"]) { echo 'undefined'; } else { echo $errors["userBirthdayDay"]["errorType"]; }} else { echo 'undefined'; } ?>,
                    correct : <? if($dataCheck){ if($errors["userBirthdayDay"]["correct"]) { echo '1'; } else { echo '0'; }} else { echo 'undefined'; } ?>
                },
                month : {
                    type : <? if($dataCheck){ if($errors["userBirthdayMonth"]["correct"]) { echo 'undefined'; } else { echo $errors["userBirthdayMonth"]["errorType"]; }} else { echo 'undefined'; } ?>,
                    correct : <? if($dataCheck){ if($errors["userBirthdayMonth"]["correct"]) { echo '1'; } else { echo '0'; }} else { echo 'undefined'; } ?>
                },
                year : {
                    type : <? if($dataCheck){ if($errors["userBirthdayYear"]["correct"]) { echo 'undefined'; } else { echo $errors["userBirthdayYear"]["errorType"]; }} else { echo 'undefined'; } ?>,
                    correct : <? if($dataCheck){ if($errors["userBirthdayYear"]["correct"]) { echo '1'; } else { echo '0'; }} else { echo 'undefined'; } ?>
                }
            },
            genderError : {
                type : <? if($dataCheck){ if($errors["userGender"]["correct"]) { echo 'undefined'; } else { echo $errors["userGender"]["errorType"]; }} else { echo 'undefined'; } ?>,
                correct : <? if($dataCheck){ if($errors["userGender"]["correct"]) { echo '1'; } else { echo '0'; }} else { echo 'undefined'; } ?>
            },
            imageError : {
                type : <? if($dataCheck){ if($errors["userImage"]["correct"]) { echo 'undefined'; } else { echo $errors["userImage"]["errorType"]; }} else { echo 'undefined'; } ?>,
                correct : <? if($dataCheck){ if($errors["userImage"]["correct"]) { echo '1'; } else { echo '0'; }} else { echo 'undefined'; } ?>
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

        showDataErrors();
    </script>

</html>
