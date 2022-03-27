<?php

use global\Validation;
use global\ErrorResult;
use global\SuccessResult;

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
    ->select("users", "email")
    ->where("email = '".$_POST['email']."'")
    ->fetch();

if($user) {
    echo $resultHelper->getResult(new ErrorResult("User already exists."));
    return;
}

$hashPassword = password_hash($_POST["password"], null);
$result = $db
    ->insert("users")
    ->columns("email, password")
    ->values("'".$_POST['email']."', '".$hashPassword."'")
    ->exec();


if($result) {
    echo $resultHelper->getResult(new SuccessResult(("User successfully registered")));
}else {
    echo $resultHelper->getResult(new ErrorResult("An error occurred while registering the user"));
}