<?php 
 	  require_once './conexion.php';

	  $data=$_POST;	 
	  $login=$data["login"];
	  $password=$data["password"]; 
	  
	 try
     {	
       $consulta= " select cli.id_clie,cli.nomb_clie as alias,'cliente' as tipo_usuario,cli.nomb_clie,cli.ci_clie,cli.nit_clie,cli.celu_clie, cto.id_contr,cto.fecha_contr   from  cliente cli  left join contratocab cto on cto.id_clie=cli.id_clie  where trim((SUBSTRING(cli.ci_clie,1,8)))='$password' and  cto.id_contr='$login' ";

    	$resultado = mysqli_query( $conexion,$consulta) or 
			  die("Algo ha ido mal en la consulta a la base de datos de usuarios"); 
		
			$rw=mysqli_fetch_assoc($resultado);
			if($rw)
			{	
				session_start();
			   $_SESSION['usuario'] =$rw;			   
			   $data_out=array
			   					( 
			   						"id_clie"=>$rw["id_clie"],
			   						"alias"=>$rw["alias"],			   						
			   						"tipo_usuario"=>$rw["tipo_usuario"],
			   						"nomb_clie"=>$rw["nomb_clie"],
			   						"ci_clie"=>$rw["ci_clie"],
			   						"nit_clie"=>$rw["nit_clie"],
			   						"celu_clie"=>$rw["celu_clie"]
			   					);

			   $datos= array( "consulta4"=>$consulta,
			   							  "data_in_4"=>$data,'estado' =>"existe",
			   							 "data_out_4"=>$data_out);

			   echo    json_encode($datos); 
			   exit();
			}
			else 
			{
				echo json_encode( array('estado' =>"no_existe","usr"=>$rw));
			   exit;
			}

			mysqli_free_result($resultado);	

   	}	
     catch (Exception $e)
     { 
        echo json_encode(array("error"=>'Excepción capturada: '.$e->getMessage(),"\n"));
        exit;
     }
     echo json_encode("sin opciones");
?>