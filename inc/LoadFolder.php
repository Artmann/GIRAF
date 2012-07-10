<?php

function LoadFolder($folder, $sufix)
{
    $files = array();
    
    if($handle = opendir($folder))
    {
        while(($entry = readdir($handle)) !== false)
        {   
            if(strpos($entry, ".php") != false)
            {
                $class = str_replace(".php", "", $entry);
                $name = strtolower(str_replace($sufix, "", $class));
                $file = "$folder/$entry"; 
                
               
                $files[] = array("name" => $name,"class" => $class, "file" => $file);
            }
        }
    }

    
    return $files;
    
}