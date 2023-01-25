

  document.querySelector("#submit").addEventListener("click", e => {
  e.preventDefault();

  //INGRESE UN NUMERO DE WHATSAPP VALIDO AQUI:
  let telefono = "59171378667";

  let cliente = document.querySelector("#cliente").value;
  let correo = document.querySelector("#correo").value;
  let celular = document.querySelector("#celular").value;
  let fecha = document.querySelector("#fecha").value;
  let servicio = document.querySelector("#servicio").value;
  let plan = document.querySelector("#plan").value;
  //let url= document.querySelector("#url").value;
  let resp = document.querySelector("#respuesta");
  let resp = document.querySelector("#Ubicacion");
  resp.classList.remove("fail");
  resp.classList.remove("send");

  let url = `https://api.whatsapp.com/send?phone=${telefono}&text=
		*_NETSA SRL_*%0A
    *Internet Inalambrico*%0A
    
		*Nombre Completo*%0A
    ${cliente}%0A

    *Correo*%0A
    ${correo}%0A

    *Celular*%0A
    ${celular}%0A
    
		*Indica la fecha de tu reserva*%0A
    ${fecha}%0A

    
		*Tipo de Servicio*%0A
    ${servicio}%0A
    
		*Tipo de Plan*%0A
        

   *Tipo de Plan*%0A
    ${plan}`;
	
    

  if (cliente === "" || correo === "" || celular=== ""|| 
     fecha === ""| servicio=== ""|| plan === "") {
     resp.classList.add("fail");
     resp.innerHTML = `Faltan algunos datos, ${cliente}`;
     return false;
  }
     resp.classList.remove("fail");
     resp.classList.add("send");
     resp.innerHTML = `Se ha enviado tu reserva, ${cliente}`;

    window.open(url);







  })(jQuery);













 