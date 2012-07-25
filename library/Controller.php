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
    
    public function requiredArguments($data, $arguments)
    {
        $errors = array();
        
        foreach($arguments as $arg)
        {
            if(!isset($data[$arg]))
                $errors[] = $arg;
        }
        
        if(sizeof($errors) > 0)
            throw new Exception(implode(", ", $errors) + " is a required field.");
        
    }


    public function jsonResponse($data)
    {
        return json_encode($data);
    }
    
}
