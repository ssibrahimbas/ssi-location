<?php

use global\ResultHelper;
use global\RequestHelper;
use global\Database;
use global\Helper;

include $_SERVER['DOCUMENT_ROOT']."/helper/requestHelper.php";
include $_SERVER['DOCUMENT_ROOT']."/helper/resultHelper.php";
include $_SERVER['DOCUMENT_ROOT']."/validation/Validation.php";
include $_SERVER['DOCUMENT_ROOT']."/config/Database.php";
include $_SERVER["DOCUMENT_ROOT"]."/helper/baseHelper.php";

$db = (new Database());
$resultHelper = new ResultHelper();
$requestHelper = new RequestHelper($resultHelper);
$requestHelper->useJSON();
$requestHelper->usePowered();
$helper = new Helper();

if($_SERVER["REQUEST_URI"] == '/') {
    echo $requestHelper->notFoundRoute();
    return;
}
$path = $_SERVER['DOCUMENT_ROOT']."/endpoints".$_SERVER["REQUEST_URI"].".php";
if(file_exists($path)) {
    include $path;
}else {
    echo $requestHelper->notFoundRoute();
}