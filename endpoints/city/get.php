<?php

use global\Validation;
use global\SuccessDataResult;
use global\ErrorResult;

if(!$requestHelper->getJSONRaw(true)) return;

$validator = new Validation();
$validator->in($_POST)->name("id")->required();
if(!$requestHelper->parseValidation($validator)) return;

$city = $db
    ->select("cities", "cities.id as cityId, cities.name as cityName, cities.country_id as countryId, cities.plate_code as plateCode, countries.name as countryName, countries.lang_code as langCode")
    ->innerJoin("countries")
    ->on("countries.id = cities.country_id")
    ->where("cities.id = ".$_POST["id"])
    ->fetch();

if($city) {
    echo $resultHelper->getResult(new SuccessDataResult("City successfully fetched.", $city));
}else {
    echo $resultHelper->getResult(new ErrorResult("City was not found"));
}