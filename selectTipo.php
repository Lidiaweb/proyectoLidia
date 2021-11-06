<?php

/* Este archivo selecciona el tipo de evento */
/* Las explicaciones son iguales que en el archivo selectLugar.php*/

    include "conexion.php";
    $select = $conex->prepare("SELECT * from tipoevent"); //preparamos la sentencia sql que selecciona el tipo de evento
    $select->execute();
    $arrayTipo= [];
    while($lista = $select->fetch(PDO::FETCH_ASSOC)){
        $arrayTipo[] = array( //llenamos el array con los datos que nos ha devuelto la base de datos, es decir, el tipo de cada evento.
            "id" => $lista["idTipoEvent"],
            "tipo" => $lista["tipo"]
        );
    }
    $arrayToString = json_encode($arrayTipo);
    echo $arrayToString;
?>