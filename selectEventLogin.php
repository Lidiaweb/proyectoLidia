<?php

/* Este archivo selecciona los datos de los eventos que coincidan con el usuario que ha iniciado sesión  */

   session_start(); //permite el uso de variables de sesión
   include "conexion.php";
   $id = $_SESSION["id"]; //$id es una variable local que se refiere a la variable superglobal de sesión $_SESSION["id"] que se refiere al id de los usuarios
   /*preparamos la sentencia sql que selecciona los datos de los eventos del usuario que coincidan con el id del inicio de sesion*/
   $select = $conex->prepare("
      SELECT *                       
      FROM evento,tipoevent,lugarevent 
      WHERE fk_usuario = :id
      and evento.fk_tipo = tipoevent.idTipoEvent 
      and evento.fk_lugar = lugarevent.idLugar
   "); 
   $select->execute(array(":id" => $id)); //se ejecuta la sentencia  
   $arrayEventLogin = []; //variable local de tipo array vacia 
   while($fila = $select->fetch(PDO::FETCH_ASSOC)){ //hacemos un bucle que recorra $fila (variable local de tipo array que contiene $select (variable local de tipo object que contiene los datos de la base de datos))
      $arrayEventLogin[] = array( //llenamos el array con los datos que nos ha devuelto la base de datos, es decir, los datos de cada evento que esten asociado con el usuario que ha iniciado sesión.
         "tipo" => $fila["tipo"],
         "lugar" => $fila["poblacion"],
         "fecha" => $fila["fecha"],
         "hora" => $fila["hora"],
         "estado" => $fila["estado"],
         "id" => $fila["fk_usuario"]    
      );
   }
   $arrayToString = json_encode($arrayEventLogin); //convertimos el array a string
   echo $arrayToString; //los pintamos
?>
