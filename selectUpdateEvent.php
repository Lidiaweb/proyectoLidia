<?php

/* Este archivo selecciona los datos de un evento determinado cuyo id coincida con el id que le indicamos */

   include "conexion.php"; //incluimos el archivo de conexión con la base de datos
   /*Las variables locales $select y $conex son de tipo object y se refieren a la consulta que hacemos a la base de datos*/
   $select = $conex->prepare("
      SELECT *             
      FROM evento
      WHERE idEvento = :id
   "); //preparamos la sentencia sql que selecciona los datos de un evento que coincida con un id que enviamos.
   $select->execute(array(":id" => $_POST["id"])); //se ejecuta la consulta
   $fila = $select->fetch(PDO::FETCH_ASSOC); //variable local de tipo array que contiene $select (variable local de tipo object que contiene los datos de la base de datos)
   $arrayEvento = array( //array con los datos que nos ha devuelto la base de datos, es decir, datos del evento con ese id. El nombre de la variable se refiere al evento.
      "id" =>$fila["idEvento"] ,
      "fecha" =>$fila["fecha"],
      "estado"=>$fila["estado"],
      "hora" =>$fila["hora"],
      "tipo" =>$fila["fk_tipo"],
      "lugar" =>$fila["fk_lugar"],
      "usuario" =>$fila["fk_usuario"]
   );
   $arrayToString = json_encode($arrayEvento); //convertimos el array a string
   echo ($arrayToString); //los pintamos
?>

