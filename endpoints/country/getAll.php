<?php

use global\SuccessDataResult;
use global\Validation;

if(!$requestHelper->getJSONRaw(true)) return;

$query = [
    "page" => $helper->getValueInBaseOrDefault($_POST, "page", 1),
    "limit" => $helper->getValueInBaseOrDefault($_POST, "limit", 20),
    "order" => "name",
    "sort" => "DESC",
    "filter" => $helper->getValueInBaseOrDefault($_POST, "query", null)
];
$validation = new Validation();
if (isset($_POST["order"])) {
    $validation->in($_POST)->name("order")->contains(["name", "lang_code"]);
    if (!$requestHelper->parseValidation($validation)) return;
    $query["order"] = $_POST["order"];
}
if (isset($_POST["sort"])) {
    $validation->in($_POST)->name("sort")->contains(["asc", "desc"]);
    if (!$requestHelper->parseValidation($validation)) return;
    $query["sort"] = strtoupper($_POST["sort"]);
}

$dbQuery = $db->select("countries", "id, name, lang_code as langCode");
if($query["filter"] != null) {
    $dbQuery = $dbQuery->where("name")->contains($query["filter"]);
}
$countries = $dbQuery
    ->orderBy($query["order"])
    ->sort($query["sort"])
    ->limit(intval($query["limit"]))
    ->offset((intval($query["page"]) - 1) * intval($query["limit"]))
    ->fetchAll();

$res = [
    "page" => $query["page"],
    "limit" => $query["limit"],
    "countries" => $countries
];

echo $resultHelper->getResult(new SuccessDataResult("Countries successfully listed.", $res));