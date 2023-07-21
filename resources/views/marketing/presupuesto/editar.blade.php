<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Presupuesto de Estrategia</title>
    <link rel="shortcut icon" href="{{ asset( '/img_jetfilter/icon/jf.ico' ) }}" type="image/x-icon">
    <script src="/js/sweetAlerta.js"></script>

</head>
<body>
    @if ( session()->has('rebasa_presupuesto') )
        <script>
            var presupuesto_estrategia = {!! json_encode(session('presupuesto_estrategia'), JSON_HEX_TAG) !!}
            var tarea_mas_nueva = {!! json_encode(session('tarea_mas_nueva'), JSON_HEX_TAG) !!}
            Swal.fire({
                icon: 'error',
                title: `No se pudo subir porque el costo de las tareas principales rebasa el presupuesto de la estrategia`,
                text: `Presupuesto de Estrategia: ${presupuesto_estrategia} / Costo de las tareas: ${tarea_mas_nueva}`,
                confirmButtonText:
                '<i class="fa fa-thumbs-up""></i> Entendido',
            })
        </script>
        @php
            session()->forget('rebasa_presupuesto');
        @endphp
    @endif
    @if ( session()->has('rebasa_presupuesto_tareas') )
        <script>
            var presupuesto_padre = {!! json_encode(session('presupuesto_padre'), JSON_HEX_TAG) !!}
            var tarea_mas_nueva = {!! json_encode(session('tarea_mas_nueva'), JSON_HEX_TAG) !!}
            Swal.fire({
                icon: 'error',
                title: `No se pudo subir porque el costo de las subtareas reabasa el presupuesto de la tarea padre`,
                text: `Presupuesto de las Tareas: ${presupuesto_padre} / Costo de las tareas: ${tarea_mas_nueva}`,
                confirmButtonText:
                '<i class="fa fa-thumbs-up""></i> Entendido',
            })
        </script>
        @php
            session()->forget('rebasa_presupuesto_tareas');
        @endphp
    @endif
    @if ( session()->has('creado') )
        <script>
            Swal.fire({
                icon: 'success',
                title: `La tarea fue creada satisfactoriamente`,
                timer: 3500,
            })
        </script>
        @php
            session()->forget('creado');
        @endphp
    @endif
    @if ( session()->has('eliminado') )
        <script>
            Swal.fire({
                icon: 'success',
                title: `La tarea fue eliminada`,
                timer: 3500,
            })
        </script>
        @php
            session()->forget('eliminado');
        @endphp
    @endif

    <div id="app_editar_presupuesto"></div>

    @vite('resources/js/app.js')
</body>
</html>