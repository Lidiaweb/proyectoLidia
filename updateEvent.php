<?php

/* Este archivo actualiza un evento determinado cuyo id coincida con el id que le indicamos */

    include "conexion.php"; ///incluimos el archivo de conexión con la base de datos
    /*Las variables locales $update y $conex son de tipo object y se refieren a la consulta que hacemos a la base de datos*/
    /*sentencia sql que actualiza un evento con los datos que recibe del formulario que coincida con el id que le indicamos.*/ 
    $update = $conex->prepare("
        UPDATE evento
        SET fk_tipo = :tipo,
        fk_lugar = :lugar,
        fecha = :fecha,
        hora = :hora,
        idEvento = :id,
        fk_usuario = :usuario,
        estado = :estado
        WHERE idEvento = :id
    "); 
    if($update->execute(Array(
        /*variables superglobales que se refieren a los datos del formulario que se envian por método post*/
        ":tipo" => $_POST["tipo"], 
        ":lugar" => $_POST["lugar"],
        ":fecha" => $_POST["fecha"],
        ":hora" => $_POST["hora"],
        ":usuario" => $_POST["usuario"],
        ":estado" => $_POST["estado"],
        ":id" => $_POST["id"]
    ))){
        echo "Actualizado correctamente!";
    }else{
        echo "Ha ocurrido un error!";
    } //si se ejecuta manda un mensaje de éxito y sino de error.
?>
