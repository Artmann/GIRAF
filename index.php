<?php
    require_once 'config.php';
    require_once 'db/db.php';
    require_once 'library/Model.php';
    require_once 'library/Controller.php';
    require_once 'APIAccess/APIAccount.php';
    require_once 'APIAccess/APIKey.php';
    require_once 'APIAccess/APIAccess.php';
    require_once 'inc/LoadFolder.php';
    
    /**
     * Load userdefined controllers and models 
     */
    
    $models = LoadFolder("./models", "Model");
    $controllers = LoadFolder("./controllers", "Controller");

    if(sizeof($models) > 0)
        foreach ($models as $m)
            require_once $m["file"];
    if(sizeof($controllers) > 0)
        foreach ($controllers as $c)
            require_once $c["file"];
    
   
    $controller = "index";
    $action = "index";
    $apikey = "";
    
    if(isset($_GET["controller"]))
        $controller = strtolower($_GET["controller"]);
    if(isset($_GET["action"]))
        $action = strtolower($_GET["action"]);
    if(isset($_GET["apikey"]))
        $apikey = $apikey; 
        
    if($action == "createresponse")
	$action = "index";

    $APIAccess = APIAccess::GetAPIAccess($controller, $action);
    
    if(sizeof($APIAccess) > 0)
    {
        if(!in_array(APIKey::GetGroup($apikey), $APIAccess))
               die("Invalid API-Key");
    } 
    
    try
    {
        $cont = "";
        foreach($controllers as $c)
        {
            if($c["name"] == $controller)
            {
                $cont = $c["class"];
            }
        }
        
        if($cont != "")
        {
            
            $myController = new $cont();
           
            echo $myController->$action($_GET);
        }
        else
        {
            throw new Exception("Could not find controller $controller");
        }
    }
    catch(Exception $e)
    {
        $Error = new ErrorController();
        echo $Error->Handle($e->getMessage());
    }

    
?>
