<?php

/* Este archivo elimina un evento determinado cuyo id coincida con el id que le indicamos */

    include "conexion.php"; //incluimos el archivo de conexión con la base de datos
    /*Las variables locales $delete y $conex son de tipo object y se refieren a la consulta que hacemos a la base de datos*/
    $delete = $conex->prepare("
        DELETE FROM evento 
        WHERE idEvento = :id"
    ); //sentencia sql que elimina un evento que coincida con el id que le indicamos.
    if($delete->execute(array(":id"=>$_POST["id"]))){// $_POST["id"] es una variable superglobal que nos indica el valor del input del formulario con ese nombre
        echo "Eliminado con éxito ";
        } else {
        echo "Hubo un error!";
        } //si se ejecuta manda un mensaje de éxito y sino de error.
?>