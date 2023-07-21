<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Jet-Filter C.A</title>
        <link rel="shortcut icon" href="/img_jetfilter/icon/jf.ico" type="image/x-icon">
        <link rel="stylesheet" href="{{asset('css/jetfilter/estilos.css')}}">
        <link rel="stylesheet" href="{{asset('css/jetfilter/normalize.css')}}">

        <script type="text/javascript" src="{{ asset( 'js/jquery.min.js' ) }}"></script>
        <script type="text/javascript" src="{{ asset( 'js/jquery.ez-plus.js' ) }}" ></script>
    </head>
    <body>
        <header class="hero">
            <nav class="nav container" id ="menu_s">
                <div class="nav__logo">
                    <img src="{{asset('img_jetfilter/logo/logojf.png')}}" class="img_log">
                </div>

                <ul class="nav__link nav__link--menu">
                    <li class="nav__items ">
                        <a href="#" class="nav__links">Inicio</a>
                    </li>
                    <li class="nav__items ">
                        <a href="#mi_vision" class="nav__links">Misión y Visión</a>
                    </li>
                    <li class="nav__items">
                        <a href="#r_historia" class="nav__links">Reseña Histórica</a>
                    </li>
                    <li class="nav__items">
                        <a href="#calidad" class="nav__links">Calidad</a>
                    </li>
                    <li class="nav__items">
                        <a href="#certificado" class="nav__links">Certificados</a>
                    </li>
                    <li class="nav__items">
                        <a href="/jetfilter/gestion" class="nav__links">Gestión</a>
                    </li>

                    <img src="{{asset('img_jetfilter/svg/close.svg')}}" class="nav__close">
                    <span class="indicador" id="indicador"></span>
                </ul>
                <div class="nav__menu">
                    <img src="{{asset('img_jetfilter/svg/menu.svg')}}" class="nav__img">
                </div>
            </nav>

            <section class="hero__container container">
                <h1 class="hero__title">FABRICANTES  DE FILTROS</h1>
    
                <a href="{{route('index')}}" class="cta">ir a Webfiltros </a>
            </section>
        </header>

        <div class="wave" style="height: 200px;overflow: hidden;"><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;" class="">
            <path d="M0.00,49.98 C150.00,150.00 349.20,-50.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path>
        </svg></div>

    <main class="main">
        <a name="mi_vision">
            <section class="contenedor vision-mision">
                <div class="contenedor-vision-mision">
                    <img src="img_jetfilter/ilustracion2.svg" alt="" class="imagen-about-us">
                    <div class="contenido-textos">
                        <h3><span><img src="/img_jetfilter/ilustracion.svg" class=""></span>MISIÓN</h3>
                        <p>Fabricar filtros para aceite, aire, combustible y refrigerante con el propósito de satisfacer las necesidades y expectativas
                            de nuestros clientes en los sectores automotor, agrícola, industrial y marino. Manteniendo un sistema de gestión integral 
                            cuya filosofía es la mejora continua que permite poseer un personal capacitado y motivado que trabaja en equipo.</p> 
                        <p>De esta manera, se obtienen dividendos suficientes que nos garantizan  la permanencia  en  el tiempo como fuente de 
                            trabajo y factor de desarrollo de nuestra región y nuestro país.</p> 
                        <h3><span><img src="/img_jetfilter/ilustracion.svg" class=""></span>VISIÓN</h3>   
                        <p>Ser reconocida por sus trabajadores, proveedores, clientes, usuarios finales, competidores,  nuestro país y Latinoamérica 
                            como una empresa altamente tecnificada, capaz de producir productos y servicios de alta calidad con una productividad de clase mundial. </p> 
                        <p>Y podamos ser ejemplo y referentes en el respeto al ambiente, el bienestar brindado a nuestros trabajadores y a la sociedad en general.</p>
                    </div>
                </div>
            </section>
        </a>
    </main>

    <div class="seccion" id="2">
        <a name="r_historia" >
            <section class="testimony">
                <div class="testimony__container container">
                    <img src="/img_jetfilter/svg/leftarrow.svg" class="testimony__arrow" id="before">
                    <section class="testimony__body testimony__body--show" data-id="1">
                        <div class="testimony__texts">
                            <h2 class="subtitle" id="">RESEÑA HISTÓRICA. <br> <span class="testimony__course">fundada en Caracas <br> el 08 de octubre de 1965</span></h2>
                            <p class="about__paragraph">Por tres jóvenes empresarios venezolanos, teniendo como ubicación "La Pastora" Caracas Venezuela con un espacio físico de 100 metros cuadrados.
                                Luego de dos años y debido a su notable crecimiento, pasó a radicarse en el Edificio "LEMAR" en La Yaguara-Caracas con un espacio físico de 400 metros cuadrados.
                            </p><br>
                            <p class="about__paragraph">Pasados cinco años de importante labor y crecimiento presentado, se traslada al Conjunto Industrial "Bernardino Mosquera" - Caracas,
                                 con un espacio físico de 1.200 metros cuadrados.</p>
                        </div>
        
                        <figure class="testimony__picture">
                            <img src="/img_jetfilter/pro/AIRE.jpg" class="testimony__img">
                        </figure>
                    </section>

                    <section class="testimony__body" data-id="2">
                        <div class="testimony__texts">
                            <h2 class="subtitle">RESEÑA HISTÓRICA.<br> <span class="testimony__course">Año de 1986</span></h2>
                            <p class="about__paragraph">Al paso de los años su producción siguió incrementándose, lo que hizo cambiar 
                                nuevamente de sede hasta el Conglomerado Industrial de Corpoindustria ubicado en Tinaquillo - Edo. Cojedes. 
                                </p><br>
                                 <p class="about__paragraph"> Desde su estabilización en esta ciudad Cojedeña en el año de 1986 hemos experimentado un crecimiento más significativo,
                                 se han reestructurado sus departamentos y descentralizado sus funciones.</p>
                           
                        </div>
        
                        <figure class="testimony__picture">
                            <img src="/img_jetfilter/pro/fachada.jpg" class="testimony__img">
                        </figure>
                    </section>

                    <section class="testimony__body" data-id="3">
                        <div class="testimony__texts">
                            <h2 class="subtitle">RESEÑA HISTÓRICA.<br> <span class="testimony__course">En la actualidad.</span></h2>
                            <p class="about__paragraph">Gracias a la labor de nuestro motivado y preciado capital humano se elaboran más de 700 modelos
                                 de filtros que cumplen con las más exigentes normas de calidad, satisfaciendo una parte importante de la demanda de filtros
                                  generada por el parque automotriz venezolano.</p><br>
                                 
                        </div>
        
                        <figure class="testimony__picture">
                            <img src="/img_jetfilter/pro/C_humano.jpg" class="testimony__img">
                        </figure>
                    </section>
        
                    <section class="testimony__body" data-id="4">
                        <div class="testimony__texts">
                            <h2 class="subtitle">RESEÑA HISTÓRICA.<br> <span class="testimony__course">MORFOLOGÍA DEL NOMBRE DE NUESTRA EMPRESA:</span></h2>
                            <p class="about__paragraph"><b>JET-FILTER;</b>  es un juego de palabras en inglés que en su traducción al español quiere decir, <b>Jet= surtidor</b> y <b>Filter= filtros</b></p><br>
                        </div>
        
                        <figure class="testimony__picture">
                            <img src="/img_jetfilter/pro/jf.jpg" class="testimony__img">
                        </figure>
                    </section>
                    <section class="testimony__body" data-id="5">
                        <div class="testimony__texts">
                            <h2 class="subtitle">RESEÑA HISTÓRICA.<br> <span class="testimony__course">MORFOLOGÍA DEL NOMBRE DE NUESTRA MARCA:</span></h2>
                            <p class="about__paragraph"><b>WEB FILTROS;</b>  es un juego de palabras en inglés y español donde <b>WEB</b> significa <b>tela, tejido, o fibras entrelazadas el
                                 cual representa un medio filtrante y la palabra filtro en español.</b></p><br>
                        </div>
                
                        <figure class="testimony__picture">
                            <img src="/img_jetfilter/pro/web.jpg" class="testimony__img">
                        </figure>
                    </section>
                
                    <img src="/img_jetfilter/svg/rightarrow.svg" class="testimony__arrow" id="next">
                </div>
            </section>
        </a>
    </div>

    <div class="seccion" id="3">
        <a name ="calidad">
            <section class="questions container">
                <h2 class="subtitle">Calidad</h2>
                <section class="questions__container">
                    <article class="questions__padding">
                        <div class="questions__answer">
                            <h3 class="questions__title">POLÍTICAS DE CALIDAD
                                <span class="questions__arrow">
                                    <img src="/img_jetfilter/svg/arrow.svg" class="questions__img">
                                </span>
                            </h3>
                            <p class="questions__show"><b> Jet-Filter, C.A.</b> tiene como política de calidad, fabricar filtros de aceite, aire, refrigerante y combustible, 
                                <b>buscando la excelencia basados en los requisitos existentes en nuestro sistema de gestión de calidad</b> y trabajar siempre en función del cliente,
                                ya que es a través del cliente  que la empresa subsiste.  Para ello se tienen como principios básicos:
                                <br><br>
                                1.- Hacer las cosas bien desde el principio.<br><br>
                                2.- Satisfacer continuamente a nuestros clientes, superando 
                                sus expectativas de calidad a través del oportuno suministro de 
                                productos, asistencia técnica y mejor relación precio / valor.<br><br>
                                3.- Capacitar a los trabajadores para que desarrollen habilidades y conocimientos, 
                                que le permitan, a través del camino de la productividad, mejorar su calidad de vida 
                                y ser parte del proceso integral de la organización y del país.<br><br>
                                4.- Mejora continúa de los procesos y productos y cumplir con toda la normativa legal para la protección del ambiente y nuestros trabajadores.<br><br>
                            </p>
                        </div>
                    </article>

                    <article class="questions__padding">
                        <div class="questions__answer">
                            <h3 class="questions__title">OBJETIVOS DE LA CALIDAD
                                <span class="questions__arrow">
                                    <img src="/img_jetfilter/svg/arrow.svg" class="questions__img">
                                </span>
                            </h3>
                            <p class="questions__show">
                                1.- Mantener la participación planificada en el mercado cumpliendo con las exigencias del mismo.<br><br>
                                2.- Elaborar productos de acuerdo  al  plan anual de ventas con la finalidad de realizar entregas a tiempo de las unidades solicitadas por  los clientes.<br><br>
                                3.- Mejorar continuamente los productos y procesos  con el objetivo de lograr  mayor productividad para  satisfacer y exceder las necesidades y expectativas de los clientes.<br><br>
                                4.- Capacitar al personal de acuerdo al plan de formación establecido anualmente en la organización.<br><br>
                            </p>
                        </div>
                    </article>

                    <article class="questions__padding">
                        <div class="questions__answer">
                            <h3 class="questions__title">GARANTÍA
                                <span class="questions__arrow">
                                    <img src="/img_jetfilter/svg/arrow.svg" class="questions__img">
                                </span>
                            </h3>
                            <p class="questions__show">
                                <b> Todos los filtros WEB están garantizados contra cualquier defecto de material o mano de obra. La garantía abarca todo vehículo o maquinaria que se le haya instalado un filtro WEB
                                     según el manual de especificaciones y que lleve un adecuado uso y mantenimiento recomendado por los fabricantes del equipo. </b> <br><br>
                                     Si se encuentra un filtro WEB con defecto de material o fabricación, el mismo se reemplazará por un filtro nuevo.<br><br>
                                     En caso de un daño al motor atribuible en forma directa a la falla de un filtro WEB nuevo que ha sido instalado en forma correcta, se pagará la reparación a una
                                      condición equivalente a la que existía antes de la falla. El daño deberá ser comprobado por un técnico autorizado por filtros WEB antes de cualquier reparación del motor.<br><br>
                                      La garantía no cubre condiciones resultantes del uso impropio, negligente o incumplimiento de las instrucciones de instalación de un filtro.<br><br>
                                      Las garantías para automóviles y equipos nuevos permanecen en vigencia cuando se utilizan filtros WEB, siguiendo las mismas recomendaciones del fabricante en cuanto al tiempo de uso o el kilometraje.<br><br>
                                      Los filtros WEB deben estar almacenados en un lugar apropiado considerándose como tal cualquier local que los resguarde de los efectos del sol, del agua, del polvo, caídas, golpes entre otros. Filtros WEB no asume 
                                      responsabilidad por daños o desperfectos en el funcionamiento a consecuencia de un mal almacenamiento o manipulación de los filtros.<br><br>
                                      Esta garantía podrá hacerse valida en cualquiera de los fabricantes o distribuidores autorizados. <br><br>
                            </p>
                        </div>
                    </article>
                </section>
            </section>
        </a>
    </div>

    <div class="seccion" id="4">
        <a name="certificado" >
            <div class="galeria"></br>
                <h1>CERTIFICADOS DE CALIDAD</h1>
                <div class="linea"></div>  <div class="parra">
                    <p><b >Jet-Filter, C.A. posee un sistema de la calidad basado en la norma ISO-9001.</b></p>
                    <p>Desde el año 2006 el sistema de calidad de Jet-Filter, C.A. está certificado por FONDONORMA y a continuación se pueden observar nuestros certificados Vigentes:</p>
                </div> 
                <div class="contenedor-imagenes">
                    <div class="imag">
                        <img src="img_jetfilter/pro/fondo2.png" alt="" class="overlay" data="img_jetfilter/pro/fondo.png">
                        <div class="overlay" data="img/pro/fondo.png">
                            <h2>Fondonorma</h2>
                        </div>
                    </div>
                    <div class="imag">
                        <img src="img_jetfilter/pro/iqnet2.png" alt="" class="overlay" data="img_jetfilter/pro/iqnet.png">
                        <div class="overlay" data="img/pro/iqnet.png">
                            <h2>IQNET</h2>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="scrol">
        <br>
        <br>
        <br>
        <footer class="footer">
            <section class="footer__copy container">
                <div class="footer__social">
                    <a href="#" class="footer__icons"><img src="/img_jetfilter/svg/facebook.svg" class="footer__img"></a>
                    <a href="#" class="footer__icons"><img src="/img_jetfilter/svg/twitter.svg" class="footer__img"></a>
                    <a href="#" class="footer__icons"><img src="/img_jetfilter/svg/youtube.svg" class="footer__img"></a>
                </div>
                <h3 class="footer__copyright">Derechos reservados &copy; JET-FILTER C.A</h3>
            </section>
        </footer>
    </div>

        <script src="{{asset('js/main_img.js')}}"></script>></script>
        <script src="/js/slider.js"></script>
        <script src="/js/questions.js"></script>
        <script src="/js/menu.js"></script>
        <script src="/js/menu_n.js"></script>
        <script src="/js/app.js"></script>
        <script src="/js/app1.js"></script>
        <script src="/js/jquery.min.js"></script>
    </body>
</html>
