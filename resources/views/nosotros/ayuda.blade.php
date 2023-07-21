<link rel="stylesheet" href="{{ asset( 'css/descargas.css' )}}">

<x-Arriba />
    <title>Ayuda - Manual de Uso</title>
    <section class="infor_descarga container_text">
        <h3 class="title_documento">Manual de Uso</h3> 

        <embed src="{{ asset('/PDF/MANUAL.pdf?t=@php echo $rann @endphp') }}" type="application/pdf" >

    </section>

<x-Abajo />