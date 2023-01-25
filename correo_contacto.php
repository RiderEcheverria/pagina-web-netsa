<?php 

//	echo json_encode($_POST); 
	//exit; 

	require_once("./PHPMailer/apiGMail.php");


	$emailSend=new apiGMail(); 
	
	$nombre=$_POST["nombre"];
	$numero=$_POST["numero"];
	$correo=$_POST["email"];
	$mensaje=$_POST["mensaje"];
	$mensaje_asunto=$_POST["mensaje_asunto"];

	

    $bodyHTML='
    	<h2>'.$mensaje_asunto.',<b>'.$nombre.'</b></h2> 
    	<table>
    	<tr><td><b>Teléfono:</b>'.$numero.'</td></tr>
    	<tr><td><b>Correo cliente:</b>'.$correo.'</td></tr>
    	</table>';

    	$bodyHTML.='<br/><br/><br/>';
    	$bodyHTML.='<h2>Mensaje:</h2>';
    	$bodyHTML.='<p>'.$mensaje.'</p>'; 

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