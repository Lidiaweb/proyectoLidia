<?php

/*En este archivo se habilitan las variables de sesión y se validan. Se hacen varios condicionales para establecer el html que va a mostrarse según la situación.*/

session_start(); //se habilitan las variables superglobales de sesión
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <meta name="robots" content="noindex, nofollow">
    <meta name="author" content="Lidia Gómez">
    <meta name="copyright" content="Jazz&feel">
    <meta name="description" content="Jazz&Feel, es un grupo musical dedicado a crear bellos momentos a través de sus interpretaciones. Está formado por voz y piano entre otras posibilidades.">
    <meta name="keywords" content="jazz, feel, música, directo, bodas, amenizar, Manu, Contreras, Lidia, Gómez">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <link rel="icon" sizes="16x16" type="image/png" href="./src/img/favicon16.png">
    <link rel="icon" sizes="32x32" type="image/png" href="./src/img/favicon32.png">
    <link rel="icon" sizes="64x64" type="image/png" href="./src/img/favicon64.png">
    <link rel="icon" sizes="128x128" type="image/png" href="./src/img/favicon128.png">
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/mdb.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="./css/estilos.css">
    <title>Jazz&Feel</title>    
</head>
<body class="body_container">
    <header>
        <!------------------ MENU DE NAVEGACIÓN ------------->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"data-mdb-toggle="collapse"><i class="fas fa-bars"></i></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php
                        if(isset($_SESSION["id"])){//aquí se valida que la sesión exista. $_SESSION["id"] es una variable superglobal  que se refiere al id del usuario.
                            if($_SESSION["tipo"] === "a"){ //aquí se indica que si ha iniciado sesión el administrador se muestre lo siguiente en el header, sino lo que se muestra en la otra opción que sería lo que se ve si inicia un usuario. $_SESSION["tipo"] es una variable superglobal que se refiere al tipo de usuario.
                                ?>
                                <!------------------ MENU DE NAVEGACIÓN CUANDO INICIA UN ADMINISTRADOR ------------->
                                <li class="nav-item">
                                    <a class="nav-link active" href="./indexLogin.php">Panel de control</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="./editUsuar.html">Usuarios</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="./editEvent.html">Eventos</a>
                                </li>
                            <?php }
                            else{ ?>
                                <!------------------ MENU DE NAVEGACIÓN CUANDO INICIA UN USUARIO ------------->
                                <li class="nav-item">
                                    <a class="nav-link active" href="indexLogin.php">Mi perfil</a>
                                </li>    
                            <?php } ?>
                                <!------------------ ITEM DEL MENÚ PARA AMBAS SITUACIONES ------------->
                                <li class="nav-item">
                                    <a class="nav-link" href="cerrarSesion.php">Cerrar sesion</a>    
                                </li>
                        <?php }
                        else{ ?>
                            <!------------------ MENU DE NAVEGACIÓN SI NO HAY INICIO ------------->
                            <li class="nav-item">
                                <a class="nav-link" href="registrate.html">Regístrate</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="login.html">Inicia sesión</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="d-flex align-items-center">
                    <a class="text-reset me-3" href="./index.html" target="_blank"><i class="fas fa-home"></i></a>
                </div> 
            </div>
        </nav>
    </header>
    <main>
        <?php
            if(isset($_SESSION["id"])){
                if($_SESSION["tipo"] === "a"){ //aquí se indica que si ha iniciado sesión el administrador se muestre lo siguiente en el main, sino lo que se muestra en la otra opción que sería lo que se ve si inicia un usuario
                    ?>
                    <!------------------ MAIN CUANDO INICIA UN ADMINISTRADOR ------------->
                    <section id="admin" class="text-center">
                        <img src="./src/img/avatarAdmin.png">
                        <h2>Lidia Gómez</h2>
                        <p>Administradora</p>
                    </section>                
                <?php }
                else{ ?>
                    <!------------------ MAIN CUANDO INICIA UN USUARIO ------------->
                    <div id="alertIndexLoginUser" class="alert alert-danger oculto alertOculto" role="alert"></div>
                    <!------------------ DATOS DEL USUARIO QUE INICIA SESIÓN (SE PINTAN CON AJAX) ------------->
                    <section id="user" class="text-center">     
                    </section>
                    <!------------------ FORMULARIO PARA MODIFICAR LOS DATOS DE LOS USUARIOS LOGADOS (OCULTO DE MANERA PREDETERMINADA) ------------->
                    <section class="oculto" id="formOcultoUserUp">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                                    <div class="card-body p-5 text-center">
                                        <div class="mb-md-5 mt-md-4 pb-5">
                                            <span class="close closeUp">&times;</span> 
                                            <h2 class="fw-bold mb-2 text-uppercase">MODIFICAR MIS DATOS</h2><br>
                                            <form class="form" id="formUserUp">
                                                <input type="hidden" name="id" id="idUserUp">
                                                <div class="form-outline form-white mb-4">
                                                    <input type="text" id="nombreUserUp" class="form-control form-control-lg" required>
                                                    <label class="form-label">Nombre</label> 
                                                </div>
                                                <div class="form-outline form-white mb-4"> 
                                                    <input type="text" id="apellidoUserUp" class="form-control form-control-lg" required>
                                                    <label class="form-label">Apellido</label>     
                                                </div>
                                                <div class="form-outline form-white mb-4">
                                                    <input type="mail" id="emailUserUp" class="form-control form-control-lg" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}">
                                                    <label class="form-label">Email</label>    
                                                </div>
                                                <div class="form-outline form-white mb-4">
                                                    <input type="tel" id="tlfUserUp" class="form-control form-control-lg" required pattern="[0-9]{9}">
                                                    <label class="form-label">Tlf</label>
                                                </div>
                                                <div class="form-outline form-white d-md-flex justify-content-center">
                                                    <button type="submit" class="btn btn-outline-light px-3">MODIFICAR</button>
                                                </div>     
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>        
                    </section>
                    <!------------------ FORMULARIO PARA RESERVAR EVENTOS -------------> 
                    <section>
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                                    <div class="card-body p-5 text-center">
                                        <div class="mb-md-5 mt-md-4 pb-5">
                                            <h2 class="fw-bold mb-2 text-uppercase">RESERVAR EVENTO</h2><br>
                                            <form class="form formReserv">
                                                <div class="form-outline form-white mb-4">
                                                    <select id="tipoReserv" class="form-select"></select>
                                                    <label class="form-label">Tipo</label>
                                                </div>
                                                <div class="form-outline form-white mb-4"> 
                                                    <select id="lugarReserv" class="form-select"></select>
                                                    <label class="form-label">Lugar</label>     
                                                </div>
                                                <div class="form-outline form-white mb-4">
                                                    <input type="date" id="fechaReserv" class="form-control form-control-lg">
                                                    <label class="form-label">Fecha</label>   
                                                </div>
                                                <div class="form-outline form-white mb-4">
                                                    <input type="time" id="horaReserv" class="form-control form-control-lg">
                                                    <label class="form-label">Hora</label>
                                                </div>
                                                <div class="form-outline form-white d-md-flex justify-content-center">
                                                    <button type="submit" class="btn btn-outline-light px-3">RESERVAR</button>
                                                </div>   
                                            </form>
                                            <div id="alertIndexLoginEvent" class="alert alert-danger alertOculto oculto" role="alert"></div>     
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="girar">
                        <h2>Gire el dispositivo para ver el contenido</h2>  
                    </div>
                    <!------------------ TABLA DE LOS EVENTOS DEL USUARIO LOGADO ------------->
                    <section class="sectionTable tablaOculta">
                        <h2>Mis eventos</h2>
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                  <th scope="col">TIPO DE EVENTO</th>
                                  <th scope="col">LUGAR</th>
                                  <th scope="col">FECHA</th>
                                  <th scope="col">HORA</th>
                                  <th scope="col">ESTADO</th>
                                </tr>
                            </thead>
                            <!------------------ TABLA QUE SE RELLENA CON AJAX ------------->
                            <tbody id="eventLogin"></tbody>
                        </table>   
                    </section>                   
                <?php }
            }
            else{ ?>
                <!------------------ MAIN CUANDO NO HAY INICIO ------------->
                <section class="container">
                    <img src="./src/img/logo.svg" style="width: 250px;" class="mx-auto d-block">
                </section>
                <div class="alert alert-danger alertOculto oculto" role="alert"></div>
            <?php }
       ?>                  
    </main>
    

<!------ SCRIPTS JS ------------>

    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init();</script>
    <script src="./js/all.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/mdb.min.js"></script>
    <script src="./js/main.js"></script>
</body>
</html>


