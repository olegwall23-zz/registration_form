<?php
/**
 * Created by PhpStorm.
 * User: Sohan
 * Date: 31.07.2015
 * Time: 14:27
 */
date_default_timezone_set('UTC');
$language = Array();
// RegistrationForm
$language['PageTitleSignUp'] = "Sign up";
$language['PageTitleLogIn'] = "Log in";
$language['PageTitleProfile'] = "Profile";

$language['SomethingWrong'] = "Something went wrong, please try again.";

$language['ImageTitle'] = "Image";
$language['InputName'] = "Name";
$language['InputSurname'] = "Surname";
$language['InputEmail'] = "Email";
$language['InputPassword'] = "Password";
$language['BirthdayLabel'] = "Birthday";
$language['InputDay'] = "Day";
$language['SelectMonth'] = "Month";
$language['SelectMonth0'] = "January";
$language['SelectMonth1'] = "February";
$language['SelectMonth2'] = "March";
$language['SelectMonth3'] = "April";
$language['SelectMonth4'] = "May";
$language['SelectMonth5'] = "June";
$language['SelectMonth6'] = "July";
$language['SelectMonth7'] = "August";
$language['SelectMonth8'] = "September";
$language['SelectMonth9'] = "October";
$language['SelectMonth10'] = "November";
$language['SelectMonth11'] = "December";

$language['InputYear'] = "Year";
$language['SelectGender'] = "Gender";
$language['SelectGenderMale'] = "Male";
$language['SelectGenderFemale'] = "Female";
$language['ChooseImage'] = "Select image for profile";
$language['SignUp'] = 'Sign up';
$language['LogIn'] = 'Log in';
$language['LoginOrSignIn'] = 'or';
$language['Languages'] = "Languages";

$language['logout'] = "Log out";
$language['CaptchaInputText'] = "Input text from image";
$language['emailExist'] = "This email is already registered.";
$language['wrongEmailOrPassword'] = "Wrong email or password.";

$language['ErrorInputNaL'] = "This field should contain only letters.";
$language['ErrorInputEmpty'] = "This field must be filled.";
$language['ErrorInputEmail'] = "Doesn't look like a valid email.";
$language['ErrorInputPasswordMaxLength'] = "Password should contain no more than 100 characters.";
$language['ErrorInputPasswordMinLength'] = "Password must be at least 8 characters.";
$language['ErrorInputBirthdayDayNaN'] = "This field should contain only numbers in range between 1 and 31.";
$language['ErrorInputBirthdayDayNumRange'] = "Numbers should be in range between 1 and 31.";
$language['ErrorInputBirthdayYearNaN'] = "This field should contain only numbers in range between" . (strftime("%Y") - 150) . " and " . strftime("%Y") . ".";
$language['ErrorInputBirthdayYearNumRange'] = "Numbers should be in range between" . (date("Y") - 150) . " and " . date("Y") . ".";
$language['ErrorInputImageNaI'] = "Please choose an image.";
$language['ErrorInputImageFormat'] = "Image format should be png, jpg or gif.";
$language['ErrorInputCaptcha'] = "The characters you entered didn't match the word verification.";
$language['ErrorImageSize'] = "The image size must not exceed 64KB.";
?>