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
    
    const formulario = document.querySelector('#formulario');
    const buttonSubmit = document.querySelector('#submit');
    const urlDesktop = 'https://api.whatsapp.com/';
    const urlMobile = 'whatsapp://';
    const telefono = '+591 71378667';
    
    formulario.addEventListener('submit', (event) => {
        event.preventDefault()
        buttonSubmit.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i>'
        buttonSubmit.disabled = true
        setTimeout(() => {
            let nombre = document.querySelector('#nombre').value
            let apellidos = document.querySelector('#apellidos').value
            let email = document.querySelector('#email').value
            let mensaje = 'send?phone=' + telefono + '&text=*_Formulario de contacto de WhatsApp_*%0A*¿Cual es tu nombre?*%0A' + nombre + '%0A*¿Cuáles son tus apellidos?*%0A' + apellidos + '%0A*¿Cuál es tu correo electrónico?*%0A' + email + ''
            if(isMobile()) {
                window.open(urlMobile + mensaje, '_blank')
            }else{
                window.open(urlDesktop + mensaje, '_blank')
            }
            buttonSubmit.innerHTML = '<i class="fab fa-whatsapp"></i> Enviar WhatsApp'
            buttonSubmit.disabled = false
        }, 3000);
    });

      