<?php
    
    require_once 'library/model.php';
    require_once 'library/controller.php';
    require_once 'db/db.config.php';
    require_once 'db/db.php';
    require_once 'lib/controller.php';
    require_once 'lib/model.php';
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
    
    $data = $_GET;
    if(isset($_POST))
        $data = $_POST;
    
    $controller = "index";
    $action = "index";
    
    if(isset($_GET["controller"]))
        $controller = strtolower($_GET["controller"]);
    if(isset($_GET["action"]))
        $action = strtolower($_GET["action"]);
    
    //print_r($controllers);
    
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
            echo $myController->$action($data);
        }
        else
        {
            throw new Exception("Could not find controller $controller");
        }
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }

    
?>