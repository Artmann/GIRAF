<?php
    
    require_once 'library/model.php';
    require_once 'library/controller.php';
    require_once 'db/db.config.php';
    require_once 'db/db.php';
    
    /**
     * Load userdefined controllers and models 
     */
    
    if($handle = opendir("models"))
    {
        while(($entry = readdir($handle)) == false)
        {
            if(strpos($entry, ".php") != false)
            {
                
            }
        }
    }
    
    $data = $_GET;
    if(isset($_POST))
        $data = $_POST;
    
    $controller = "index";
    $action = "index";
    
    if(isset($_GET["controller"]))
        $controller = $_GET["controller"];
    if(isset($_GET["action"]))
        $action = $_GET["action"];
    
   
    
?>