<?php

/* Este archivo actualiza los datos de un usuario determinado cuyo id coincida con el id que le indicamos */
/* Las explicaciones son iguales que en el archivo updateEvent.php */

    include "conexion.php";
    $update = $conex->prepare("
        UPDATE usuario
        SET idUsuario = :id,
        nombreUsuario = :nombre,
        apellido = :apellido,
        email = :email,
        tlf = :tlf 
        WHERE idUsuario = :id
    ");       
    if($update->execute(Array(
        ":id" => $_POST["id"],
        ":nombre" => $_POST["nombre"],
        ":apellido" => $_POST["apellido"],
        ":email" => $_POST["email"],
        ":tlf" => $_POST["tlf"]
    ))){
        echo "Actualizado correctamente. Vuelva a iniciar sesión con sus nuevos datos si ha modificado el email!";
    }else{
        echo "Ha ocurrido un error!";
    }
?>
