<?php   
		session_start();

		if(isset($_SESSION['usuario']))
		{	  	
			if(!empty($_SESSION['usuario']))
			{  
				$data=$_SESSION['usuario'];
			  echo json_encode($data);		
			  exit();
			}
		}

	echo json_encode(null);		
		
?>