<link rel="stylesheet" href="{{ asset( 'css/descargas.css' )}}">

<x-Arriba />
    <title>Catálogo de especificaciones</title>
    <section class="infor_descarga container_text">

        @if( $catalogo == 'pasajero' )
            <h3 class="title_documento">CATÁLOGO DE VEHICULOS LIVIANOS</h3> 
            <embed src="{{ asset('/PDF/vehiculos_livianos.pdf?t=@php echo $rann @endphp') }}" type="application/pdf" >
        @elseif( $catalogo == 'equivalencias' )
            <h3 class="title_documento">CATÁLOGO DE EQUIVALENCIAS</h3> 
            <embed src="{{ asset('/PDF/equivalencias.pdf?t=@php echo $rann @endphp') }}" type="application/pdf" >
        @elseif( $catalogo == 'especificaciones')
            <h3 class="title_documento">CATÁLOGO DE ESPECIFICACIONES</h3> 
            <embed src="{{ asset('/PDF/especificaciones.pdf?t=@php echo $rann @endphp') }}" type="application/pdf" > 
        @elseif( $catalogo == 'agricola')
            <h3 class="title_documento">CATÁLOGO DE VEHICULOS AGRICOLAS</h3> 
            <embed src="{{ asset('/PDF/vehiculos_agricolas.pdf?t=@php echo $rann @endphp') }}" type="application/pdf" >  
        @elseif( $catalogo == 'comercial')
            <h3 class="title_documento">CATÁLOGO DE VEHICULOS COMERCIALES</h3> 
            <embed src="{{ asset('/PDF/vehiculos_comerciales.pdf?t=@php echo $rann @endphp') }}" type="application/pdf" >   
        @elseif( $catalogo == 'fuera_carretera' )
            <h3 class="title_documento">CATÁLOGO DE VEHICULOS FUERA DE CARRETERA</h3> 
            <embed src="{{ asset('/PDF/vehiculos_carretera.pdf?t=@php echo $rann @endphp') }}" type="application/pdf" >       
        @elseif( $catalogo == 'completo' )
            <h3 class="title_documento">CATÁLOGO COMPLETO</h3> 
            <embed src="{{ asset('/PDF/completo.pdf?t=@php echo $rann @endphp') }}" type="application/pdf" >           
        @endif
        <br>

        <a href="{{ route('descargas.index') }}">
            <img src='{{ asset('/img/tipo/bt_volver.png') }}' alt='' class='bt_busq'>
        </a>
    </section>

<x-Abajo />