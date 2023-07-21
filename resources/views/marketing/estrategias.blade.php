<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Estrategias</title>

    <link rel="shortcut icon" href="{{asset('/img_jetfilter/icon/jf.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/jetfilter/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('css/marketing/estilos.css')}}">
    <script src="/js/sweetAlerta.js"></script>
</head>
<body>
    @if ( session()->has('creado') )
        <script>
            Swal.fire({
                icon: 'success',
                title: `Se ha creado la estrategia`,
                timer: 1250,
            })
        </script>
    @endif
    @if ( session()->has('actualizado') )
        <script>
            Swal.fire({
                icon: 'success',
                title: `Se ha actualizado la estrategia`,
                timer: 1250,
            })
        </script>
    @endif


    <div id="app_estrategias"></div>
    @vite('resources/js/app.js')

</body>
</html>