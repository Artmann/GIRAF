<?php

class ErrorController extends Controller
{
    public function Handle($errormsg)
    {
        return $this->createResponse(array("Error" => $errormsg));
    }
}