<?php

use global\Validation;
use global\ErrorResult;
use global\SuccessResult;

if(!$requestHelper->getJSONRaw(true)) return;

$validator = new Validation();
$validator
    ->in($_POST)
    ->name("id")
    ->required();
if (!$requestHelper->parseValidation($validator)) return;
if(!isset($_POST["name"]) && !isset($_POST["langCode"])) {
    echo $resultHelper->getResult(new ErrorResult("Change not detected."));
    return;
}

$result = $db->update("countries");
if(isset($_POST["langCode"])) {
    $validator
        ->in($_POST)
        ->name("langCode")
        ->maxlength(5)
        ->minlength(1);
    if (!$requestHelper->parseValidation($validator)) return;
    $result = $result->set("lang_code", $_POST["langCode"]);
}
if(isset($_POST["name"])) {
       $result = $result->set("name", $_POST["name"]);
}
$result = $result
    ->where("id = ".$_POST["id"])
    ->exec();

if ($result) {
    echo $resultHelper->getResult(new SuccessResult("Country successfully updated"));
} else {
    echo $resultHelper->getResult(new ErrorResult("An error occurred while updating the country."));
}