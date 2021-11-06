<?php

/*En este archivo se indica que se cierre sesión y se muestre el enlace descrito*/

    session_start();
    session_destroy();
    header("Location:indexLogin.php");
?>