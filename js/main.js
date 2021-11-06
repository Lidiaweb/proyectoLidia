
$(document).ready(function(){ //las funciones y eventos que vayan dentro de estas llaves se ejecutarán cuando se cargue la página

	
/*//////////////////////////////////////////// HTML ////////////////////////////////////////////////////////*/


	/*////////// FUNCIÓN QUE CAMBIA DE POSICIÓN LA FLECHA HACIA ARRIBA DEL INDEX.HTML CUANDO LLEGUE A UN PUNTO EL SCROLL /////////*/

	$(window).scroll(function() {
    if ($(document).scrollTop() > 1100) {
      $(".fa-arrow-up").css("bottom", "80px");
    } else {
      $(".fa-arrow-up").css("bottom", "20px");
    }
  });//fin del scroll

	/*//////////// FUNCIONES Y EVENTOS QUE HACEN QUE SE MUESTRE EL MENÚ BURGUER Y QUE SE CIERRE DÁNDOLE A LA CRUZ  //////////*/

	$(".burger").click(function() {
		$("#nav01").slideDown("slow"); 
		$(".burger").hide();
		$(".cruz").show();
	});//fin del click

	$(".cruz").click(function() {
		$("#nav01").slideUp("slow");
		$(".cruz").hide();
		$(".burger").show();
	});//fin del click

	$("#nav01 a").click(function() {
		$("#nav01").slideUp("slow");
		$(".cruz").hide();
		$(".burger").show(); 		
	});//fin del click

	/*//////////////// FUNCIONES Y EVENTOS DEL MODAL DE LA SECCIÓN CONÓCENOS ///////////*/
  

	$("#imgconocenos01").click(function() { //al hacer clic en la imagen se produce una función
		var caption = $(this).attr("alt"); //la variable caption de tipo local, llamada así porque hace referencia al caption de la imagen, engloga el atributo alt de la imagen en cuestión
		$("#myModal").css("display", "block"); //al elemento myModal le decimos que aparezca al hacer clic
		$("#img01").attr("src","./src/img/conocenos/img01.jpg"); //indicamos la ruta de la imagen que queremos que aparezca en el modal
		$("#caption").html(caption) //indicamos que la variable caption se muestre en un elemento con id "caption"
	});

	$("#imgconocenos02").click(function() {
		var caption = $(this).attr("alt");
		$("#myModal").css("display", "block");
		$("#img01").attr("src","./src/img/conocenos/img02.jpg");
		$("#caption").html(caption)
	});

	$("#imgconocenos03").click(function() {
		var caption = $(this).attr("alt");
		$("#myModal").css("display", "block");
		$("#img01").attr("src","./src/img/conocenos/img03.jpg");
		$("#caption").html(caption)
	});

	$(".close").click(function() {
		$("#myModal").hide()
	});



/*////////////////////////////////////////////// PHP ///////////////////////////////////////////////////////*/

/* Las explicaciones de las partes de las funciones y métodos sólo se harán en los primeros de cada tipo por ser en todos iguales y en cada una de ellas se especificará lo conveniente.*/



  /*////////////////////////// FUNCIONES DE PHP (las llamamos cuando el documento se carga) /////////////////////////*/

  listarEventContacto(); //pinta los eventos (de la base de datos) en el contacto.html
  listarEventAdmin(); //pinta los eventos en el panel de administrador indexLogin.php
  listarTipo(); //pinta el tipo de evento en las tablas y formularios 
  listarLugar(); //pinta el lugar del evento en tablas y formularios
  listarNomUser(); //pinta el nombre y apellido en las tablas y formularios
  listarUser(); //pinta los datos de los usuarios en las tablas de editUsuar.html
  listarUserLogin(); //pinta los datos del usuario que ha iniciado sesión en su panel
  listarEventLogin(); //pinta los eventos y las reservas del usuario que ha iniciado sesión en su panel


	/*/////////////////// PINTAR EVENTOS EN contacto.html e index.html //////////////*/

	function listarEventContacto() {
		$.ajax({ //utilizamos la función ajax 
			url: "./selectEventContacto.php", //url del archivo php con la sentencia sql
	  	type: "POST",  //método del envio 
	  	success: function (respuesta) { //respuesta de la base de datos
	    	let eventosContacto = JSON.parse(respuesta); //variable local de tipo object que engloba los datos del evento que nos devuelve la base de datos (estos datos se transforman a JSON porque javaScript no soporta arrays asociativos). Su nombre se refiere a los eventos del contacto.html.
        let html = ''; //variable local de tipo string vacia para meter código html; se llama así porque hace referencia al html
	    	for (let i = 0; i < eventosContacto.length; i++) { //bucle que recorre el array de datos que nos devuelve la base de datos; la variable local de tipo integer "i" hace referencia a cada posición del array.
          const eventContact = eventosContacto[i]; //constante de tipo array que engloba el indice de la variable anterior, es decir, de la respuesta.
          /* codigo html que se va a pintar*/
          html += `<tr> 
            	      	<th scope="row">${eventContact.tipo}</th>
            	      	<td>${eventContact.lugar}</td>
            	      	<td>${eventContact.fecha}</td>
            	      	<td>${eventContact.hora}</td>
	      	        </tr>`; 
        }
	      $(".eventContacto").html(html); //selección del elemento de html donde queremos que se pinte 
	    }
	  })  
	};

	/*/////////////////// PINTAR EVENTOS EN TABLA editEvent.html //////////////*/

	function listarEventAdmin() {
		$.ajax({
			url: "./selectEvento.php",
	  	type: "POST",
	  	success: function (respuesta) {
	    	let eventos = JSON.parse(respuesta); //Su nombre se refiere a los eventos en general.
	    	let html = '';
	    	for (let i = 0; i < eventos.length; i++) {
          const event = eventos[i];
          html += `<tr>
                      <th scope="row">${event.id}</th>
                      <td>${event.tipo}</td>
                      <td>${event.lugar}</td>
                      <td>${event.fecha}</td>
                      <td>${event.hora}</td>
                      <td>${event.usuario} ${event.apeUsuario}</td>
                      <td>${event.estado}</td>
                      <td><a class="updateEvent" href="#!" role="button" id="${event.id}"><i class="fas fa-edit"></i></a></td>
                      <td><a class="deleteEvent" href="#!" role="button" id="${event.id}"><i class="fas fa-trash"></i></a></td>
                    </tr>`; 
        }
	      $(".eventAdmin").html(html);   
	    }
	  })  
	};

	/*/////////////////// PINTAR TIPO DE EVENTOS EN TABLA Y FORM DEL ACTUALIZAR EN editEvent.html Y EN FORM DE indexLogin.php //////////////*/

	function listarTipo() {
    $.ajax({
      url: "./selectTipo.php",
      type: "POST",
      success: function (respuesta) {
        let tipos = JSON.parse(respuesta); //Su nombre se refiere al tipo de evento.
        let html = '';
        for (let i = 0; i < tipos.length; i++) {
          const tipo = tipos[i];
          html += `<option value="${tipo.id}">${tipo.tipo}</option>`;
        }
        $("#tipo").html(html);
        $("#tipoUp").html(html);
        $("#tipoReserv").html(html);
      }
    })
  };

  /*/////////////////// PINTAR LUGAR DEL EVENTO EN TABLA Y FORM DE ACTUALIZAR editEvent.html Y EN FORM DE indexLogin.php //////////////*/

	function listarLugar() {
    $.ajax({
      url: "./selectLugar.php",
      type: "POST",
      success: function (respuesta) {
        let lugares = JSON.parse(respuesta); //Su nombre se refiere al lugar del evento.
        let html = '';
        for (let i = 0; i < lugares.length; i++) {
          const lugar = lugares[i];
          html += `<option value="${lugar.id}">${lugar.lugar}</option> `; 
        }
        $("#lugar").html(html);
        $("#lugarUp").html(html);
        $("#lugarReserv").html(html);
      }
    })
  };

  /*/////////////////// PINTAR NOMBRE DE USUARIO EN TABLA Y FORM DE ACTUALIZAR DE editEvent.html Y EN FORM DE indexLogin.php //////////////*/

	function listarNomUser() {
		$.ajax({
	  	url: './selectUsuario.php',
	    type: 'POST',
	    success: function (respuesta) {
	      let usuarios = JSON.parse(respuesta); //Su nombre se refiere al nombre y apellido de los usuarios.
	      let html = '';
	      for (let i = 0; i < usuarios.length; i++) {
	        const user = usuarios[i];
	        html += `<option value="${user.id}">${user.nombre} ${user.apellido}</option>`;
	      }
	      $("#nombreUsuario").html(html);
	      $("#usuarioUp").html(html);
			}
		})    
	};

	/*///////////////////PINTAR DATOS DEL USUARIO editUsuar.html //////////////*/

	function listarUser() {
		$.ajax({
	  	url: './selectUsuario.php',
	    type: 'POST',
	    success: function (respuesta) {
	      let usuarios = JSON.parse(respuesta); //Su nombre se refiere al nombre y apellido de los usuarios.
	      let html = '';
	      for (let i = 0; i < usuarios.length; i++) {
	        const user = usuarios[i];
	        html += `<tr>
            	      	<th scope="row">${user.id}</th>
            	      	<td>${user.nombre} ${user.apellido}</td>
            	      	<td>${user.email}</td>
            	      	<td>${user.tlf}</td>
            	      	<td><a class="updateUser" href="#!" role="button" id="${user.id}"><i class="fas fa-edit"></i></a></td>
                      <td><a class="deleteUser" href="#!" role="button" id="${user.id}"><i class="fas fa-trash"></i></a></td>
	      	        </tr>`;
	      }
	      $("#usuario").html(html);
			}
		})    
	};

	/*/////////////////// PINTAR DATOS DEL USUARIO indexLogin.php //////////////*/

	function listarUserLogin() {
    $.ajax({
      url: './selectUserLogin.php',
      type: 'POST',
      success: function (respuesta) {
        let userLogin = JSON.parse(respuesta); //Su nombre se refiere a los datos del usuario logado.
        let html = '';
        userLogin.forEach(userLog =>{
          html += `<img src="./src/img/avatarUser.png">
                  <h2>${userLog.nombre} ${userLog.apellido}</h2>
                  <p>${userLog.email}</p>
                  <p>${userLog.tlf}</p>
                  <span><a class="updateUserLogin" href="#!" role="button" id="${userLog.id}"><i class="fas fa-edit"></i></a></span>`;            
        })
        $("#user").html(html);
      }
    })
  };

  /*/////////////////// PINTAR DATOS DEL EVENTO indexLogin.php //////////////*/

  function listarEventLogin() {
    $.ajax({
      url: './selectEventLogin.php',
      type: 'POST',
      success: function (respuesta) {
        let eventLogin = JSON.parse(respuesta); //Su nombre se refiere a los eventos del usuario logado.
        let html = '';
        eventLogin.forEach(eventLog =>{ 
          html += `<tr>
                    <th scope="row">${eventLog.tipo}</th>
                    <td>${eventLog.lugar}</td>
                    <td>${eventLog.fecha}</td>
                    <td>${eventLog.hora}</td>
                    <td>${eventLog.estado}</td>
                  </tr>`; 
        })
        $("#eventLogin").html(html); 
      }
    })
  };

  /*/////////////////// FUNCION QUE HACE DESAPARECER LOS MENSAJES DE ALERTAS SI SELECCIONAMOS UN INPUT O SELECT //////////////*/

  $("input,select").focus(function() { 
    $(".alertOculto").hide();
  });

  /*/////////////////// INSERTAR EVENTO editEvent.html //////////////*/

  $(".formEvent").submit(eve => { //se envía el formulario clicando en el input "submit"
    eve.preventDefault(); //impedimos que se recargue la página
    const data = { //constante de tipo object que se refiere a los datos que enviamos a la base de datos.
      /*variables que se refieren al valor de los campos del formulario; sus nombres hacen referencia al dato que vamos a enviar*/
      fecha: $("#fecha").val(), 
      hora: $("#hora").val(),
      tipo: $("#tipo").val(),
      lugar: $("#lugar").val(),
      usuario: $("#nombreUsuario").val(),
      estado: $("#estado").val()
    }
    $.post("./insertEvent.php", data, (respuesta) => { //mediante método post enviamos los datos anteriores a esta url y obtenemos una respuesta que queremos pintar en un html
      $(".alertOculto").show(); //se muestra el elemento html donde se va a pintar el mensaje que estaba oculto de manera predeterminada
      $(".alertOculto").html(respuesta); //se pinta el mensaje
      listarEventAdmin(); //se invoca de nuevo a la función que pinta los datos para que actualice el html
    })
  });

  /*/////////////////// INSERTAR RESERVA indexLogin.php //////////////*/

  $(".formReserv").submit(eve => {
    eve.preventDefault();
    const data = {
      fecha: $("#fechaReserv").val(),
      hora: $("#horaReserv").val(),
      tipo: $("#tipoReserv").val(),
      lugar: $("#lugarReserv").val()
    }
    $.post("./insertReserv.php", data, (respuesta) => {
      $(location).attr('href',"#alertIndexLoginEvent");
      $("#alertIndexLoginEvent").show();
      $("#alertIndexLoginEvent").html(respuesta);
      listarEventLogin();
    })
  });

  /*/////////////////// REGISTRO DE USUARIO registrate.html //////////////*/

  $(".formReg").submit(eve => {
    eve.preventDefault();
    const data = {
      nombre: $("#nombre").val(),
      apellido: $("#apellido").val(),
      email: $("#email").val(),
      tlf: $("#tlf").val(),
      pass: $("#pass").val()
    }
    $.post("./insertRegistro.php", data, (respuesta) => { 
      $(location).attr('href',"#alertRegistro");
      $(".alertOculto").show();
      $(".alertOculto").html(respuesta);  
    })
  });

  /*/////////////////// INICIO DE SESION login.html  //////////////*/
  
  $(".formLogin").submit(eve => {
    eve.preventDefault();
    const data = {
      email: $("#emailLogin").val(),
      pass: $("#passLogin").val()
    }
    $.ajax({
      url: "./selectLogin.php",
      data: data,
      method: "POST",
      success: function (respuesta) {
        $(location).attr('href',"indexlogin.php");       
      }
    })   
  });

  /*/////////////////// ELIMINAR EVENTO EN TABLA editEvent.html //////////////*/

  $(document).on("click", ".deleteEvent", () => { //al hacer clic en este elemento se produce una función
    const id = $(this)[0].activeElement.id; //constante de tipo integer que se refiere al id del elemento activo en ese momento
    $.post("./deleteEvent.php", {id}, (respuesta) => { //mediante metodo post enviamos el id a esta url y obtenemos una respuesta que queremos pintar en un html
      listarEventAdmin(); //se invoca de nuevo a la función que pinta los datos para que actualice el html
      $(location).attr('href',"#alertEditEvent"); //se enlaza con el sitio donde se va a mostrar el elemento que va a llevar pintado el mensaje
      $(".alertOculto").show(); //se muestra el elemento html donde se va a pintar el mensaje que estaba oculto de manera predeterminada
      $(".alertOculto").html(respuesta) //se pinta el mensaje
    })
  });

  /*/////////////////// ELIMINAR USUARIO EN TABLA editUsuar.html //////////////*/ 

  $(document).on("click", ".deleteUser", () => {
    const id = $(this)[0].activeElement.id;
    $.post("./deleteUser.php", {id}, (respuesta) => {
      listarUser();
      $(location).attr('href',"#alertEditUsuar");
      $(".alertOculto").show();
      $(".alertOculto").html(respuesta)
    })
  });

  /*/////////////////// ACTUALIZAR EVENTO EN TABLA editEvent.html //////////////*/

  $(document).on("click", ".updateEvent", () => {
    const id = $(this)[0].activeElement.id;
    $.post("./selectUpdateEvent.php", {id}, (respuesta) => {
      let evento = JSON.parse(respuesta); //variable local de tipo object que se refiere a los datos que devuelve la base de datos del elemento que ha sido seleccionado por su id. Su nombre se refiere a los eventos. 
      $(".alertOculto").hide(); //el elemento que contiene el mensaje se esconde
      /*pintamos en el formulario de modificación los datos que nos llegan de la sentencia sql*/
      $("#tipoUp").val(evento.tipo); 
      $("#lugarUp").val(evento.lugar);
      $("#fechaUp").val(evento.fecha);
      $("#horaUp").val(evento.hora);
      $("#usuarioUp").val(evento.usuario);
      $("#estadoUp").val(evento.estado);
      $("#idUp").val(evento.id);
      $("#formOcultoSectionEvent").fadeIn("slow"); //el formulario se muestra 
      $(".closeUp").click(function() { //cuando se haga clic en este elemento (una cruz) se produce una funcion
        $("#formOcultoSectionEvent").hide() //la funcion es que el formulario se vuelve a esconder
      });
    })   
  });


  $("#formOcultoEvent").submit((eve) => {//una vez se hayan modificado los datos se vuelven a enviar a la base de datos
    eve.preventDefault();
    const data = {
      tipo: $("#tipoUp").val(),
      lugar: $("#lugarUp").val(),
      fecha: $("#fechaUp").val(),
      hora: $("#horaUp").val(),
      usuario: $("#usuarioUp").val(),
      estado: $("#estadoUp").val(),
      id: $("#idUp").val()
    }
    $.ajax({
      url: "./updateEvent.php",// url donde se envian los datos
      data: data,// datos que se envian, que están definidos arriba
      method: "POST",// método por el que se envian
      success: function (respuesta) {//se recibe la respuesta
        $(location).attr('href',"#alertEditEvent");
      	$(".alertOculto").show();
        $(".alertOculto").html(respuesta);
        listarEventAdmin();
        $("#formOcultoSectionEvent").hide();
      }
    })
  });

  /*/////////////////// ACTUALIZAR USUARIO EN TABLA editUsuar.html //////////////*/

  $(document).on("click", ".updateUser", () => {
    const id = $(this)[0].activeElement.id;
    $.post("./selectUpdateUser.php", {id}, (respuesta) => {
      let usuario = JSON.parse(respuesta); //variable local de tipo object que se refiere a los datos que devuelve la base de datos del elemento que ha sido seleccionado por su id. Su nombre se refiere a los usuarios. 
      $(".alertOculto").hide();
      $("#idUp").val(usuario.id);
      $("#nombreUp").val(usuario.nombre);
      $("#apellidoUp").val(usuario.apellido);
      $("#emailUp").val(usuario.email);
      $("#tlfUp").val(usuario.tlf);
      $("#formOcultoSectionUser").fadeIn("slow");
      $(".closeUp").click(function() {
        $("#formOcultoSectionUser").hide()
      });   
    })   
  });


  $("#formOcultoUser").submit((eve) => {
    eve.preventDefault();
    const data = {
      id: $("#idUp").val(),
      nombre: $("#nombreUp").val(),
      apellido: $("#apellidoUp").val(),
      email: $("#emailUp").val(),
      tlf: $("#tlfUp").val()
    }
    $.ajax({
      url: "./updateUser.php",
      data: data,
      method: "POST",
      success: function (respuesta) {
        listarUser();
        $(location).attr('href',"#alertEditUsuar");
      	$(".alertOculto").show();
        $(".alertOculto").html(respuesta);
        $("#formOcultoSectionUser").hide();
      }
    })
  });

  /*/////////////////// ACTUALIZAR USUARIO EN indexLogin.php //////////////*/

  $(document).on("click", ".updateUserLogin", () => {
    const id = $(this)[0].activeElement.id;
    $.post("./selectUpdateUser.php", {id}, (respuesta) => {
      let usuario = JSON.parse(respuesta); //variable local de tipo object que se refiere a los datos que devuelve la base de datos del elemento que ha sido seleccionado por su id. Su nombre se refiere a los usuarios. 
      $("#idUserUp").val(usuario.id);
      $("#nombreUserUp").val(usuario.nombre);
      $("#apellidoUserUp").val(usuario.apellido);
      $("#emailUserUp").val(usuario.email);
      $("#tlfUserUp").val(usuario.tlf);
      $("#formOcultoUserUp").fadeIn("slow");
      $(".closeUp").click(function() {
        $("#formOcultoUserUp").hide()
      });   
    })   
  });


  $("#formUserUp").submit((eve) => {
    eve.preventDefault();
    const data = {
      id: $("#idUserUp").val(),
      nombre: $("#nombreUserUp").val(),
      apellido: $("#apellidoUserUp").val(),
      email: $("#emailUserUp").val(),
      tlf: $("#tlfUserUp").val()
    }
    $.ajax({
      url: "./updateUserLogin.php",
      data: data,
      method: "POST",
      success: function (respuesta) {
        $(location).attr('href',"#alertIndexLoginUser");
        listarUserLogin();
        $(".alertOculto").show();
        $(".alertOculto").html(respuesta);
        $("#formOcultoUserUp").hide();
      }
    })
  });




 
});//FIN DEL READY


