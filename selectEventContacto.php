<?php

/* Este archivo selecciona los datos de los eventos que coincidan con un estado confirmado para pintar en el html sólo los de esta condición */

	include "conexion.php"; //incluimos el archivo de conexión con la base de datos

   /*Las variables locales $select y $conex son de tipo object y se refieren a la sentencia sql que hacemos a la base de datos*/ 
	$select = $conex->prepare(" 
      SELECT
         evento.estado, 
         evento.fecha,
         evento.hora,
         tipoevent.tipo,
         lugarevent.poblacion              
      FROM evento,tipoevent,lugarevent
      WHERE evento.fk_tipo = tipoevent.idTipoEvent 
      and evento.fk_lugar = lugarevent.idLugar
      and evento.estado = 'Confirmado'
   ");
	$select->execute(); //se ejecuta la consulta.
   $arrayEventos = []; //variable local de tipo array vacía; se llama asi porque se refiere a los eventos
   while($fila = $select->fetch(PDO::FETCH_ASSOC)){ //hacemos un bucle que recorra $fila (variable local de tipo array que contiene $select (variable local de tipo object que contiene los datos de la base de datos))
      $arrayEventos[] =array( //llenamos el array con los datos que nos ha devuelto la base de datos, es decir, los datos de cada evento que exista.
         "fecha"=>$fila["fecha"],
         "hora"=>$fila["hora"],
         "tipo"=>$fila["tipo"],
         "lugar"=>$fila["poblacion"]
      );
   }
   $arrayToString = json_encode($arrayEventos); //convertimos el array a string
   echo ($arrayToString); //los pintamos
?>
