<?php

use global\Validation;
use global\ErrorResult;
use global\SuccessResult;

session_start();
if(!$sessionService->checkAuthorization()) return;
if(!$requestHelper->getJSONRaw(true)) return;

$validator = new Validation();
$validator
    ->in($_POST)
    ->name("id")
    ->required();
if (!$requestHelper->parseValidation($validator)) return;

if(!isset($_POST["name"]) && !isset($_POST["plateCode"])) {
    echo $resultHelper->getResult(new ErrorResult("Change not detected."));
    return;
}

$result = $db->update("cities");
if(isset($_POST["plateCode"])) {
    $validator
        ->in($_POST)
        ->name("plateCode")
        ->maxlength(5)
        ->minlength(1);
    if (!$requestHelper->parseValidation($validator)) return;
    $result = $result->set("plate_code", $_POST["plateCode"]);
}
if(isset($_POST["name"])) {
    $result = $result->set("name", $_POST["name"]);
}
$result = $result
    ->where("id = ".$_POST["id"])
    ->exec();

if ($result) {
    echo $resultHelper->getResult(new SuccessResult("City successfully updated"));
} else {
    echo $resultHelper->getResult(new ErrorResult("An error occurred while updating the city."));
}