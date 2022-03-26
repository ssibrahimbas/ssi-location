<?php

use global\Validation;
use global\ErrorResult;
use global\SuccessResult;

if(!$requestHelper->getJSONRaw(true)) return;

$validator = new Validation();
$validator
    ->in($_POST)
    ->name("name")
    ->required();
$validator
    ->in($_POST)
    ->name("countryId")
    ->required();
$validator
    ->in($_POST)
    ->name("plateCode")
    ->maxlength(5);
if(!$requestHelper->parseValidation($validator)) return;

$country = $db
    ->select("countries", "id")
    ->where("id = ".$_POST["countryId"])
    ->fetch();

if(!$country) {
    echo $resultHelper->getResult(new ErrorResult("Country was not found"));
    return;
}

$result = $db
    ->insert("cities")
    ->columns("name, country_id, plate_code")
    ->values("'".$_POST['name']."', '".$_POST['countryId']."', '".$_POST['plateCode']."'")
    ->exec();

if($result) {
    echo $resultHelper->getResult(new SuccessResult(("City successfully craeted")));
}else {
    echo $resultHelper->getResult(new ErrorResult("An error occurred while creating the country"));
}