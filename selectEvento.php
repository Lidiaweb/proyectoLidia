<?php

/* Este archivo selecciona los datos de los eventos */
/* Las explicaciones son las mismas que en el archivo selectEventContacto.php*/

	include "conexion.php";
	$select = $conex->prepare("
      SELECT evento.idEvento,
             evento.fecha,
             evento.hora,
             evento.estado,
             tipoevent.tipo,
             lugarevent.poblacion,
             usuario.nombreUsuario,
             usuario.apellido              
      FROM evento,tipoevent,lugarevent,usuario
      WHERE evento.fk_tipo = tipoevent.idTipoEvent 
      and evento.fk_lugar = lugarevent.idLugar
      and evento.fk_usuario = usuario.idUsuario
   ");
	$select->execute();
   $arrayEventos = [];
   while($fila = $select->fetch(PDO::FETCH_ASSOC)){
         $arrayEventos[] =array(
            "id"=>$fila["idEvento"],
            "fecha"=>$fila["fecha"],
            "hora"=>$fila["hora"],
            "estado"=>$fila["estado"],
            "tipo"=>$fila["tipo"],
            "lugar"=>$fila["poblacion"],
            "usuario"=>$fila["nombreUsuario"],
            "apeUsuario"=>$fila["apellido"]
         );
   }
   $arrayToString = json_encode($arrayEventos);
   echo ($arrayToString);
?>

