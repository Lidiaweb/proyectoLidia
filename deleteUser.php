<?php

/* Este archivo elimina un usuario determinado cuyo id coincida con el id que le indicamos */
/* Las explicaciones son iguales que en el archivo deleteEvent.php */

    include "conexion.php";
    $delete = $conex->prepare("
        DELETE FROM usuario 
        WHERE idUsuario = :id
    ");
    if($delete->execute(array(":id"=>$_POST["id"]))){
        echo "Eliminado con éxito ";
    } else {
        echo "Hubo un error! Este usuario está asociado a un evento";
    }
?>