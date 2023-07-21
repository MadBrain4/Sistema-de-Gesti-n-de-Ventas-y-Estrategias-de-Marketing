<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jet-Filter C.A</title>
    <link rel="shortcut icon" href="./img/icon/jf.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/jetfilter/estilos_gestion.css')}}">
    <link rel="stylesheet" href="{{asset('css/jetfilter/normalize.css')}}">

    
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.ez-plus.js"></script>
</head>
<body>
    <nav class="nav container" id ="menu_s">
        <div class="nav__logo">
           <a href="{{route('jet-filter.index')}}"> <img src="/img_jetfilter/logo/logojf2.png" class="img_log"></a>
        </div>
    </nav>

    <body>
    <br>
    <section class="abaut_form">
        <form action="{{route('jet-filter.validar')}}" method="POST" id="form" class="form_login">
            @csrf
            <div class="login">
                <h1>Acceso</h1>
                <div class="grupo">
                    <input type="text" name="email" id="name" class="input" required><span class="barra"></span>
                    <label for="" class="label_gestion">Correo electrónico</label>
                </div>

                <div class="grupo">
                    <input type="password" name="password" id="password" class="input" required><span class="barra"></span>
                    <label for="" class="label_gestion">Clave</label>
                </div>


                <button type="submit" name="iniciar_sesion" class="boton">Acceso</button>
                <br>
                <?php
                    if(isset($_GET["fallo"]) && $_GET["fallo"] == 'true')
                    {
                        echo "<div'>
                            <h3 style='border-radius: 7.5px 7.5px 0px 0px; background-color: #B81616; color:white; text-align:center; padding: 0.3em; margin-top: 1em'>Error</h3>
                            <div style='border-radius: 0px 0px 7.5px 7.5px; background-color: #F78787; color: white; padding: 1.5em;' >Usuario o contraseña invalida, intentelo de nuevo</div>
                        </div>";
                    }
                ?>
            </div>
        </form>
    </section>


    <div class="scrol">
        <footer class="footer">
            <section class="footer__copy container">
                <div class="footer__social">
                    <a href="#" class="footer__icons"><img src="/img_jetfilter/svg/facebook.svg" class="footer__img"></a>
                    <a href="#" class="footer__icons"><img src="/img/svg/twitter.svg" class="footer__img"></a>
                    <a href="#" class="footer__icons"><img src="/img/svg/youtube.svg" class="footer__img"></a>
                </div>

                <h3 class="footer__copyright">Derechos reservados &copy; JET-FILTER C.A</h3>
            </section>

        </footer>
    </div>
</body>
   
       
        <script type="text/javascript" src="js/main_img.js"></script><!-- /.js zoom imagenes galeria incio -->
        <script src="./js/slider.js"></script>
        <script src="./js/questions.js"></script>
        <script src="./js/menu.js"></script>
        <script src="./js/menu_n.js"></script>
        <script src="./js/app.js"></script>
        <script src="./js/app1.js"></script>
        <script src="./js/jquery.min.js"></script>
       

</body>
</html>