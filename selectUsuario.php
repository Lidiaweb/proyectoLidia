<?php

/* Este archivo selecciona los datos de los usuarios que sean de tipo "u", es decir, usuarios y no administrador */
/* Las explicaciones son las mismas que en el archivo selectEventContacto.php*/

    include "conexion.php";
    $select = $conex->prepare("
        SELECT idUsuario, nombreUsuario, apellido, email, tlf 
        FROM usuario
        WHERE tipo = 'u'
    ");
    $select->execute();
    $arrayUsuario= [];
    while($fila = $select->fetch(PDO::FETCH_ASSOC)){
        $arrayUsuario[] = array(
            "id" => $fila["idUsuario"],
            "nombre" => $fila["nombreUsuario"],
            "apellido" => $fila["apellido"],
            "email" => $fila["email"],
            "tlf" => $fila["tlf"]
        );
    }
    $arrayToString = json_encode($arrayUsuario);
    echo $arrayToString;
?>


