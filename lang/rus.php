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
$language['PageTitleSignUp'] = "Регистрация";
$language['PageTitleLogIn'] = "Войти";
$language['PageTitleProfile'] = "Профиль";

$language["SomethingWrong"] = "Что-то пошло не так. Пожалуйста, попробуйте еще раз";

$language['ImageTitle'] = "Изображение";
$language['InputName'] = "Имя";
$language['InputSurname'] = "Фамилия";
$language['InputEmail'] = "Электронная почта";
$language['InputPassword'] = "Пароль";
$language['BirthdayLabel'] = "Дата рождения";
$language['InputDay'] = "День";
$language['SelectMonth'] = "Месяц";
$language['SelectMonth0'] = "Январь";
$language['SelectMonth1'] = "Февраль";
$language['SelectMonth2'] = "Март";
$language['SelectMonth3'] = "Апрель";
$language['SelectMonth4'] = "Май";
$language['SelectMonth5'] = "Июнь";
$language['SelectMonth6'] = "Июль";
$language['SelectMonth7'] = "Август";
$language['SelectMonth8'] = "Сентябрь";
$language['SelectMonth9'] = "Октябрь";
$language['SelectMonth10'] = "Ноябрь";
$language['SelectMonth11'] = "Декабрь";

$language['InputYear'] = "Год";
$language['SelectGender'] = "Пол";
$language['SelectGenderMale'] = "Мужской";
$language['SelectGenderFemale'] = "Женский";
$language['ChooseImage'] = "Выберите изображение для профиля";
$language['SignUp'] = 'Зарегистрироваться';
$language['LogIn'] = 'Авторизоваться';
$language['LoginOrSignIn'] = 'или';
$language['Languages'] = "Языки";

$language['logout'] = "Выйти";

$language['emailExist'] = "Эта электронная почта уже зарегистрирована.";
$language['wrongEmailOrPassword'] = "Неправильный адрес электронной почты или пароль.";
$language['CaptchaInputText'] = "Введите текст с картинки";

$language['ErrorInputNaL'] = "Это поле должно содержать только буквы.";
$language['ErrorInputEmpty'] = "Это поле должно быть заполнено.";
$language['ErrorInputEmail'] = "Введите адрес электронной почты.";
$language['ErrorInputPasswordMaxLength'] = "Пароль должен содержать не более 100 символов.";
$language['ErrorInputPasswordMinLength'] = "Пароль должен быть не менее 8 символов.";
$language['ErrorInputBirthdayDayNaN'] = "Это поле должно содержать только цифры в диапазоне между 1 и 31.";
$language['ErrorInputBirthdayDayNumRange'] = "Числа должны быть в диапазоне от 1 до 31.";
$language['ErrorInputBirthdayYearNaN'] = "Это поле должно содержать только цифры в диапазоне от" . (strftime("%Y") - 150) . " до " . strftime("%Y") . ".";
$language['ErrorInputBirthdayYearNumRange'] = "Числа должны быть в диапазоне от " . (date("Y") - 150) . " и " . date("Y") . ".";
$language['ErrorInputImageNaI'] = "Пожалуйста, выберите изображение.";
$language['ErrorInputImageFormat'] = "Формат изображения должен быть PNG, JPG или GIF.";
$language['ErrorInputCaptcha'] = "Введенные символы не соответствуют проверочное слову.";
$language['ErrorImageSize'] = "Размер изображения не должен превышать 64Кб.";
?>