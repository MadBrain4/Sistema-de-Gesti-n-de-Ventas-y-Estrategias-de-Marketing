<x-Arriba />
    <title>Lista de Deseos</title>

    @php 
        $j = 0;
    @endphp

    @if( session()->has('producto_eliminado') )
        <script>
            Swal.fire({
                icon: 'error',
                title: `El producto ha sido eliminado de la lista de deseos`,
                timer: 2000,
            })
        </script>
        @php
            session()->forget('producto_eliminado');
        @endphp
    @endif

    @if( session()->has('lista') && session('lista') != null)
        <div>
            <form action="{{ route('pay') }}" method="POST">
                @csrf
                <input type="submit" value="Comprar Todo" />
            </form>
        </div>
        @foreach( session('lista') as $lista )
            @php 
                $j++;
            @endphp
            <div class="col-xs-18 col-sm-6 col-md-4" style="margin-top:10px;">
                <div class="img_thumbnail productlist">
                    <div class="caption">
                        <h4><a href="/filtro?codigo={{ $lista['codigo'] }}&des=1">{{ $lista['codigo'] }}</a></h4>
                        @if( file_exists(public_path() . '/images/fichas-filtros/web/' . $lista['codigo'] . '.jpg') )
                            <img src="/images/fichas-filtros/web/{{$lista['codigo']}}.jpg" style="width: 200px;" />
                        @else
                            <img src="/images/fichas-filtros/web/no-img.jpg" style="width: 200px;" />
                        @endif
                        <p><strong>Precio: </strong> ${{ $lista['precio'] }}</p>
                        <p class="btn-holder">
                            <form method="POST" action="{{ route('lista_eliminar', ['id' => $lista['ID'] ] ) }}" >
                                <button type="submit" role="button" >Eliminar</button> 
                            </form>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="container">
            <div class="centered-element">
                <h3 class="texto" >SIN RESULTADOS</h3>
            </div>
        </div>
    @endif

    <link rel="stylesheet" href="{{ asset( 'css/estilos_abajo.css' ) }}">
    <script src="/js/sweetAlerta.js"></script>
    
    @if ( $j >= 2 )
    <footer class="footerr footer2">
@else
    <footer class="footerr footer3">
@endif

<div class="flex_conte_abajo">
    <section class="abaut__footer_d container_text">    
        <div class="div_fex_comprar">
            <div class="for">
                <a href="{{ route( 'distribuidores.index' ) }}" class="bot"><img src="{{ asset( 'img/tipo/bt_comprar.png' ) }}" alt=""></a>
            </div>               
        </div>
        <div class="footer_redes">
            <a href="https://www.facebook.com/profile.php?id=100071768772084" class="redes face"></a>              
            <a href="https://twitter.com/webfiltros" class="redes twi"></a>
            <a href="https://www.instagram.com/webfiltros/" class="redes inst"></a>
        </div>
        <div class="div_fex_distr">
            <div class="for">
                <a href="#" class="button">
                    <img src="{{ asset( 'img/tipo/bt_contact.png' ) }}" alt="">
                </a> 
            </div>                        
        </div>
    </section>  
    <section>
        Derechos reservados © JET-FILTER C.A
    </section>     
</div>
</footer>
<script src="{{ asset( 'js/sweetAlerts.js' ) }}"></script>
<script src="js/app.js"></script><!-- /.menu movil -->
<script src="./js/menu_n.js"></script>
<script type="text/javascript" src="./js/slider_heder.js"></script><!-- /.slider heder -->
</html>

<style>
.footer3 {
        position: absolute !important;
        bottom: 0 !important;
        width: 100% !important;
    }

    .footer2 {
        clear: both;
    }

body {
    background-color: #f6f6f6;
}

.img_thumbnail {
    position: relative;
    padding: 0px;
    margin-bottom: 20px;
}
.img_thumbnail img {
    width: 100%;
}
.img_thumbnail .caption{
    margin: 7px;
    text-align: center;
}

.btn{
    border:0px;
    margin:10px 0px;
    box-shadow:none !important;
}

.total-header-section{
    border-bottom:1px solid #d2d2d2;
}
.total-section p{
    margin-bottom:20px;
}
.cart-detail{
    padding:15px 0px;
}
.cart-detail-img img{
    width:100%;
    height:100%;
    padding-left:15px;
}
.cart-detail-product p{
    margin:0px;
    color:#000;
    font-weight:500;
}
.cart-detail .price{
    font-size:12px;
    margin-right:10px;
    font-weight:500;
}
.cart-detail .count{
    color:#000;
}
.checkout{
    border-top:1px solid #d2d2d2;
    padding-top: 15px;
}
.checkout .btn-primary{
    border-radius:50px;
 
}
.dropdown-menu:before{
    content: " ";
    position:absolute;
    top:-20px;
    right:50px;
    border:10px solid transparent;
    border-bottom-color:#fff;
}
 
.productlist {
    box-shadow: 0px 10px 30px rgb(0 0 0 / 10%);
    border-radius: 10px;
    height: 100%;
    overflow: hidden;
}
</style>