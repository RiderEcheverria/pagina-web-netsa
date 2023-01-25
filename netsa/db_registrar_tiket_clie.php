<?php 
	
  require_once './conexion.php';	           
  date_default_timezone_set('America/La_Paz'); 


//  $data=$_POST;  
//  $file=$_FILES;      
 // $datos=array("data"=>$data,"files"=>$files);  
 // echo json_encode( $datos); 
 // exit();


  $data=$_POST;
  $nro_tiket=date("YmdHis");
  $cliente_id=$data["cliente_id"]; 
  $asunto=$data["asunto"]; 
  $concepto=$data["concepto"]; 
  $quien_creo_tiket=$data["quien_creo_tiket"];
  //$estado_tiket=$data["estado_tiket"];    
  $descripcion=$data["descripcion"]; 
  $usuario_id=$data["usuario_id"];
  $created=date("Y-m-d H:i:s");


      $consulta="INSERT INTO tikets (cliente_id, nro_tiket, asunto, ". 
      " descripcion,concepto,usuario_id,created,quien_creo_tiket) ". 
      "  VALUES($cliente_id,'$nro_tiket',".
      " '$asunto', '$descripcion',".
      " '$concepto',$usuario_id,'$created','$quien_creo_tiket') "; 
      

      /*$datos=array("consulta"=>$consulta,"data"=>$data);
      echo json_encode($datos);
      exit();
      */


    try 
    { 
  
        if(mysqli_query( $conexion,$consulta))
        { 
           $consulta_max_id=" SELECT MAX(id) AS id FROM tikets "; 
           $resultado=mysqli_query($conexion,$consulta_max_id);
           $rw=mysqli_fetch_assoc($resultado);
           $ultimo_id=$rw["id"];

           $resultado= array('estado'=>'ok',"ultimo_id"=>$ultimo_id);  
           echo json_encode($resultado);
           exit(); 
        }  
        else 
        {   
            $resultado=array("error"=>"Al registrar el tiket"); 
            echo json_encode($resultado);
        }  
      }
      catch(Exception $e) 
      { 
        return  $e;   
      } 

 // https://netsabolivia.com/sistema/servicios/vista/ordentrabajo/db_registrar_tikets.php


?>