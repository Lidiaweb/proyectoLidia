<?php

/* Este archivo declara las variables de sesión y permite que el usuario inicie sesión.*/

    session_start(); //habilita en el archivo las variables de session.
    include "conexion.php"; //conecta con la base de datos.
    if(isset($_POST) && !empty($_POST)){ //valida que exista las variables superglobales $_POST y que no estén vacias
        $email= $_POST["email"]; //variable local de tipo string que se refiere a la variable superglobal $_POST["email"] que contiene el valor que el usuario introduzca en el input "email" del formulario, por ello su nombre.
        $pass = $_POST["pass"]; //variable local de tipo string que se refiere a la variable superglobal $_POST["pass"] que contiene el valor que el usuario introduzca en el input "pass" del formulario, por ello su nombre.
        /*sentencia sql que selecciona en la base de datos todo del usuario que coincida con el email insertado.*/
        $select = $conex->prepare("
            SELECT * 
            FROM usuario 
            WHERE email = :email"); 
        $select->execute(array(":email" => $email )); //se ejecuta.
        $numFila = $select->rowCount(); //variable local de tipo integer que se refiere al numero de usuarios con ese email.
        if($numFila != 0){ //si no hay ninguno con este email que se ejecute la sentencia sql siguiente
            $user = $select->fetch(PDO::FETCH_ASSOC); //variable de tipo array que contiene $select (variable de tipo object que contiene los datos de la base de datos).
            if(password_verify($pass,$user["pass"])){
                /*variables superglobales de sesion que se refieren a otras variable locales que engloban los datos que se han solicitado a la base de datos, del usuario que ha iniciado sesión. */
                $_SESSION["id"] = $user["idUsuario"]; 
                $_SESSION["nombre"] = $user["nombreUsuario"];
                $_SESSION["email"] = $user["email"];
                $_SESSION["tipo"] = $user["tipo"];
                header("Location:indexLogin.php"); //url a la que manda los datos       
            }
            else { 
                echo "Contraseña incorrecta!"; 
            } 
        } else { 
            echo "Debe introducir un email válido!";
        }
    } //condicional que indica que si hay un email y una contraseña igual al insertado se declaren las variables globales de sesion y si no devuelve mensajes de error.
?>