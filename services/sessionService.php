<?php

namespace global;

class SessionService {
    private ResultHelper $resultHelper;

    public function __construct(ResultHelper $helper) {
        $this->resultHelper = $helper;
    }

    public function checkAuthorization() : bool {
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
            return true;
        }else {
            echo $this->resultHelper->getResult(new ErrorResult("You must be logged in to access this page"));
            return false;
        }
    }
}