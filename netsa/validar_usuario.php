<?php
 
 	 require_once './conexion.php';	        		


	 $data=$_POST;	 
	 $login=$data["login"];
	 $password=$data["password"];

	 try
     {		

         $consulta= " select cli.id_clie,cli.nomb_clie as alias,'cliente' as tipo_usuario,".
         " cto.id_contr,cto.fecha_contr  from  cliente cli  left join contratocab cto on cto.id_clie=cli.id_clie  where trim((SUBSTRING(cli.ci_clie,1,8)))='$password' and  cto.id_contr='$login' ";

     /*			     		
    	$datos=array("consulta"=>$consulta,"data"=>$data);
		echo  json_encode($datos);
		exit;*/
		 

    	$resultado = mysqli_query( $conexion,$consulta) or 
			  die("Algo ha ido mal en la consulta a la base de datos de usuarios"); 

		/*	  
		$datos= array("consulta"=>$consulta,"data"=>$data);
		echo    json_encode($datos);
		exit;
		*/ 
		
			$rw=mysqli_fetch_assoc($resultado);
			if(!empty($rw))
			{	
				session_start();
			    $_SESSION['usuario'] =$rw;

			   $datos= array("consulta"=>$consulta,"data"=>$data,"rw"=>$rw,'estado' =>"existe");
			   echo    json_encode($datos); 
			   exit();
			}
			else 
			{
				echo json_encode( array('estado' =>"no_existe","usr"=>$rw));
			    exit;
			}

   	}	
     catch (Exception $e)
     { 
        echo json_encode('Excepción capturada: ',  $e->getMessage(),"\n");
        exit;
     }
?>