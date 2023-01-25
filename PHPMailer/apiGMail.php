<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

class apiGMail
{ 
  private $email=null;
	function __construct()
	{		
		$this->email=new  PHPMailer();
		$this->email->isSMTP(); 
		$this->email->SMTPAuth=true;
		$this->email->SMTPSecure='tls';
		$this->email->Host="smtp.gmail.com";
		$this->email->port=587; 
		$this->email->Username="srlnetsa@gmail.com"; 
		$this->email->Password="ybayzjmppwlbhvws"; 
	}  
	public function metEnviar(string $titulo,string $nombre,string $correo,string $asunto,string $bodyHTML)	                      
	{	 
	  $this->email->setFrom("srlnetsa@gmail.com","Titulo");
	  $this->email->addAddress($correo,$nombre); 
	  $this->email->Subject=$asunto;
	  $this->email->Body=$bodyHTML;
	  $this->email->isHTML(true);
	  $this->email->CharSet="UTF-8";    
	  return $this->email->send();	   
	} 
}
?>