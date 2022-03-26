<?php

use global\SuccessDataResult;
use global\Validation;

if(!$requestHelper->getJSONRaw(true)) return;

$query = [
    "page" => $helper->getValueInBaseOrDefault($_POST, "page", 1),
    "limit" => $helper->getValueInBaseOrDefault($_POST, "limit", 20),
    "order" => "name",
    "sort" => "DESC",
    "filter" => $helper->getValueInBaseOrDefault($_POST, "query", null),
    "countryId" => $helper->getValueInBaseOrDefault($_POST, "countryId", null)
];

$validation = new Validation();
if(isset($_POST["order"])) {
    $validation
        ->in($_POST)
        ->name("order")
        ->contains(["name", "plate_code"]);
    if(!$requestHelper->parseValidation($validation)) return;
    $query["order"] = $_POST["order"];
}
if(isset($_POST["sort"])) {
    $validation
        ->in($_POST)
        ->name("sort")
        ->contains(["asc", "desc"]);
    if (!$requestHelper->parseValidation($validation)) return;
    $query["sort"] = strtoupper($_POST["sort"]);
}

$dbQuery = $db
    ->select("cities", "cities.id as cityId, cities.name as cityName, cities.plate_code as plateCode, countries.id as countryId, countries.name as countryName, countries.lang_code as langCode")
    ->innerJoin("countries")
    ->on("countries.id = cities.country_id");

if($query["filter"] != null) {
    $dbQuery = $dbQuery->where("cities.name")->contains($query["filter"]);
}
if($query["countryId"] != null) {
    $dbQuery = $dbQuery->where("cities.country_id = ".$query["countryId"]);
}

$cities = $dbQuery
    ->orderBy("cities.".$query["order"])
    ->sort($query["sort"])
    ->limit(intval($query["limit"]))
    ->offset((intval($query["page"]) - 1) * intval($query["limit"]))
    ->fetchAll();

$res = [
    "page" => $query["page"],
    "limit" => $query["limit"],
    "cities" => $cities
];

echo $resultHelper->getResult(new SuccessDataResult("Cities successfully listed.", $res));