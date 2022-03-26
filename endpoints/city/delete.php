<?php

use global\Validation;
use global\SuccessResult;
use global\ErrorResult;

if(!$requestHelper->getJSONRaw(true)) return;

$validator = new Validation();
$validator
    ->in($_POST)
    ->name("id")
    ->required();
if(!$requestHelper->parseValidation($validator)) return;

$result = $db
    ->delete("cities")
    ->where("id = ".$_POST['id'])
    ->exec();

if($result) {
    echo $resultHelper->getResult(new SuccessResult("City successfully deleted"));
}else {
    echo $resultHelper->getResult(new ErrorResult("An error occurred while deleting the city."));
}