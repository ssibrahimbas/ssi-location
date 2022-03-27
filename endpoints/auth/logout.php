<?php

use global\SuccessResult;

session_start();
if(!$sessionService->checkAuthorization()) return;
$_SESSION['loggedIn'] = false;
echo $resultHelper->getResult(new SuccessResult("Successfully Signed out"));