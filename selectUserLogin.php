<?php

/* Este archivo selecciona los datos de los usuarios que coincidan con el usuario que ha iniciado sesión  */

/* Las explicaciones son en su mayor parte iguales que en el archivo selectEventLogin.php */

    session_start();
    include "conexion.php";
    $email = $_SESSION["email"]; //variable local de tipo string que se refiere a una variable superglobal de inicio de sesion $_SESSION["email"] que se refiere al email con el que ha iniciado sesión el usuario
    $select = $conex->prepare("
        SELECT * 
        FROM usuario
        WHERE email = :email
    "); //preparamos la sentencia sql que selecciona los datos del usuario que ha iniciado sesión cuyo email coincida con el enviado
    $select->execute(array(":email" => $email));
    $arrayUserLogin = []; 
    while($fila = $select->fetch(PDO::FETCH_ASSOC)){
        $arrayUserLogin[] = array( //llenamos el array con los datos que nos ha devuelto la base de datos, es decir, los datos del usuario cuyo email coincide con el email que ha iniciado sesion
            "nombre" => $fila["nombreUsuario"],
            "apellido" => $fila["apellido"],
            "email" => $fila["email"],
            "tlf" => $fila["tlf"],
            "id" => $fila["idUsuario"]
        );
    }
    $arrayToString = json_encode($arrayUserLogin);
    echo $arrayToString;
?>

