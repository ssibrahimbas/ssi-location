<?php

use global\Validation;
use global\ErrorResult;
use global\SuccessDataResult;

if(!$requestHelper->getJSONRaw(true)) return;

$validator = new Validation();
$validator
    ->in($_POST)
    ->name("password")
    ->required();
$validator
    ->in($_POST)
    ->name("email")
    ->required();
if(!$requestHelper->parseValidation($validator)) return;

$user = $db
    ->select("users", "email, password, created_at as createdAt")
    ->where("email = '".$_POST['email']."'")
    ->fetch();

if(!$user) {
    echo $resultHelper->getResult(new ErrorResult("User not found."));
    return;
}
session_start();

if(isset($_SESSION['totalTry']) && $_SESSION['totalTry'] > 10) {
    if(isset($_SESSION['bannedTime']) && $_SESSION['bannedTime'] != null) {
        $bannedTime = $_SESSION['bannedTime'] - time();
        if($bannedTime > 0) {
            echo $resultHelper->getResult(new ErrorResult("You have been temporarily banned. Please try again later."));
            return;
        }else {
            $_SESSION['totalTry'] = null;
            $_SESSION['bannedTime'] = null;
        }
    }else {
        $_SESSION['bannedTime'] = time() + (7 * 24 * 60 * 60);
    }
}
if(!password_verify($_POST['password'], $user['password'])) {
    echo $resultHelper->getResult(new ErrorResult("The password is incorrect, please try again."));
    if(isset($_SESSION['totalTry'])) {
        $_SESSION['totalTry'] = $_SESSION['totalTry'] + 1;
    }else {
        $_SESSION['totalTry'] = 1;
    }
    return;
}

$_SESSION['loggedIn'] = true;
$res = [
    "email" => $user["email"],
    "createdAt" => $user["createdAt"]
];
echo $resultHelper->getResult(new SuccessDataResult("Successfully logged in", $res));