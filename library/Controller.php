<?php

class Controller
{
    public function index($data)
    {
    	createResponse($data);
    }

    public function createResponse($data)
    {
        switch(Config::get("responseType"))
        {
            case "json":
                return $this->jsonResponse($data);
                break;
        }
        
        return jsponResponse($data);
    }
    
    public function jsonResponse($data)
    {
        return json_encode($data);
    }
    
}
