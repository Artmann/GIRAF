<?php

class ErrorController extends Controller
{
    public static function Handle($errormsg)
    {
        return $this->createResponse(array("Error" => $errormsg));
    }
}