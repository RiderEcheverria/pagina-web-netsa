<?php

 require_once './conexion.php';        
session_start();
$message = '';     
if (isset($_POST['btn_archivo']) && $_POST['btn_archivo'] == 'Upload')
{  
  if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK)
  {  
    

    $ultimo_id=$_POST['ultimo_id'];
    date_default_timezone_set('America/La_Paz'); 
    $fileTmpPath = $_FILES['archivo']['tmp_name'];
    $fileName = $_FILES['archivo']['name'];
    $fileSize = $_FILES['archivo']['size'];
    $fileType = $_FILES['archivo']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps)); 
    $tiempo=date("YmdHis");
    $newFileName =$fileName.'-'.$tiempo. '.' . $fileExtension;
      
  $consulta =" update tikets  set archivo='$newFileName'  where id=$ultimo_id ";
    $resultado = mysqli_query( $conexion,$consulta) or 
        die("Algo ha ido mal en la consulta a la base de tabla de tikets");
// gabriela.jfif

    $allowedfileExtensions =     
    array('jpg', 'gif','png','jpeg','doc','docx','pdf','jfif','jpeg'); 

    if (in_array($fileExtension, $allowedfileExtensions))
    { 
      $uploadFileDir = './uploaded_files/';
      $dest_path = $uploadFileDir . $newFileName;

      if(move_uploaded_file($fileTmpPath, $dest_path)) 
      {
        $message ='File is successfully uploaded.';
      }
      else 
      {
        $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
      }
    }
    else
    {
      $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
    }
  }
  else
  {
    $message = 'There is some error in the file upload. Please check the following error.<br>';
    $message .= 'Error:' . $_FILES['archivo']['error'];
  }
}

$_SESSION['message'] = $message;


// header("Location: https://netsabolivia.com/sistema/servicios/tiket.html");
// http://localhost/pagina/reclamos.html
// header("Location: http://localhost/pagina/reclamos.html");
// https://netsabolivia.com/sistema/rider/pagina/reclamos.html 

// header("Location:https://netsabolivia.com/sistema/rider/pagina/reclamos.html");

header("Location:https://netsabolivia.com/sistema/pagina/reclamos.html");




