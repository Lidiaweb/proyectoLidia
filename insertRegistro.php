<?php

/*Este archivo permite que el usuario se registre en la base de datos con un email y una contraseña encriptada*/

    include "conexion.php"; //incluye archivo de conexión con la bade de datos.
    if (isset($_POST) && !empty($_POST)) { //valida que exista las variables superglobales $_POST y que no estén vacias
        $pass = $_POST["pass"]; //variable local de tipo string que se refiere a la variable superglobal $_POST["pass"] que contiene el valor que el usuario introduzca en el input "pass" del formulario, por ello su nombre.
        $passEncrip = password_hash($pass, PASSWORD_DEFAULT, array("cost" => 10)); //variable local de tipo string que se refiere a la variable anterior encriptada.
        /* sentencia sql que selecciona el id del usuario cuyo email coincida con el email que se inserte en el campo "email" del formulario. Las variables locales $select y $conex son de tipo object y se refieren a esta sentencia*/ 
        $select = $conex->prepare(" 
            SELECT idUsuario
            FROM usuario 
            WHERE email = :email");
        $select->execute(array(":email" => $_POST["email"]));//aquí se ejecuta la consulta con un array cuyo filtro está indicado con la variable superglobal $_POST["email"] que se refiere al valor del campo email del formulario, de ahi su nombre.
        $numFila = $select->rowCount();//variable local de tipo integer que se refiere al numero de usuarios con ese email.
        if ($numFila === 0) { //si no hay ninguno con este email que se ejecute la sentencia sql siguiente
            /* inserta en la tabla de usuario de la base de datos los valores de las siguientes variables, siempre como usuarios de manera predeterminada.*/
            $insert = $conex->prepare("
                INSERT INTO usuario 
                (nombreUsuario,apellido,email,tlf,pass,tipo)
                VALUES 
                (:nombre,:apellido,:email,:tlf,:pass,'u')"); 
            $insert->execute(array(
                ":nombre" => $_POST["nombre"],
                ":apellido" => $_POST["apellido"],
                ":email" => $_POST["email"],
                ":tlf" => $_POST["tlf"],
                ":pass" => $passEncrip
                ));
            echo "Registrado correctamente! Haz clic en Inicia sesión!";   
            
        } else {
            echo "El email ya existe!";          
        } //condicional que indica que si no hay ningun email igual se inserte en la base de datos y si lo hay le mande un mensaje.
    }
?>
