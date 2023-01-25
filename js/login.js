

  function isObjEmpty(obj) 
  {
    for (var prop in obj) 
    {
      if (obj.hasOwnProperty(prop)) return false;
    }
  }

function recuperar_usur_online()
{

  var  url ="usuario_online.php";
    $.ajax
    ({   
       type: "POST",   
       dataType: 'json',                         
       "url":url,      
       success: function (usr_online)     
       {  
          console.log("login.js/recuperar_usur_online()/usr_online:",usr_online);          
          if(usr_online!=null && usr_online!="undefined")
          {
            if(isObjEmpty(usr_online)==false )
            {  
              $("a.usuario").text(usr_online.alias);
              localStorage.setItem('usuario_cliente',JSON.stringify (usr_online)); 
              var salir='<a href="logout.php">Salir</a>';
              $(".social").append(salir);
              return; 
            }
          } 
          var _url=$.trim(location.href).toLowerCase();  
          console.log("recuperar_usur_online()/_url",_url);
          var _includes=_url.includes("iniciar-session.html"); 
          if(!_includes)
          {   
            if( _url.includes("reclamos.html") || 
                _url.includes("misfacturas.html"))
            {
              location.replace("iniciar-session.html");      
            }
          } 
       },
       error: function(error)
       { 
         console.log("login.js/usr_validado/ouput/error",error);
       }
    });
}
$(document).ready(function()
{ 
    recuperar_usur_online(); 
});