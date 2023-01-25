<?php 

//	echo json_encode($_POST); 
	//exit; 

	require_once("./PHPMailer/apiGMail.php");


	$emailSend=new apiGMail(); 

/*	
	fecha: "2022-05-06"
	lat: ""
	lng: ""
	plan: "PLAN ESTUDIANTIL"
	servicio: "PLAN HOGAR"
*/	
	
	$nombre=$_POST["nombre"];
	$numero=$_POST["numero"];
	$correo=$_POST["email"];	
	$plan=$_POST["plan"];	
	$servicio=$_POST["servicio"];	
	$fecha=$_POST["fecha"];	
	$lat=$_POST["lat"];	
	$lng=$_POST["lng"];	
	$mensaje_asunto=$_POST["mensaje_asunto"]; 

    $bodyHTML='
    	<h2>'.$mensaje_asunto.',<b>'.$nombre.'</b></h2> 
    	<table>
	    	<tr><td><b>Teléfono:</b>'.$numero.'</td></tr>
	    	<tr><td><b>Correo cliente:</b>'.$correo.'</td></tr>
	    	<tr><td><b>Plan:</b>'.$plan.'</td></tr>
	    	<tr><td><b>Servicio:</b>'.$servicio.'</td></tr>
	    	<tr><td><b>Fecha:</b>'.$fecha.'</td></tr>
	    	<tr><td><b>Latitud:</b>'.$lat.'</td></tr>
	    	<tr><td><b>Longitud:</b>'.$lng.'</td></tr>
    	</table>';

    //$mensaje_asunto

	$enviado=$emailSend->metEnviar("netsabolivia.com",
						"NETSA S.R.L.",				
						"srlnetsa@gmail.com",						
						//"Contacto de Cliente",
						$mensaje_asunto,

						 $bodyHTML); 

	if($enviado)
	{  
	   echo json_encode('exito');
	}
	else 
	{  
		echo json_encode('no_exito');		
	}  
	
?>