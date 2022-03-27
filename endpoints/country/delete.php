<?php

use global\Validation;
use global\SuccessResult;
use global\ErrorResult;

session_start();
if(!$sessionService->checkAuthorization()) return;
if(!$requestHelper->getJSONRaw(true)) return;

$validator = new Validation();
$validator
    ->in($_POST)
    ->name("id")
    ->required();
if(!$requestHelper->parseValidation($validator)) return;

$result = $db
    ->delete("countries")
    ->where("id = ".$_POST["id"])
    ->exec();

if($result) {
    echo $resultHelper->getResult(new SuccessResult("Country successfully deleted"));
}else {
    echo $resultHelper->getResult(new ErrorResult("An error occurred while deleting the country."));
}