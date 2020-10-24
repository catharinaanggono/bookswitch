<?php   

    ### Each time when an object is created, it direct to the file with the codes. 
    spl_autoload_register (
        function ($class) {
            require_once "../model/$class.php";
        }
    );

    ### Connect to the database 
    require_once "../database/ConnectionManager.php"; 

    ### Starting/commencing the session 
    session_start();

?> 
