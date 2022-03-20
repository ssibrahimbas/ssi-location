<?php

namespace global;

class RequestHelper
{
    private ResultHelper $resultHelper;

    public function __construct(ResultHelper $helper) {
        $this->resultHelper = $helper;
    }

    public function useJSON()
    {
        header("Content-Type: application/json");
    }

    public function usePowered()
    {
        header("X-Powered-By: ssibrahimbas");
    }

    public static function getJSONRaw(bool $isRequired = false) : bool
    {
        $req = file_get_contents('php://input');
        if ($isRequired && strlen($req) == 0) {
            echo ResultHelper::getResult(new ErrorResult("Failed to Retrieve Parameter"));
            return false;
        }
        $decoding = json_decode($req, true);
        if (strlen($req) > 0) {
            foreach ($decoding as $key => $value) {
                $_POST[$key] = $value;
            }
        }
        return true;
    }

    public function parseValidation(Validation $validation) : bool
    {
        if($validation->isSuccess()) return true;
        echo $this->resultHelper->getResult(new ErrorDataResult("Validation Error", $validation->getErrors()));
        return false;
    }

    public function notFoundRoute(): bool|string
    {
        return $this->resultHelper::getResult(new ErrorResult("API Not Found."));
    }
}