<?php

class Config
{
    private static $settings = array(
        "useAPIKeys" => false,
        "responseType" => "json"
    );
    
    public static function get($key)
    {
        return Config::$settings[$key];
    }
    
}