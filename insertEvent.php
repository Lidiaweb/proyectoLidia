<?php

/* En este archivo se inserta en la base de datos los datos de los eventos que llegan a traves del formulario */

    include "conexion.php"; //incluye archivo de conexión con la bade de datos.
    /*estas variables locales de tipo string engloban a las variables superglobales $_POST que se refieren al valor del input del formulario. Sus nombres se deben a los datos a los que se refieren*/
    $fecha = $_POST["fecha"]; 
    $hora = $_POST["hora"];
    $tipo = $_POST["tipo"];
    $lugar = $_POST["lugar"];
    $usuario = $_POST["usuario"];
    $estado = $_POST["estado"];
    /*$insertar y $conex son variables locales de tipo object que se refieren a la sentencia sql*/
    $insertar = $conex->prepare("
        INSERT INTO evento 
        (fecha,hora,fk_tipo,fk_lugar,fk_usuario,estado) 
        VALUES 
        (:fecha,:hora,:tipo,:lugar,:usuario,:estado)"); 
    if($insertar->execute(array( //aqui se ejecuta la sentencia sql y se definen las variables
        ":fecha" => $fecha,
        ":hora" => $hora,
        ":tipo" => $tipo,
        ":lugar" => $lugar,
        ":usuario" => $usuario,
        ":estado" => $estado
    ))){
        echo "Insertado correctamente!";
    }else{
        echo "Error!";
    } //mensajes de éxito o error que devuelve
?>