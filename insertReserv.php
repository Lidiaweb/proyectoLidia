<?php

/* En este archivo se inserta en la base los eventos que reservan los usuarios que han iniciado sesión a traves de un formulario */


    session_start(); //habilita las variables de sesión
    include "conexion.php";
    /*estas variables locales de tipo string engloban a las variables superglobales $_POST que se refieren al valor del input del formulario. Sus nombres se deben a los datos a los que se refieren*/
    $fecha = $_POST["fecha"]; 
    $hora = $_POST["hora"];
    $tipo = $_POST["tipo"];
    $lugar = $_POST["lugar"];
    $usuario = $_SESSION["id"];
    /*sentencia sql que inserta los datos del evento y de manera predeterminada el estado será "pendiente" ya que es una reserva que hace el usuario*/
    $insertar = $conex->prepare("
        INSERT INTO evento 
        (fecha,hora,fk_tipo,fk_lugar,fk_usuario,estado) 
        VALUES 
        (:fecha,:hora,:tipo,:lugar,:usuario,'Pendiente')"); 
    if($insertar->execute(array( //aqui se ejecuta la consulta y se definen las variables
        ":fecha" => $fecha,
        ":hora" => $hora,
        ":tipo" => $tipo,
        ":lugar" => $lugar,
        ":usuario" => $usuario
    ))){
        echo "Su solicitud se ha realizado con éxito; en breve nos pondremos en contacto para confirmar el evento.";
    }else{
        echo "Error en la solicitud!";
    } //mensajes de éxito o error que devuelve
?>