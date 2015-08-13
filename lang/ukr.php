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
$language['PageTitleSignUp'] = "Реєстрація";
$language['PageTitleLogIn'] = "Увійти";
$language['PageTitleProfile'] = "Профіль";

$language["SomethingWrong"] = "Щось пішло не так. Будь ласка, спробуйте ще раз";

$language['ImageTitle'] = "зображення";
$language['InputName'] = "Ім'я";
$language['InputSurname'] = "Прізвище";
$language['InputEmail'] = "Електронна пошта";
$language['InputPassword'] = "Пароль";
$language['BirthdayLabel'] = "Дата народження";
$language['InputDay'] = "День";
$language['SelectMonth'] = "Місяць";
$language['SelectMonth0'] = "Січень";
$language['SelectMonth1'] = "Лютий";
$language['SelectMonth2'] = "Березнь";
$language['SelectMonth3'] = "квітень";
$language['SelectMonth4'] = "Травень";
$language['SelectMonth5'] = "Червень";
$language['SelectMonth6'] = "Липень";
$language['SelectMonth7'] = "Серпень";
$language['SelectMonth8'] = "Вересень";
$language['SelectMonth9'] = "Жовтень";
$language['SelectMonth10'] = "Листопад";
$language['SelectMonth11'] = "Грудень";

$language['InputYear'] = "Рік";
$language['SelectGender'] = "Стать";
$language['SelectGenderMale'] = "Чоловіча";
$language['SelectGenderFemale'] = "Жіноча";
$language['ChooseImage'] = "Виберіть зображення для профілю";
$language['SignUp'] = 'Зареєструватися';
$language['LogIn'] = 'Ввійти';
$language['LoginOrSignIn'] = 'або';
$language['Languages'] = "Мови";
$language['logout'] = "Вийти";

$language['emailExist'] = "Ця електронна пошта вже зареєстрована.";
$language['wrongEmailOrPassword'] = "Невірна адреса електронної пошти або пароль.";
$language['CaptchaInputText'] = "Введіть текст з картинки";

$language['ErrorInputNaL'] = "Це поле повинно містити тільки букви.";
$language['ErrorInputEmpty'] = "Це поле має бути заповнено.";
$language['ErrorInputEmail'] = "Введіть адресу електронної пошти.";
$language['ErrorInputPasswordMaxLength'] = "Пароль повинен містити не більше 100 символів.";
$language['ErrorInputPasswordMinLength'] = "Пароль повинен бути не менше 8 символів.";
$language['ErrorInputBirthdayDayNaN'] = "Це поле повинно містити лише цифри в діапазоні між 1 і 31.";
$language['ErrorInputBirthdayDayNumRange'] = "Числа повинні бути в діапазоні від 1 до 31.";
$language['ErrorInputBirthdayYearNaN'] = "Це поле повинно містити лише цифри в діапазоні від " . (strftime("%Y") - 150) . " до " . strftime("%Y") . ".";
$language['ErrorInputBirthdayYearNumRange'] = "Числа повинні бути в діапазоні від" . (date("Y") - 150) . " до " . date("Y") . ".";
$language['ErrorInputImageNaI'] = "Будь ласка, виберіть зображення.";
$language['ErrorInputImageFormat'] = "Формат зображення повинен бути PNG, JPG або GIF.";
$language['ErrorInputCaptcha'] = "Введені символи не відповідають перевірочне слову.";
$language['ErrorImageSize'] = "Розмір зображення не повинен перевищувати 64Кб.";
?>