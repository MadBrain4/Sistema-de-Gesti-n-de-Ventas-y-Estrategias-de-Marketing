<title>Inicio</title>

<x-arriba />

@isset ( $pago_exitoso )
    <script>
        Swal.fire({
            icon: 'success',
            title: `El pago se realizo exitosamente`,
            timer: 2000,
        })
    </script>
@endisset
@isset ( $pago_fallido )
    <script>
        Swal.fire({
            icon: 'error',
            title: `Ocurrio un error al realizar el pago`,
            timer: 2000,
        })
    </script>
@endisset
@isset ( $pago_cancelado )
    <script>
        Swal.fire({
            icon: 'warning',
            title: `El pago ha sido cancelado`,
            timer: 2000,
        })
    </script>
@endisset

<section class="header"> 
    <div class="wrapper">
        <!--<img src="img/heder/web.png" alt="" width="2000px" class="slide1" id="slide1">-->
        <video src="img/header/www_LogoWEB.mp4" class="slide1" id="slide1"  autoplay  muted ></video>
        <video src="img/header/Camion_WEB.mp4" class="slide2"  id="slide2" autoplay  muted ></video>
        <video src="img/header/www_WEB_FiltroW3690.mp4" class="slide3"  id="slide3" autoplay  muted ></video>  
    </div>
</section> 
<section class="home">
   <!-- <x-LineaProducto /> -->
    <x-TextoWeb />
    <x-VideoAire />
    <x-TextoAire />
    <x-VideoCombustible />
    <x-TextoCombustible />
    <x-VideoAceite />
    <x-TextoAceite />
    <x-VideoFluidos />
    <x-TextoFluidos />
    <x-Android />
    <!-- <x-SliderProducto /> -->
</section>

<x-Abajo />