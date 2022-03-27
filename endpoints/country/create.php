<?php

use global\Validation;
use global\ErrorResult;
use global\SuccessResult;

session_start();
if(!$sessionService->checkAuthorization()) return;
if (!$requestHelper->getJSONRaw(true)) return;

$validator = new Validation();
$validator
    ->in($_POST)
    ->name("name")
    ->required();
$validator
    ->in($_POST)
    ->name("langCode")
    ->required();
if (!$requestHelper->parseValidation($validator)) return;
$validator
    ->in($_POST)
    ->name("langCode")
    ->maxlength(5)
    ->minlength(1);
if (!$requestHelper->parseValidation($validator)) return;

$result = $db
    ->insert("countries")
    ->columns("name, lang_code")
    ->values("'".$_POST["name"]."', '".$_POST["langCode"]."'")
    ->exec();

if ($result) {
    echo $resultHelper->getResult(new SuccessResult("Country successfully created"));
} else {
    echo $resultHelper->getResult(new ErrorResult("An error occurred while creating the country"));
}