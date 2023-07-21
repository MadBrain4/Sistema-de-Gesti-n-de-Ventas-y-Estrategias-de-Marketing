<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/js/sweetAlerta.js"></script>
    <title>Crear Estrategia</title>
    <link rel="shortcut icon" href="{{ asset( '/img_jetfilter/icon/jf.ico' ) }}" type="image/x-icon">
</head>
<body>
    <script>
        function alerta_imagen(mensaje){
            Swal.fire({
                icon: 'error',
                title: mensaje,
                timer: 1250,
            })
        }
    </script>
    
    @error('fecha_inicio')
        <script>
            var mensaje = {!! json_encode($message, JSON_HEX_TAG) !!}
            alerta_imagen(mensaje);    
        </script>
    @enderror
    @error('fecha_final')
        <script>
            var mensaje = {!! json_encode($message, JSON_HEX_TAG) !!}
            alerta_imagen(mensaje);    
        </script>
    @enderror

    <div id='app_estrategias_nuevo'></div>
    
    @vite('resources/js/app.js')
</body>
</html>