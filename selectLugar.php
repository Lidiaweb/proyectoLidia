<?php

/* Este archivo selecciona el lugar de los eventos */

    include "conexion.php"; //incluimos el archivo de conexión con la base de datos
    /*Las variables locales $select y $conex son de tipo object y se refieren a la consulta que hacemos a la base de datos*/
    $select = $conex->prepare("SELECT * from lugarevent"); //preparamos la sentencia sql que selecciona el lugar de los eventos
    $select->execute(); //se ejecuta la consulta.
    $arrayLugar= []; //variable local de tipo array vacia; se llama asi porque se refiere al lugar de los eventos
    while($fila = $select->fetch(PDO::FETCH_ASSOC)){ //hacemos un bucle que recorra $fila (variable de tipo array que contiene $select (variable de tipo object que contiene los datos de la base de datos))
        $arrayLugar[] = array( //llenamos el array con los datos que nos ha devuelto la base de datos, es decir, los lugares de cada evento.
            "id" => $fila["idLugar"],
            "lugar" => $fila["poblacion"]
        );
    }
    $arrayToString = json_encode($arrayLugar); //convertimos el array a string
    echo $arrayToString; //los pintamos
?>