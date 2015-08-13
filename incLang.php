<?php
/**
 * Created by PhpStorm.
 * User: Sohan
 * Date: 10.08.2015
 * Time: 17:23
 */

header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('UTC');

$dataCheck = $_GET['check'];
$siteLanguage = $_GET['lang'];

if($siteLanguage != null){
    setcookie ("language", $siteLanguage, time() + (86400 * 180));
} else {
    if(isset($_COOKIE["language"])) {
        $siteLanguage = $_COOKIE["language"];
    } else {
        $siteLanguage = "eng";
        setcookie ("language", $siteLanguage, time() + (86400 * 180));
    }
}

switch ($siteLanguage){
    case "eng" : include_once 'lang/eng.php';
        break;
    case "rus" : include_once 'lang/rus.php';
        break;
    case "ukr" : include_once 'lang/ukr.php';
        break;
    default : setSiteLanguage("eng");
}