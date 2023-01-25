<?php   
		session_start();

		if(isset($_SESSION['usuario']))
		{	  	
			if(!empty($_SESSION['usuario']))
			{  
			  echo json_encode($_SESSION['usuario']);		
			  exit();
			}
		}

	echo json_encode(null);		
		
?>