<?php 	
	require_once './conexion.php';	   
	
function nro_mes_a_letras($nro_mes)
{ 
   $xcadena = "";
   if (trim($nro_mes) != "") {
            switch ($nro_mes) {
                case 1:
                        $xcadena.= "ENERO";
                    break;
                case 2:                   
                        $xcadena.= "FEBRERO";          
                    break;
				case 3:                    
                        $xcadena.= "MARZO";
                    break;
				case 4:                   
                        $xcadena.= "ABRIL";
                    break;
				case 5:                   
                        $xcadena.= "MAYO";
                    break;
				case 6:
                   		$xcadena.= "JUNIO";
                    break;
				case 7:
                    	$xcadena.= "JULIO";
                    break;
				case 8:
                    	$xcadena.= "AGOSTO";
                    break;
				case 9:
                    	$xcadena.= "SEPTIEMBRE";
                    break;
				case 10:
                    	$xcadena.= "OCTUBRE";
                    break;
				case 11:
                    	$xcadena.= "NOVIEMBRE";
                    break;
				case 12:
                    	$xcadena.= "DICIEMBRE";
                    break;
            } // endswitch ($xz)
        } // ENDIF (trim($xaux) != "")
	return $xcadena; 
}	
	$data=$_POST;
    $datadet = array(); 
	$consulta_historial="";
	$consulta_pagados="";
	$consulta_debe="";
	$sql=""; 
	$rw=null;
	$CodMes=0;
	$saldo=0;
    $debe=0;
    $haber=0;
    $debeG=0;
    $haberG=0;
    $nro=0; 
	
	try
    {	   
	    $filtro=$data['id']; 
        switch ($data['tipo']) 
        {  
          case '1':
		  
          $consulta_historial="SELECT c.fecha_contr as fecha_cxc_m,'INSTALACION' as Mvto,c.id_contr as id_men,cd.total_det as total_men,1 as tipo,'INSTALACION DE WIFI'as nomb_plan,s.nomb_sucu,'INICIO' as CodMes,g.nomb_gest,c.id_contr 
          from contratocab c,sucursal s,gestion g, plan p, contratodet cd, catalogo ca 

          where c.id_contr=cd.id_contr and c.id_clie=$filtro and cd.id_cata=ca.id_cata and c.id_gest=g.id_gest and c.id_sucu=s.id_sucu and c.id_plan=p.id_plan and ca.tipo_cata=2 and c.ingre_contr=1

  union all  

  SELECT fecha_men as fecha_cxc_m, 'MENS' as Mvto ,id_men,neto_men as total_men, 1 as tipo ,p.nomb_plan, s.nomb_sucu,m.CodMes,g.nomb_gest,m.id_contr 
  from mensualidad m, plan p, sucursal s,contratocab x, gestion g 

  WHERE m.id_plan=p.id_plan and m.id_contr=x.id_contr and x.id_clie=$filtro and m.esta_men=1 and m.id_sucu = s.id_sucu and m.id_gest=g.id_gest 

  union all  

  SELECT c.fecha_cort as fecha,'Corte' as Mvto,c.id_cort,0 as total_men, 1 as tipo, CONCAT('','CORTE DE : ',p.nomb_plan) as nomb,s.nomb_sucu, c.mes,g.nomb_gest,ct.id_contr 

  from corte c, contratocab ct, plan p, sucursal s, gestion g WHERE c.id_contr=ct.id_contr  and ct.id_plan=p.id_plan and ct.id_clie=$filtro and c.id_sucu=s.id_sucu and c.id_gest=g.id_gest and c.esta_cort=1 

  union all 

SELECT c.fecha_cxc_m as fecha,'ABON-MENS' as Mvto,id_det,total_det, 2 as tipo,CONCAT('',glosa_cxc_m,'Pago') as nomb,s.nomb_sucu, md.mes,g.nomb_gest,md.id_contr 

from cxc_mensualidaddet md, cxc_mensualidadcab c,contratocab x, sucursal s, gestion g 

WHERE c.id_cxc_m=md.id_cxc_m and x.id_contr=md.id_contr and x.id_clie=$filtro and c.id_sucu=s.id_sucu and c.esta_cxc_m=1 and c.id_gest=g.id_gest and c.esta_cxc_m=1 

union all

  SELECT r.fecha_rea as fecha_cxc_m,'Reactivacion' as Mvto,r.id_cort,0 as total_men, 2 as tipo,  CONCAT('','REACTIVAR DE : ',p.nomb_plan) as nomb,s.nomb_sucu,r.mes,g.nomb_gest,c.id_contr from reactivacion r, plan p, sucursal s,gestion g,corte c,contratocab ct where r.id_plan=p.id_plan and ct.id_clie=$filtro and r.id_sucu=s.id_sucu  and r.id_gest=g.id_gest and r.id_cort=c.id_cort and c.id_contr=ct.id_contr and r.esta_rea=2
   ORDER BY fecha_cxc_m "; 
	
	$resultado = mysqli_query( $conexion,$consulta_historial) or 
			     die("Algo ha ido mal en la consulta a la base de seleccionando detalle-1"); 
				 
		    while($rw=mysqli_fetch_assoc($resultado))
            {	  	
				  $nro=$nro+1;
                  if($rw['tipo']==1)
                  {
                    $debeG= $rw['total_men']-$haberG;
                    $debe= $rw['total_men'];
                    $haber=0;
                    $saldo+= $debe;
                  }
                  else
                  {  
                    $haberG= $debeG - $rw['total_men'];
                    $haber= $rw['total_men'];
                    $saldo-= $haber;
                    $debe=0;
                  } 
				  
                $mes=nro_mes_a_letras($rw['CodMes']);
				
				$datadet []= 
                array(
                      'id'=>$rw['id_men'],
                      'fecha'=>$rw['fecha_cxc_m'],
                      'Mvto'=>$rw['Mvto'],
                      'desc'=>$rw['nomb_plan'].", del mes de ".$mes." / ".$rw['nomb_gest'],//GLOSA
                      'nomb_sucu'=>$rw['nomb_sucu'],
                      'id_contr'=>$rw['id_contr'],
                      'debe'=>$debe,
                      'haber'=>$haber,
                      'saldo'=>$saldo,
                      'nro'=>$nro,
                     // 'opciones'=> 'botones' 
                    );
				// */				
			}//while($rw=mysqli_fetch_assoc($resultado))
			
            break;
            case '2': 
            $consulta_pagados="SELECT m.id_men,cx.fecha_cxc_m as fecha_men,c.id_contr,p.nomb_plan,m.id_gest,m.CodMes,m.total_men,m.desc_men,m.neto_men,z.nomb_zona, cx.id_men as cod_men,cx.total, cx.id_usr,cx.nomb_usr,cx.glosa_cxc_m,
            cx.nomb_caja,g.nomb_gest,cx.id_cxc_m,cx.id_det as  id_men_det 
            from plan p,zona z,contratocab c,gestion g, mensualidad m
                LEFT JOIN(SELECT cx.id_cxc_m,cd.id_men,cd.id_det, SUM(cd.total_det) as total, u.id_usr,u.nomb_usr,cx.glosa_cxc_m,c.nomb_caja,cx.fecha_cxc_m 
                 FROM cxc_mensualidadcab cx,cxc_mensualidaddet cd,usuarios u,cajas c  
                 where  cx.id_caja=c.id_caja and cx.id_cxc_m=cd.id_cxc_m and cx.id_usr=u.id_usr and cx.esta_cxc_m=1 GROUP BY cd.id_men) cx on cx.id_men=m.id_men 
                WHERE m.id_gest=g.id_gest and p.id_plan=m.id_plan and z.id_zona=c.id_zona and c.id_contr=m.id_contr and c.id_clie=$filtro and m.esta_men=1  
                ORDER BY m.id_gest,m.CodMes";
				
			
			$resultado = mysqli_query( $conexion,$consulta_pagados) or 
			    die("Algo ha ido mal en la consulta a la base de seleccionando detalle-1"); 
			
            $neto=0;
            $total=0;
            $tot=0;
            $nro=0; 			
			while($rw=mysqli_fetch_assoc($resultado))
			{  
			   $nro=$nro+1;
               $neto= $rw['neto_men'];
               $total=$rw['total'];
			   
               $mes=nro_mes_a_letras($rw['CodMes']); 
			  if($total==null)
              { 
                $total=0;
              }
			  
			  if($neto <= $total)
              {  
                $tot= $neto - $total;
                $saldo +=$tot; 
                $datadet[] = 
                array
                (   
                    'id'=>$rw['id_men'],
                    'id_contr' => $rw['id_contr'],
                    'fecha'=>$rw['fecha_men'],
                    'mes'=>$mes.", ".$rw['nomb_gest'],
                    'nomb_plan'=>$rw['nomb_plan'],
                    'nomb_caja'=>$rw['nomb_caja'],
                    'nomb_usr'=>$rw['nomb_usr'],
                    'glosa'=>$rw['glosa_cxc_m'],
                    'debe'=>$neto,
                    'haber'=>$total,
                    'saldo'=>$saldo,      
                    'nro'=>$nro, 
					'id_cxc_m'=>$rw['id_cxc_m'],
                 );
			   }// if($neto <= $total) 
			 }// while($rw=mysqli_fetch_assoc($resultado)) 
			
			 
            break;
            case '3':
                  $sql=" ";
                  if( $data['tipoe']==2)
                  {  
                    $sql="UNION ALL
                    SELECT m.id_men,m.fecha_men,c.id_contr,m.glosa_men as 'nomb_plan',m.id_gest,m.CodMes,m.total_men,m.desc_men,m.neto_men,z.nomb_zona, cx.id_men as cod_men,cx.total, u.id_usr,u.nomb_usr,g.nomb_gest from zona z,contratocab c,usuarios u,gestion g, mensualidad m
                    LEFT JOIN(SELECT cd.id_men, SUM(cd.total_det) as total FROM cxc_mensualidadcab cx,cxc_mensualidaddet cd where cx.id_cxc_m=cd.id_cxc_m and cx.esta_cxc_m=1 GROUP BY cd.id_men) cx on cx.id_men=m.id_men 
                    WHERE m.id_gest=g.id_gest  and z.id_zona=c.id_zona and c.id_contr=m.id_contr and c.id_clie=$filtro and m.esta_men=1 and m.id_usr=u.id_usr";
                  } 
              $consulta_debe=" SELECT m.id_men,m.fecha_men,c.id_contr,p.nomb_plan,m.id_gest,m.CodMes,m.total_men,m.desc_men,m.neto_men,z.nomb_zona, cx.id_men as cod_men,cx.total, u.id_usr,u.nomb_usr,g.nomb_gest 
              from plan p,zona z,contratocab c,usuarios u,gestion g, mensualidad m
                LEFT JOIN(SELECT cd.id_men, SUM(cd.total_det) as total FROM cxc_mensualidadcab cx,cxc_mensualidaddet cd where cx.id_cxc_m=cd.id_cxc_m and cx.esta_cxc_m=1 GROUP BY cd.id_men) cx on cx.id_men=m.id_men 
                WHERE m.id_gest=g.id_gest and p.id_plan=m.id_plan and 
                      z.id_zona=c.id_zona and c.id_contr=m.id_contr and 
                      c.id_clie=$filtro and  
                      m.esta_men=1 and m.id_usr=u.id_usr ".                      
                $sql ." ORDER BY id_gest,CodMes "; 
				$resultado = mysqli_query( $conexion,$consulta_debe) or 
			    die("Algo ha ido mal en la consulta a la base de seleccionando detalle-1"); 
				
                $neto=0;
                $total=0;
                $tot=0;$nro=0;
				while($rw=mysqli_fetch_assoc($resultado))
				{  
					$neto= $rw['neto_men'];
                    $total=$rw['total'];
                    if($total==null)
                    {
                      $total=0;
                    }
					
                    $mes=nro_mes_a_letras($rw['CodMes']);
					
					if($neto > $total)
                    {  $nro=$nro+1;
                      $tot= $neto - $total;
                      $saldo +=$tot;
                      $datadet[] = array( 
                        'id'=>$rw['id_men'],
                        'id_contr' => $rw['id_contr'],
                        'id_gest'=> $rw['id_gest'],
                        'fecha'=>$rw['fecha_men'],
                        'mes'=>$mes.", ".$rw['nomb_gest'], 
                        'nomb_plan'=>$rw['nomb_plan'],
                        'nomb_usr'=>$rw['nomb_usr'],
                        'debe'=>$neto,
                        'haber'=>$total,
                        'saldo'=>$saldo,               
                        'nro'=>$nro,
                        'glosa'=>'',
                        'nomb_caja'=>''       
                      );
                    }
				}// while($rw=mysqli_fetch_assoc($resultado)) 				
              break;
            default : return false;
          }
      }
      catch (Exception $e)
      { 
        echo json_encode('Excepción capturada: ',  $e->getMessage(),"\n");
      }		  
  echo  json_encode($datadet);
 exit;
 
?>