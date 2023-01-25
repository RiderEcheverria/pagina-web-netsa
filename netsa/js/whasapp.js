    // Related post carousel
    $(".related-slider").owlCarousel({
        autoplay: true,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            '<i class="fa fa-angle-right" aria-hidden="true"></i>'
        ],
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            }
        }
    });
    
    function isMobile() {
        if (sessionStorage.desktop)
            return false;
        else if (localStorage.mobile)
            return true;
        var mobile = ['iphone', 'ipad', 'android', 'blackberry', 'nokia', 'opera mini', 'windows mobile', 'windows phone', 'iemobile'];
        for (var i in mobile)
            if (navigator.userAgent.toLowerCase().indexOf(mobile[i].toLowerCase()) > 0) return true;
        return false;
    }
    
    const formularios = document.querySelector('#formularios');
    const buttonSubmit = document.querySelector('#submit');
    const urlDesktop = 'https://api.whatsapp.com/';
    const urlMobile = 'whatsapp://';
    const telefono = '+591 71378667';
    
    formularios.addEventListener('submit', (event) => {
        event.preventDefault()
        buttonSubmit.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i>'
        buttonSubmit.disabled = true
        setTimeout(() => {
            let nombre = document.querySelector('#nombre').value
            let email = document.querySelector('#email').value
            let numero = document.querySelector('#numero').value
            let fecha = document.querySelector('#fecha').value
            let servicio = document.querySelector('#servicio').value
            let plan = document.querySelector('#plan').value
            let ubicacion = document.querySelector('#ubicacion').value
            
            let mensaje = 'send?phone=' + telefono + 
            '&text=*_Formulario de contacto NETSA SRL._*%0A*Nombre Completo*%0A' + nombre + 
            '%0A*Correo Electrónico*%0A' + email + 
            '%0A*Numero de Celular*%0A' + numero + 
            '%0A*Fecha de Reserva*%0A' + fecha + 
            '%0A*Tipo de Plan*%0A' + servicio + 
            '%0A*Plan Seleccionado*%0A' + plan + 
            '%0A*Direccion de Domicilio*%0A' + ubicacion +''
           
            
             
            
            
            
            if(isMobile()) {
                window.open(urlMobile + mensaje, '_blank')
            }else{
                window.open(urlDesktop + mensaje, '_blank')
            }
            buttonSubmit.innerHTML = '<i class="fab fa-whatsapp"></i> Enviar WhatsApp'
            buttonSubmit.disabled = false
        }, 3000);
    });

      