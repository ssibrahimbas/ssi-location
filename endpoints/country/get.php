<?php

use global\Validation;
use global\SuccessDataResult;
use global\ErrorResult;

if(!$requestHelper->getJSONRaw(true)) return;

$validator = new Validation();
$validator->in($_POST)->name("id")->required();
if(!$requestHelper->parseValidation($validator)) return;

$country = $db
    ->select("countries", "id, name, lang_code as langCode")
    ->where("id = ".$_POST["id"])
    ->fetch();

if($country) {
    echo $resultHelper->getResult(new SuccessDataResult("Country successfully fetched.", $country));
}else {
    echo $resultHelper->getResult(new ErrorResult("Country was not found"));
}