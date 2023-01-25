$(function(){
    //Datos de prueba
    const datosCards = [
      {
        id: 1,
        imagen: 'https://i.postimg.cc/TY7LD9G0/TP-LINK-TL-WR841-N-removebg-preview.png',
        nombre: 'TP-LINK - TL-WR841N',
        descripcionCorta: 'Router inalámbrico N a 300 Mbps',
        precio: 1280,
        
        descripcionLarga: 'Rendimiento: velocidad inalámbrica de 300 Mbps ideal para aplicaciones sensibles a las interrupciones, como la transmisión de video HD Red de invitados: proporciona acceso independiente para invitados mientras protege la red doméstica IPv6: compatible con IPv6 (Protocolo de Internet versión 6) Botón WPS: cifrado de seguridad inalámbrico fácil con solo presionar el botón WPS IPTV: admite IGMP Proxy / Snooping, Bridge y Tag VLAN para optimizar la transmisión de IPTV Control de ancho de banda: asigna sus dispositivos preferidos con más ancho de banda  Controles parentales: administre cuándo y cómo los dispositivos conectados pueden acceder a Internet',
   
        
        existencia: true,
        codigoProducto: 'H410M-APRO'
      },
      {
        id: 2,
        imagen: 'https://i.postimg.cc/bYR2zPBK/f-removebg-preview.png',
        nombre: 'Teclado mecanico para gaming Hyperex Alloy origins RGB',
        descripcionCorta: 'HyperX Alloy Origins mecánico Tenkeyless para Gaming RGB',
        descripcionLarga: 'Es un teclado compacto y robusto que cuenta con interruptores mecánicos diseñados para brindarle a los gamers la mejor combinación de estilo, rendimiento y confiabilidad. Estos interruptores mecánicos tienen LEDs expuestos para lograr una iluminación impresionante con una fuerza de accionamiento y una distancia de trayectoria equilibrada para obtener un alto nivel de respuesta y exactitud. Alloy Origins está construido con un cuerpo de aluminio sólido que lo mantiene rígido y estable cuando la acción lo requiera, y te permitirá elegir entre tres niveles diferentes de inclinación. Su diseño elegante y compacto deja más espacio para el movimiento del mouse y también cuenta con un cable USB tipo C extraíble para una mejor portabilidad.',
        precio: 1280,
        existencia: true,
        codigoProducto: 'AS13C-RAWQ'
      },
      {
        id: 3,
        imagen: 'https://i.postimg.cc/Dyy40DVm/TP-LINK-TL-WR945-N-removebg-preview.png',
        nombre: 'Headset para gaming Hyperx Cloud Stringer S 7.1 CH con Mic USB',
        descripcionCorta: 'Conexión inalámbrica de 2,4Ghz y almohadillas resistentes',
        descripcionLarga: 'Los audífonos HyperX Cloud Stinger™ son audífonos con licencia oficial PS4 y son ideales para gamers que buscan confort, calidad de sonido superior y una mayor comodidad. Son livianos y cuentan con memory foam original de HyperX, lo que permite brindar un nivel de confort legendario durante sesiones maratónicas de juego. Sus orejeras giratorias de 90 grados pueden descansar cómodamente alrededor de tu cuello durante los descansos.',
        precio: 1348,
        precioOferta: 765,
        existencia: true,
        codigoProducto: '43REQ-TYI1'
      },
      {
        id: 4,
        imagen: 'https://firebasestorage.googleapis.com/v0/b/fotos-3cba1.appspot.com/o/producto4.png?alt=media&token=6c0ae77e-e48a-4b49-babc-0fc1023aa66a',
        nombre: 'Tarjeta madre Gigabyte B550M-DS3H Ryzen 3000 series Matx',
        descripcionCorta: 'Soporta AMD 3rd Gen Ryzen™ y 3rd Gen Ryzen™ con Radeon™ GPU',
        descripcionLarga: 'Las placas base de la serie GIGABYTE UD utilizan un diseño MOSFET PWM + Low RDS(on) digital puro de 5 + 3 fases para admitir las CPU AMD Ryzen ™ de tercera generación al ofrecer una precisión increíble en la entrega de energía a los componentes más sensibles a la energía y a la energía de la placa base.Además de ofrecer un rendimiento mejorado del sistema y la máxima escalabilidad del hardware.',
        precio: 2699,
        existencia: true,
        codigoProducto: 'TYUT7-FNTG'
      }
      
    ];
    //Pintamos las terjetas cuando carga el documento
    pintarCards($('.cards .contenedorCards'), datosCards);
    
    //Lanzamos la modal de detalles rapidos
    $('.card .detalleRapido').click(function(){
      let id = $(this).data('id');
      let info = datosCards.find(prod => prod.id == id);
      detallesRapidos(info);
    })
    //Sumar o restar un producto para enviar al carrito
    $(document).on('click', '.component_toCartCantidad .toCartBoton', function(){
      const boton = $(this);
      toCartCantidad(boton, boton.hasClass('mas') ? 'suma' : boton.hasClass('menos') ? 'resta' : null);
    });
    //Enviar producto a favoritos
    $(document).on('click', '.aFavs', function(){
      $(this).toggleClass('esFav');
    })
    //Cargamos el zoomIn a la imagen para verla mejor xD
    $(document).on('click', '.infoRapidaModal .zoomWatch', function(){
      var areaImagen = $(this).parent();
      zoomImg(areaImagen);
    })
    //Salir de la modal dando clic en la tecla de escape
    $(document).keydown(function(e){
      if ($('.infoRapidaModal').length && e.keyCode === 27) {
        $('.infoRapidaModal').fadeOut(function(){
          $(this).remove();
        })
      }
    })
  
    //Fx que mapea los datos para pintarlos en el contenedor
    function pintarCards(contenedorCards, datos){
      datos.map(card => {
        let clases = 'card';
        if (!card.precioOferta) clases += ' oferta';
        if (!card.existencia) clases += ' out';
        contenedorCards.append(`
          <div class="${clases}">
            <div class="innerProd">
              <div class="imgWrapper">
                <div class="detalleRapido" data-id="${card.id}">
                  <div class="icono">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
                      <path d="M39.049 39.049L56 56"></path>
                      <circle cx="27" cy="27" r="17"></circle>
                    </svg>
                  </div>
                  <p>Vista rapida</p>
                </div>
                <div class="imgProd" style="background-image: url(${card.imagen});"></div>
              </div>
              <a class="info" href="#">
                <p class="prodName">${card.nombre}</p>
                <p class="prodDesc">${card.descripcionCorta}</p>
                <div class="precios">
                  <p class="precio">${card.precioOferta || card.precio}</p>
                  <div>
                    ${card.precioOferta ? `<p class="precioOriginal">${card.precio}</p>`:''}
                    <p class="stock ${!card.existencia ? 'out' :''}">${card.existencia ? 'En existencia' : 'Fuera de stock'}</p>
                  </div>
                </div>
              </a>
              <div class="actions">
                <div class="boton alCarrito">Agregar al carrito</div>
                <div class="row-buttons">
                  <div class="checkBox comparar">
                    <input type="checkbox">
                    <div class="icon"></div>
                    <p class="checkBoxLabel">Comparar</p>
                  </div>
                  <div class="aFavs favoritos">
                    <div class="icono">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
                        <path d="M47 5c-6.5 0-12.9 4.2-15 10-2.1-5.8-8.5-10-15-10A15 15 0 0 0 2 20c0 13 11 26 30 39 19-13 30-26 30-39A15 15 0 0 0 47 5z"></path>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>`
        );
      })
    }
    //Fx que dibuja y lanza la modal de detalles rapidos
    function detallesRapidos(datos){
      const { codigoProducto, descripcionLarga, existencia, imagen, nombre, precio, precioOferta } = datos;
      if (!$('.infoRapidaModal').length) {
        $('body').append(`
          <div class="infoRapidaModal">
            <div class="closeModal"></div>
            <div class="modalContainer">
              <div class="topContent">
                <div class="imagenContainer zoom_section">
                  <div class="zoom_launcher zoomWatch" title="Ampliar imagen">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
                      <path d="M2.002 40h22v22h-22z"></path>
                      <path d="M2 28V2h60v60H36"></path>
                      <path d="M30 34l22-22m-16 0h16v16"></path>
                    </svg>
                  </div>
                  <div class="zoom_imgOrigin wrapperImg">
                    <div class="zoom_imgSource imagen" style="background-image: url(${imagen});"></div>
                  </div>
                </div>
                <div class="texto">
                  <div class="wrapper">
                    <p class="nombre">${nombre}</p>
                    <div class="precios">
                      <p class="precio">${precioOferta || precio}</p>
                      ${precioOferta ? `<p class="precioOferta">${precio}</p>` :''}
                    </div>
                    <p class="stock ${existencia ?'':'out'} bold">${existencia ? 'Disponible en tienda y listo para enviar' : 'Fuera de stock'}</p>
                    <p class="codigo"><span class="bold">Código Producto: </span>${codigoProducto}</p>
                    <div class="actions">
                      <div class="component_toCartCantidad ${!existencia ? 'disabled':''}">
                        <div class="toCartBoton menos disabled"></div>
                        <div class="toCartCantidad">1</div>
                        <div class="toCartBoton mas"></div>
                      </div>
                      <div class="botonTextoIcono ${!existencia ? 'disabled' : ''}">
                        <label class="labelBoton">Agregar al carrito</label>
                        <div class="icono">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
                            <path d="M2 6h10l10 40h32l8-24H16"></path>
                            <circle cx="23" cy="54" r="4"></circle>
                            <circle cx="49" cy="54" r="4"></circle>
                          </svg>
                        </div>
                      </div>
                      <div class="aFavs botonIcono">
                        <div class="icono">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
                            <path d="M47 5c-6.5 0-12.9 4.2-15 10-2.1-5.8-8.5-10-15-10A15 15 0 0 0 2 20c0 13 11 26 30 39 19-13 30-26 30-39A15 15 0 0 0 47 5z"></path>
                          </svg>
                        </div>
                      </div>
                    </div>
                    <p class="descripcion">${descripcionLarga}</p>
                    <a class="boton" href="#">Ver detalles completos</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        `);
      }
      $('.infoRapidaModal').fadeIn().css('display', 'flex');
      $('.infoRapidaModal .closeModal').click(function(){
        $(this).parent().fadeOut(function(){
          $(this).remove();
        })
      })
    }
    //Fx que actualiza la cantidad de articulos que queremos enviar al carrito
    function toCartCantidad(boton, operacion){
      const container = boton.parents('.component_toCartCantidad');
      const numero = container.find('.toCartCantidad');
      let tipoAnim = 'normal';
      if (operacion == 'resta') {
        if (parseInt(numero.text()) == 1) return false;
        if (parseInt(numero.text() - 1) == 1) {
          boton.addClass('disabled');
        }
        tipoAnim = 'reverse';
        numero.text(parseInt(numero.text()) - 1);
      } else if (operacion == 'suma') {
        boton.siblings('.toCartBoton.disabled').removeClass('disabled');
        numero.text(parseInt(numero.text()) + 1);
      } else {
        console.log('El tipo de operacion (suma / resta) es obligatorio');
        return false;
      }
      numero.addClass(tipoAnim == 'reverse' ? 'animacion-reverse' : 'animacion');
      numero.one('animationend', function () {
        numero.removeClass(tipoAnim == 'reverse' ? 'animacion-reverse' : 'animacion');
      });
    }
    //Fx que maneja el zoomIn en la imagen
    function zoomImg(zoomArea, escala = 3){
      if ($(window).width() > 768) {
        zoomArea.find('.zoom_launcher').fadeOut('fast');
        const imagen = zoomArea.find('.zoom_imgOrigin');
        const urlImagen = zoomArea.find('.zoom_imgSource')[0].style.backgroundImage;
        const dimensiones = {
          imagen: {width: imagen.outerWidth(), height: imagen.outerHeight()},
          lupa: {width: imagen.outerWidth() / escala, height: imagen.outerHeight() / escala}
        };
        const estiloInicial = {
          backgroundImage: urlImagen,
          backgroundSize: parseInt(imagen.css('padding')) ? `calc(100% - (${(parseInt(imagen.css('padding')) / 2) * escala}px))` : 'contain',
          transform: `scale(${escala}) translateX(${dimensiones.imagen.width / escala}px) translateY(${dimensiones.imagen.height / escala}px)`
        };
        imagen.append(`<div class="zoom_lupa"></div>`);
        zoomArea.append(`<div class="zoom_imgAlt zoomImg"><div class="zoom"></div></div>`);
        const scaleArea = zoomArea.children('.zoom_imgAlt');
        const zoom = scaleArea.children('.zoom');
        const lupa = imagen.children('.zoom_lupa');
        scaleArea.fadeIn();
        zoom.css(estiloInicial);
        lupa.css(dimensiones.lupa);
        imagen.mousemove(function(e){
          let movimientoLupa = {x: e.pageX, y: e.pageY};
          let centroImagen = {
            x: (imagen.offset().left + (dimensiones.imagen.width / 2)),
            y: (imagen.offset().top + (dimensiones.imagen.height / 2))
          }
          let posicionLupa = {
            x: centroImagen.x - movimientoLupa.x,
            y: centroImagen.y - movimientoLupa.y
          }
          let transformLupa = {
            x: (movimientoLupa.x - (dimensiones.lupa.width / 2)) - imagen.offset().left,
            y: (movimientoLupa.y - (dimensiones.lupa.height / 2)) - imagen.offset().top
          }
          var transformZoom = (`scale(${escala}) translateX(${posicionLupa.x}px) translateY(${posicionLupa.y}px)`);
          zoom.css('transform', transformZoom);
          lupa.css('transform', `translateX(${transformLupa.x}px) translateY(${transformLupa.y}px)`);
        });
        imagen.mouseout(function(){
          lupa.remove();
          zoomArea.find('.zoom_launcher').fadeIn('fast');
          scaleArea.fadeOut('fast', function(){
            scaleArea.remove();
          })
        })
      } else {
        console.warn('Solo disponible para pc');
      }
    }
  })