<?php
$usuario = "root";
$contrasena = "dilannetsawifi%#";  // en mi caso tengo contraseña pero en
                                  // casa caso introducidla aquí.
//$contrasena = "";  // en mi caso tengo contraseña pero en casa caso 
$servidor = "localhost";
$basededatos = "bd_netsa";

//$conexion = mysqli_connect( $servidor, $usuario, $contrasena );
$conexion = mysqli_connect( $servidor, $usuario, $contrasena ) or die ("No se ha podido conectar al servidor de Base de datos");

if(!$conexion )
{  
  echo json_encode("error al conectarse a la base de datos ");
  exit;
} 
$db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
if(!$db)
{   
  echo json_encode("Upps! Pues va a ser que no se ha podido conectar a la base de datos ");
  exit;
} 
if($conexion )
{ 
//  echo json_encode("La conexion tuvo exito ");
}

?>