<?php

/* Este archivo permite la conexión con la base de datos */

define("db", "jazzandfeel");
define("user", "root");
define("pass","");
define("host","localhost");

try{
    $conex = new PDO("mysql:host=".host."; dbname=".db, user, pass); //variable de tipo object
    $conex->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo $e->getMessage();//$e es una variable de tipo object que se refiere al mensaje que devolverá si no hay error en la conexión.
}
?>