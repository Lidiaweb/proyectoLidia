<?php

/* Este archivo selecciona los datos de un usuario determinado cuyo id coincida con el id que le indicamos */

/* Las explicaciones son las mismas que en el archivo selectUpdateEvent.php */

   include "conexion.php";
   $select = $conex->prepare("
      SELECT *             
      FROM usuario
      WHERE idUsuario = :id
   ");
   $select->execute(array(":id" => $_POST["id"]));
   $fila = $select->fetch(PDO::FETCH_ASSOC);
   $arrayUsuario = array( // variable de tipo array cuyo nombre se refiere al usuario.
      "id" =>$fila["idUsuario"] ,
      "nombre" =>$fila["nombreUsuario"],
      "apellido" =>$fila["apellido"],
      "email" =>$fila["email"],
      "tlf" =>$fila["tlf"]  
   );
   $arrayToString = json_encode($arrayUsuario);
   echo ($arrayToString);
?>
